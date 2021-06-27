<?php

namespace App\Http\Livewire\Public;

use App\Models\Keluhan;
use Livewire\Component;
use App\Models\DivisiModels;

class FormAduan extends Component
{
    public $divisis, $divisi, $nama_pelapor, $keterangan;
    private function resetInputFields(){
        $this->nama_divisi = '';
        $this->nama_pelapor  = '';
        $this->keterangan  = '';
    }
    public function mount()
    {
        $this->divisis = DivisiModels::all();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'divisi' => 'required',
            'nama_pelapor' => 'required|min:3',
            'keterangan' => 'required|min:3',
        ]);
    }
    public function save()
    {
        $this->validate([
            'divisi' => 'required',
            'nama_pelapor' => 'required|min:3|max:20',
            'keterangan' => 'required|min:3',
        ]);
        try {
            $kel = new Keluhan();
            $kel->id_divisi = $this->divisi;
            $kel->nama_pelapor = $this->nama_pelapor;
            $kel->keterangan = $this->keterangan;
            $kel->save();

            // Set Flash Message
            session()->flash('success');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        } catch (\Throwable $th) {
            // Set Flash Message
            session()->flash('error',$th);

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
        $this->resetInputFields();
    }
    public function render()
    {
        return view('livewire.public.form-aduan')->layout('layouts.public.base');
    }
}
