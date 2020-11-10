<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class TeamCreate extends Component
{
    public function render()
    {
        return view('livewire.team-create', [
            'teamid' => User::where([
                'users.inkubator_id' => auth()->user()->inkubator_id,
                'role_user.role_id' => 6,
                ])
            ->join('role_user', ['users.id' => 'role_user.user_id'])
            // ->join('tenant_user', ['users.id' => 'tenant_user.user_id'])
            ->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])
            ->select('users.id as uid', 'profil_user.*')
            ->get()
        ]);
    }
}
