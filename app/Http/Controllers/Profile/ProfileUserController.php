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
     * Menampilan data profile user yang sedang login
     */

    public function index()
    {
        if (request()->user()->hasRole(['mentor'])) {
            $data['data'] = User::with('profile')->where(['users.id' => Auth::user()->id])->first();
            if ($data['data']->profile->status === '0') {
                request()->session()->now('message', 'Tolong lengkapi data profil anda');
                request()->session()->now('alert-type', 'warning');
            }
        }
        return view('profile.index', $data);
        // return $data;
    }
    /**
     * menampilkan detail profil user lain berdasarkan request()->id
     */
    public function show()
    {
        // $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'users.id' => auth()->user()->id])->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid', 'profil_user.*')->first();
        if (request()->user()->hasRole(['inkubator', 'tenant'])) {
            $data['data'] = User::with('profile')->where(['users.inkubator_id' => Auth::user()->inkubator_id, 'users.id' => request()->id])->whereHas('roles', function ($q) {
                $q->where('name', 'Mentor');
            })->firstOrFail();
        }
        return view('profile.index', $data);
    }

    public function indexTenant()
    {
        $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'users.id' => 3])->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid', 'profil_user.*')->first();
        return view('profile.index', $data);
        // return $data;
    }

    public function update(UpdateProfilRequest $request)
    {
        $profil = ProfilUser::where('user_id', Auth::user()->id)->first();
        $tujuan_upload = 'img/mentor/profile/';

        if ($profil->foto === null) {
            $file = $request->foto;
            $filename = time() . \Str::slug($request->get('nama')) . '.' . $file->getClientOriginalExtension();
            $file->move($tujuan_upload, $filename);
        } elseif ($profil->foto !== null) {
            \File::delete($tujuan_upload . $profil->foto);
            $file = $request->foto;
            $filename = time() . \Str::slug($request->get('nama')) . '.' . $file->getClientOriginalExtension();
            $file->move($tujuan_upload, $filename);
        }
        $profil->update([
            'nama' =>  $request->nama,
            'jenkel' =>  $request->jenkel,
            'kontak' =>  $request->kontak,
            'alamat' =>  $request->alamat,
            'nik' =>  $request->nik,
            'foto' =>  $filename,
            'deskripsi' =>  $request->deskripsi,
            'status' =>  '1'
        ]);
        // ProfilUser::updateOrCreate(
        //     ['user_id'  =>  Auth::user()->id],
        //     [
        //         'nama' =>  $request->nama,
        //         'jenkel' =>  $request->jenkel,
        //         'kontak' =>  $request->kontak,
        //         'alamat' =>  $request->alamat,
        //         'nik' =>  $request->nik,
        //         'foto' =>  $filename,
        //         'deskripsi' =>  $request->deskripsi,
        //         'status' =>  $request->status,
        //     ],
        // );
        $notification = array(
            'message' => 'Data Profil Berhasil Diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
