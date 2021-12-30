<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Seller;
use App\Models\Tblantar;
use App\Models\User;
use App\Models\Tbljemput;
use App\Models\Transaksi;
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
        $categories = Category::withCount('post')->get()->sortByDesc('post_count');
        
        // $popular_posts = Post::withCount('komen')
        // ->get()->sortByDesc('komen_count')->take(5);
        $popular_posts=$posts->take(5);

        return view('index', compact('posts','categories','popular_posts'));
    }

    /**
     * Generate a "random" alpha-numeric string.
     *
     * Should not be considered sufficient for cryptography, etc.
     *
     * @param  int  $length
     * @return string
     */
    function str_random($length = 4)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cekresi()
    {
        if(request('txtcari'))
        {
            if(Tbljemput::where('id',request('txtcari'))->exists())
            {
                $dat=Tbljemput::find(request('txtcari'));
                return view('transaksi/cekresi',compact('dat'));
            }
            else
                return redirect('/');
        }
        return redirect('/');
    }
    /**
     * Ambil data json untuk data yang belum diantar.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        // return Datatables::of(Tbljemput::all())->make(true);
        $data=Tbljemput::doesntHave('antar')
        ->orWhereHas("antar", function($q){ $q->where("status_id", 3); })
        ->get();

        $totaljemput=Tbljemput::all()->count();
        $totalantar=Tblantar::all()->count();

            return Datatables::of($data)
                    ->addIndexColumn()

                    ->editColumn('id', function($row){
                        $btn = '<a href="'.route('transaksi.show2',urlencode($row->id)).'">'.$row->id.'</a>';
                           return $btn;
                    })
                    ->addColumn('kurirjemput', function($row){
                            return $row->kurir->name;
                    })
                    ->addColumn('status', function($row){
                        $stt='<span class="badge badge-warning">Belum Input</span>';
                        if(isset($row->antar))
                        {
                            if($row->antar->status->id==3)
                                $stt='<span class="badge badge-danger">'.$row->antar->status->name.'</span>';
                            else
                                $stt='<span class="badge badge-info">'.$row->antar->status->name.'</span>';
                        }
                            return $stt;
                            // return $row->antar->status->name??'-';
                    })

                    ->rawColumns(['id','status'])
                    ->with('totaljemput',$totaljemput)
                    ->with('totalantar',$totalantar)
                    ->make(true);
    }
}
