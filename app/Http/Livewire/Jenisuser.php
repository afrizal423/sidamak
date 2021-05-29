<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JenisUsers;

class Jenisuser extends Component
{
    public function render()
    {
        return view('pages.jenisuser.jenisuser', [
            'jenis_users' => JenisUsers::class
        ]);
    }
}
