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
        $this->middleware('auth');
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
        return view('pengumuman.index', compact('pengumuman', 'kategori', 'inkubator'));
    }

    public function tambah()
    {
        $title = 'New Pengumuman';
        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();

        return view('pengumuman.pengumuman_add', compact('kategori', 'inkubator', 'title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'kategori' => 'required',
            'inkubator' => 'required',
            'pengumuman' => 'required',
            'file' => 'required',
        ]);

        DB::table('pengumuman')->insert([
            'title' => $request->title,
            'slug' => Str::slug($request->get('title')),
            'priority_id' => $request->kategori,
            'inkubator_id' => $request->inkubator,
            'pengumuman' => $request->pengumuman,
            'author_id' => \Auth::user()->id,
            'foto' => $request->file->getClientOriginalName(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $file = $request->file;
        $tujuan_upload = 'img/pengumuman';
        $file->move($tujuan_upload, $file->getClientOriginalName());

        \Session::flash('sukses', 'Berhasil Menambahkan Data Pengumuman');
        return redirect('/inkubator/pengumuman');
    }

    public function show($slug)
    {
        $pengumuman = DB::table('pengumuman')->where('slug', $slug)->get();
        return view('pengumuman.detail', ['pengumuman' => $pengumuman]);
    }

    public function edit($id)
    {

        $title = 'Edit Pengumuman';
        $p = DB::table('pengumuman')->where('id', $id)->first();
        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        $pengumuman = pengumuman::find($id);
        return view('pengumuman.pengumuman_edit', compact('title', 'p', 'kategori', 'inkubator'));
    }
    public function update($id, Request $request)
    {

        $pengumuman = Pengumuman::find($id);
        $pengumuman = Pengumuman::all();
        $foto = Pengumuman::find($id)->where('foto', $id)->first();
        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        $file = $pengumuman->foto;
        DB::table('pengumuman')->where('id', $request->id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->get('title')),
            'priority_id' => $request->kategori,
            'inkubator_id' => $request->inkubator,
            'pengumuman' => $request->pengumuman,
            'foto'       => $request->foto,
            'author_id' => Auth::user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if ($request->hasfile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $file->move($tujuan_upload, $file->getClientOriginalName());
            $file->first();
        } else {
            $file = $pengumuman->foto;
        }

        $pengumuman->update($file);
        $foto->save();
        return redirect('inkubator/pengumuman');
    }
    public function hapus($id)
    {

        $file = DB::table('pengumuman')->where('id', $id)->first();
        File::delete('img/film/' . $file->foto);
        DB::table('pengumuman')->where('id', $id)->delete();

        \Session::flash('hapus', 'Berhasil Menghapus Data Pengumuman');
        return redirect('inkubator/pengumuman');
    }

    public function status($id)
    {
        $data = \DB::table('priority')->where('id', $id)->first();

        $status_sekarang = $data->status;

        if ($status_sekarang == 1) {
            \DB::table('priority')->where('id', $id)->update([
                'status' == 0
            ]);
        } else {
            \DB::table('priority')->where('id', $id)->update([
                'status' == 1
            ]);
        }
        \Session::flash('hapus', 'Berhasil Mengupdate Status Pengumuman');
        return redirect('inkubator/pengumuman');
    }
    public function status($id){
        $pengumuman = DB::table('pengumuman')->where('id',$id)->first();

        $status = $pengumuman->publish;

        if($status == 1){
            DB::table('pengumuman')->where('id', $id)->update([
                'publish' => 0
            ]);
        }else{
            DB::table('pengumuman')->where('id', $id)->update([
                'publish' => 1
            ]);
        }
        \Session::flash('sukses','Berhasil Merubah Status Pengumuman');
        return redirect('inkubator/pengumuman');
    }
}
