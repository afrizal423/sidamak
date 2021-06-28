<?php

namespace App\Http\Livewire\User;

use App\Models\Keluhan;
use Livewire\Component;

class DashboardUser extends Component
{
    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected $listeners = ['echo:aduanBaru,.NewAduan' => 'getResponDariSocket'];

    public $aduan, $idnya;
    public $status = false;

    public function getResponDariSocket()
    {
        $this->aduan = count(Keluhan::where("status", 0)->orderBy('created_at', 'ASC')->get()->toArray());
        if ($this->aduan > 0) {
            $this->idnya = Keluhan::where("status", 0)->orderBy('created_at', 'ASC')->first()->id;

            $this->status = true;
        } else {
            $this->idnya = "";
            $this->status = false;
        }

    }

    public function render()
    {
        $this->getResponDariSocket();
        return view('livewire.user.dashboard-user');
    }
}
