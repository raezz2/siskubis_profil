<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ProfilUser;
use App\User;
use Auth;
use App\Pengumuman;
use App\Priority;

class MentorController extends Controller
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
        $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'role_user.role_id' => 4])->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid', 'profil_user.*')->get();
        return view('mentor.index', $data);
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::where('publish', 1)->get();
        return view('mentor.pengumuman', compact('pengumuman'));
    }

    public function show($slug)
    {
        $pengumuman = DB::table('pengumuman')->where('slug', $slug)->get();
        return view('mentor.detail', ['pengumuman' => $pengumuman]);
    }
}
