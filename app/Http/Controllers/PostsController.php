<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\PostDetail;
use App\Models\PostType;
use App\Models\WebConfig;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
         $this->middleware('permission:post-create', ['only' => ['create','store']]);
         $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index',compact('posts'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
    public function createvideo()
    {
        $categories = Category::all();
        return view('posts.createvideo', compact('categories'));
    }
    public function createfoto()
    {
        $categories = Category::all();
        return view('posts.createfoto', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'post_title'=>'required|max:255',
            'post_slug' => 'required|unique:posts',
            'post_content' => 'required',
            'category_ID' => 'required',
            'post_thumbnail' => 'image|file|max:1024',
            'post_type_slug' => 'required'
        ];

        if($request->post_type_slug=='video')
        {
            $rules['item_content']='required';
        }
        elseif($request->post_type_slug=='foto')
        {
            $rules['item_content']='required';
            $rules['item_content.*']='image|file|max:1024';
        }
        $validatedData= $request->validate($rules);

        if($request->file('post_thumbnail'))
        {
            $validatedData['post_thumbnail']=$request->file('post_thumbnail')->store('posts');
        }

        $validatedData['author_ID'] = auth()->user()->id;
        $validatedData['post_type'] = PostType::firstWhere('post_type_slug',$request->post_type_slug)->id;
        $validatedData['post_short_content'] = Str::limit(strip_tags($request->post_content) , 200);
    
        //simpan data postingan
        $post=Post::create($validatedData);

        //simpan data postingan detail
        if($request->post_type_slug=='video')
        {
            PostDetail::create([
                'post_ID'=>$post->id,
                'item_name'=> $validatedData['post_title'],
                'item_content' => $request->item_content
            ]);
        }
        elseif($request->post_type_slug=='foto')
        {
            if($request->hasfile('item_content'))
            {
                foreach($request->file('item_content') as $key => $file)
                {
                    $path = $file->store('posts');
                    $name = $file->getClientOriginalName();
                    PostDetail::create([
                        'post_ID'=>$post->id,
                        'item_name'=> $name,
                        'item_content' => $path
                    ]);
                }
            }
        }
        
        return redirect()->route('posts.index')
                        ->with('success','artikel video baru berhasil dibuat.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post_types = PostType::where('id','>',1)->get();
        return view('posts.edit',compact('post','categories','post_types'));
    }
    /**
     * Show single post
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function lihat(Post $post)
    {
        // $posts=Post::latest()->take(5)->get();
        $posts = Post::latest()->paginate(10);
        $pages = Page::all();

        $web_configs = WebConfig::latest()->get();
        $categories = Category::withCount('post')->get()->sortByDesc('post_count');
        return view('posts.show',compact('post','categories','web_configs','posts','pages'));
    }
    /**
     * Show daftar semua post di halaman web nya 
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function daftar()
    {
        // dd(request('Search'));
        $title='';
        if(request('category')){
            $category=Category::firstWhere('category_slug',request('category'));
            $title=' di '.$category->category_name;
        }
        if(request('author')){
            $author=User::firstWhere('username',request('author'));
            $title=' oleh '.$author->username;
        }

        $posts = Post::latest()->Filter(request(['search','category','author']))->paginate(7)->withQueryString();
        $pages = Page::all();

        $web_configs = WebConfig::latest()->get();
        $categories = Category::withCount('post')->get()->sortByDesc('post_count');
        return view('posts.daftar',compact('posts','categories','web_configs','pages'))
        ->with('title',$title)
        ->with('i', (request()->input('page', 1) - 1) * 10);

    }
    /**
     * Show daftar semua post di halaman web nya 
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $posts = Post::latest()->take(5)->get();

        $web_configs = WebConfig::latest()->get();
        $categories = Category::withCount('post')->get()->sortByDesc('post_count');
        return view('posts.categories',compact('posts','categories','web_configs'));
    }
    /**
     * update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules=[
            'post_title'=>'required|max:255',
            'post_content' => 'required',
            'category_ID' => 'required',
            'post_thumbnail' => 'image|file|max:1024',
            'post_type' => 'required'
        ];

        if($request->post_slug != $post->post_slug){
            $rules['post_slug']='required|unique:posts';
        }
        if($request->post_type_slug=='video'){
            $rules['item_content']='required';
        }
        $validatedData= $request->validate($rules);

        if($request->file('post_thumbnail'))
        {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['post_thumbnail']=$request->file('post_thumbnail')->store('posts');
        }

        $validatedData['author_ID'] = auth()->user()->id;
        $validatedData['post_short_content'] = Str::limit(strip_tags($request->post_content) , 200);

        Post::where('id',$post->id)
        ->update($validatedData);

        //update post detail : create or update untuk video
        if($post->tipe->post_type_slug=='video')
        {
            $pd = PostDetail::firstOrNew(array('post_ID' => $post->id));
            $pd->item_name = $post->post_title;
            $pd->item_content = $request->item_content;
            $pd->save();
        }

        
        return redirect()->route('posts.index')
                        ->with('success','artikel berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->post_thumbnail){
            Storage::delete($post->post_thumbnail);
        }
        if($post->details)
        {
            foreach($post->details as $pd)
            {
                $pd->delete();
                if($post->tipe->post_type_slug=='foto')
                {
                    Storage::delete($pd->item_content);
                }
            }
        }
        $post->delete();
        return redirect()->route('posts.index')
                        ->with('success','Product deleted successfully');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'post_slug', $request->title);
        return response()->json(['slug'=>$slug]);
    }
}
