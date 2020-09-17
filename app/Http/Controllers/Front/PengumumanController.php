<?php

namespace App\Http\Controllers\Pengumuman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Pengumuman;
use App\Priority;
use File;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function __construct()
    {
        //    $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pengumuman = Pengumuman::all();
        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        return view('front/pengumuman/list_pengumuman'), compact('pengumuman', 'kategori', 'inkubator'));
    }

    public function show($slug)
    {
        $pengumuman = DB::table('pengumuman')->where('slug', $slug)->get();
        return view('front/pengumuman/detail_pengumuman', ['pengumuman' => $pengumuman]);
    }
}
