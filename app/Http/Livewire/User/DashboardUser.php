<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class DashboardUser extends Component
{
    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected $listeners = ['echo:aduanBaru,.NewAduan' => 'asd'];

    public $aduan;

    public function asd()
    {
        // dd(true);
        $this->aduan++;
    }

    public function render()
    {
        return view('livewire.user.dashboard-user');
    }
}
