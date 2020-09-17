<?php

namespace App\Http\Controllers\Persuratan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Surat;
use Session;
use App\Disposisi;

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
        $user = DB::table('users')->get();

        return view ('surat.form', compact('user'));
        
    }

    public function createkeluar()
    {
        $user = DB::table('users')->get();

        return view ('surat.formkeluar', compact('user'));
        
    }

    public function store (Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf,jpg,png,jpeg',
        ]);

        DB::table('surat')->insert([
            'title' => $request->judul,
            'dari' => Auth::user()->email,
            'kepada' => $request->kepada,
            'perihal' => $request->perihal,
            'dokumen' => $request->file->getClientOriginalName(),
            'jenis_surat' => 1,
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

    public function storekeluar (Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf,jpg,png,jpeg',
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

        
        $file = $request->file('dokumen');
        $name = time();
        $fileName = $name . '.' . $file->getClientOriginalName();

        $tujuan_upload = 'file/dokumen';
        $filestore = $file->move($tujuan_upload, $fileName, 'public');
        
    
        if ($filestore) {
            Session::flash('success', 'Surat Terkirim');
        } else {
            Session::flash('error', 'Surat Gagal Terkirim');
        }
        

        return redirect ('inkubator/surat');
    }

    public function show ($id)
    {
        $surat = Surat::where('surat.id', $id)
        ->leftJoin('profil_user',['profil_user.user_id' => 'surat.kepada'])
        ->leftjoin('users',['surat.kepada'=>'users.id'])
        ->select('surat.*','profil_user.nama','users.email')
        ->get();
        $user = User::where('email', $id )->get();

        //dd($surat, $user);
        // return response()->json($surat);
        return view ('surat.detail', compact('surat', 'user'));

    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        
        $user = DB::table('users')->get();
        // $surat = Surat::where('id', '!=', $id)->orderBy('name', 'asc')->get();

        $this->data['surat'] = $surat;
        $this->data['user'] = $user;
        return view('surat.edit', $this->data);
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

    public function disposisi($id)
    {
        $surat = Surat::findOrFail($id);
        
        $user = DB::table('users')->get();
        // $surat = Surat::where('id', '!=', $id)->orderBy('name', 'asc')->get();

        $this->data['surat'] = $surat;
        $this->data['user'] = $user;
        return view('surat.disposisi', $this->data);
        
    }

    public function disposisiupdate( $id, Request $request)
    {
        $surat = Surat::where('id', $id)->get();
        $disposisi =Disposisi::create([
            'user_id' => $request->kepada,
            'surat_id' => $surat->id,
            'author_id' => $surat->author_id,
            'inkubator_id' => 1,
        ]);
        Surat::where('id', $surat->id)
        ->update([
            'kepada'=> $request->kepada,
        ]);

    }
}
