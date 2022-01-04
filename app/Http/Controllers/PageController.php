<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Category;
use App\Models\WebConfig;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('pages.index',compact('pages'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * sama dengan show tetapi bisa dilihat oleh semua orang
     *
     * @return \Illuminate\Http\Response
     */
    public function lihat(Page $page)
    {
        $posts = Post::latest()->take(10)->get();
        $pages = Page::all();
        $web_configs = WebConfig::latest()->get();
        $categories = Category::withCount('post')->get()->sortByDesc('post_count');
        return view('pages.lihat',compact('page','web_configs','categories','posts','pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'title'=>'required|max:255',
            'slug' => 'required|unique:pages',
            'content' => 'required'
        ]);

        $validatedData['author_ID'] = auth()->user()->id;
    
        Page::create($validatedData);
        
        return redirect()->route('pages.index')
                        ->with('success','Halaman baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $rules=[
            'title'=>'required|max:255',
            'content' => 'required'
        ];
        if($request->slug != $page->slug){
            $rules['slug']='required|unique:pages';
        }
        $validatedData= $request->validate($rules);
        $validatedData['author_ID'] = auth()->user()->id;

        Page::where('id',$page->id)
        ->update($validatedData);
        
        return redirect()->route('pages.index')
                        ->with('success','halaman berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')
                        ->with('success','halaman berhasil dihapus');
    }
}
