<?php

namespace App\Http\Controllers\Profile;

use DB;
use Auth;
use App\User;
use App\ProfilUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfilRequest;

class ProfileUserController extends Controller
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
        $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'users.id' => 3])->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid', 'profil_user.*')->first();
        return view('profile.index', $data);
        // return $data;
    }

    public function indexMentor()
    {
        $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'users.id' => auth()->user()->id])->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid', 'profil_user.*')->first();
        $dataProfil = ProfilUser::find(auth()->user()->id, 'user_id');
        if (!$dataProfil) {
            $notification = array(
                'message' => 'Event Berhasil Diperbarui',
                'alert' => 'success'
            );
            return view('profile.index', $data)->with($notification);
        } else {
            return view('profile.index', $data);
        }
        // return $data;
    }

    public function update(UpdateProfilRequest $request)
    {
        $file = $request->foto;
        $filename = time() . \Str::slug($request->get('nama')) . '.' . $file->getClientOriginalExtension();

        ProfilUser::updateOrCreate(
            ['user_id'  =>  Auth::user()->id],
            [
                'nama' =>  $request->nama,
                'jenkel' =>  $request->jenkel,
                'kontak' =>  $request->kontak,
                'alamat' =>  $request->alamat,
                'nik' =>  $request->nik,
                'foto' =>  $filename,
                'deskripsi' =>  $request->deskripsi,
                'status' =>  $request->status,
            ],
        );

        $tujuan_upload = 'img/mentor/profile';
        $file->move($tujuan_upload, $filename);

        $notification = array(
            'message' => 'User Berhasil Diperbaruhi',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
