<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Surat;

class HomeController extends Controller
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
        $surat = Auth::user()->surat();

        return view('user.dashboard', compact('surat'));
    }
}
