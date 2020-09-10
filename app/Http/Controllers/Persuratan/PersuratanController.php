<?php

namespace App\Http\Controllers\Persuratan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Surat;
class PersuratanController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $surat = DB::table('surat')->get();

        return view('surat.index', compact('surat'));
    }

    public function create()
    {
        return view ('surat.form');
        
    }

    public function store (Request $request)
    {
        DB::table('surat')->insert([
            'title' => $request->judul,
            'dari' => Auth::user()->email,
            'kepada' => $request->kepada,
            'perihal' => $request->perihal,
            'dokumen' => $request->dokumen,
            'jenis_surat' => 2,
            'author_id' => Auth::user()->id,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        return redirect ('inkubator/surat');
    }

    public function show ($id)
    {
        $surat = DB::table('surat')->where('id', $id)->get();
        
        return view ('surat.detail', compact($surat));
    }
}
