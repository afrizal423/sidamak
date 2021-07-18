<?php

namespace App\Http\Livewire\Publik;

use stdClass;
use Carbon\Carbon;
use App\Models\Keluhan;
use Livewire\Component;
use App\Events\NewAduan;
use App\Models\Notifikasi;
use App\Models\DivisiModels;
use Illuminate\Support\Facades\Crypt;
use App\Events\Notifikasi as EventsNotifikasi;


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
            $kel->tgl_dibuat = Carbon::now();
            $kel->save();

            // Set Flash Message
            session()->flash('success');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
            broadcast(new NewAduan('aduan baru'));

            // notif
            $dt = new stdClass();
            $dt->text='Ada aduan masuk, silahkan ke halaman dashboard untuk mengerjakannya.';
            $dt->url=Crypt::encryptString(route('dashboard_user'));
            $dt->icon='fas fa-info';

            $nt= new Notifikasi();
            $nt->type='notifaduan';
            $nt->text=json_encode($dt);
            $nt->user_id=2;
            $nt->save();
            // disini panggil broadcast notifikasi
            broadcast(new EventsNotifikasi());

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
        return view('livewire.publik.form-aduan')->layout('layouts.public.base');
    }
}
