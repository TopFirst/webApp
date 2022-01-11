<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\WebConfig;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->get();
        $postsByCategory=$posts->where('category_ID',1);

        if(request('selectedCategory'))
        {
            // dd(request('selectedCategory'));
            $slug=request('selectedCategory');
            $postsByCategory=Post::whereHas('kategori',function($query) use($slug){
                return $query->where('category_slug',$slug);
            })->get();
        }
        $pages = Page::all();

        $web_configs = WebConfig::latest()->get();
        $categories = Category::withCount('post')->get()->sortByDesc('post_count');
        
        $popular_posts=$posts->take(5);
        return view('index', compact('posts','categories','popular_posts', 'web_configs', 'pages','postsByCategory'))->with('title','Beranda');
    }
    /**
     * Show pengaturan web.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function web_config()
    {
        $web_configs = WebConfig::latest()->get();
        return view('home.web_config', compact('web_configs'));
    }

    /**
     * POST untuk ubah konfigurasi dari halaman web config
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function ubahconfig(Request $request, $id)
    {
         request()->validate([
            'opt_value' => 'required',
        ]);

        $input = $request->all();
        $config = WebConfig::find($id);
        $config->update($input);

        return redirect()->route('home.web_config')
                        ->with('success','parameter berhasil diperbarui');
    }
}
