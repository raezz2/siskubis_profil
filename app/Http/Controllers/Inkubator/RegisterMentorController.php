<?php

namespace App\Http\Controllers\Inkubator;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterMentorController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware(['role:inkubator']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {

        // dd($data);
        $user = config('roles.models.defaultUser')::create([
            'name' => $data['email'],
            'inkubator_id' => Auth::user()->inkubator_id,
            'email' => $data['email'],
            'password' => '12345678',
        ]);

        $role = config('roles.models.role')::where('name', '=', 'Mentor')->first();  //choose the default role upon user creation.
        $user->attachRole($role);

        return $user;
    }
}
