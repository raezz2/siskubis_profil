<?php

namespace App\Http\Controllers\Persuratan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Surat;
use Session;

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
        $request->validate([
            'file' => 'mimes:pdf',
        ]);

        DB::table('surat')->insert([
            'title' => $request->judul,
            'dari' => Auth::user()->email,
            'kepada' => $request->kepada,
            'perihal' => $request->perihal,
            'dokumen' => $request->file->getClientOriginalName(),
            'jenis_surat' => 2,
            'author_id' => Auth::user()->id,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        $file = $request->file;
    	$tujuan_upload = 'file/dokumen';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        
        if ($file) {
            Session::flash('success', 'Surat Terkirim');
        } else {
            Session::flash('error', 'Surat Gagal Terkirim');
        }

        return redirect ('inkubator/surat');
    }

    public function show ($id)
    {
        $surat = DB::table('surat')->where('id', $id)->get();
        
        return view ('surat.detail', compact('surat'));

    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        // $surat = Surat::where('id', '!=', $id)->orderBy('name', 'asc')->get();

        // $this->data['categories'] = $categories->toArray();
        // $this->data['category'] = $category;
        return view('surat.edit', compact('surat'));
    }

    public function update(Request $request, Surat $surat)
    {
        Surat::where('id', $surat->id)
        ->update ([
            'title' => $request->judul,
            'dari' => Auth::user()->email,
            'kepada' => $request->kepada,
            'perihal' => $request->perihal,
            'dokumen' => $request->file->getClientOriginalName(),
            'author_id' => Auth::user()->id,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        $file = $request->file;
    	$tujuan_upload = 'file/dokumen';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        
        if ($file) {
            Session::flash('success', 'Surat Berhasil Dirubah');
        } else {
            Session::flash('error', 'Surat Gagal Dirubah');
        }

    	return redirect ('/inkubator/surat');
    }

    public function destroy($id)
    {
        $surat  = Surat::findOrFail($id);

        if ($surat->delete()) {
            Session::flash('success', 'Surat berhasil dihapus');
        }

        return redirect('/inkubator/surat');
    }
}
