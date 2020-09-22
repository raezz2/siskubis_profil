<?php

namespace App\Http\Controllers\Pengumuman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Pengumuman;
use App\Priority;
use App\Inkubator;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
    }
    public function kategori($id)
    {
        $pengumuman = Pengumuman::where([['priority_id', $id], ['author_id', \Auth::user()->id]])->latest()->get();
        $kategori = DB::table('priority')->get();
        return view('pengumuman.index', compact('pengumuman', 'kategori'));
    }
    public function search(Request $request)
    {

        $keyword = $request->get('keyword');

        if ($keyword) {
            $pengumuman = Pengumuman::where([['title', 'like', '%' . $keyword . '%'], ['priority_id', $id], ['author_id', \Auth::user()->id]])->get();
        } else {

            return redirect('inkubator/pengumuman');
        }

        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        return view('pengumuman.index', compact('pengumuman', 'kategori', 'inkubator', 'keyword'));
    }
}
