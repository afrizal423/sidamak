<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UnitKerjas;

class UnitKerja extends Component
{
    public function render()
    {
        return view('pages.unitkerja.unit-kerja', [
            'unit_kerjas' => UnitKerjas::class
        ]);
    }
}
