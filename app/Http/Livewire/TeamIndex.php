<?php

namespace App\Http\Livewire;

use App\ProdukTeam;
use Livewire\Component;

class TeamIndex extends Component
{
    public function render()
    {
        return view('livewire.team-index', [
            'produk_teams' => ProdukTeam::latest()->get(),
            'team' => ProdukTeam::with('profil_user')->get()
        ]);
    }
}
