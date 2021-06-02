<?php

namespace App\Http\Livewire\Pegawai;

use App\Models\Pegawai;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('pages.pegawai.index', [
            'pegawais' => Pegawai::class
        ]);
    }
}
