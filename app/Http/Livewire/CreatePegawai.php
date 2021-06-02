<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use Livewire\Component;
use App\Models\JenisUsers;
use App\Models\UnitKerjas;
use App\Models\DivisiModels;

class CreatePegawai extends Component
{
    public $divisis, $unit_kerjas, $jenis_users, $divisiss, $unit_kerjass, $jenis_userss;
    public $divisi, $unit_kerja, $jenis_user, $nama_pegawai, $no_hp, $alamat_pegawai;
    /**
     * Variable yang huruf 's'-nya satu itu buat mengeluarkan data semua (data master)
     * Sedangkan variable yang huruf 's'-nya dua, itu buat parsing ke form ajax select2
     */
    public $pegawaiId, $action, $updateData;
    private function resetInputFields(){
        $this->nama_divisi = '';
        $this->nama_pegawai  = '';
        $this->no_hp  = '';
        $this->alamat_pegawai  = '';
        $this->divisibenerann  = '';
        $this->unit_kerja  = '';
        $this->jenis_user  = '';
        $this->divisiss = '';
        $this->unit_kerjass = '';
        $this->jenis_userss = '';
    }
    public function mounted()
    {
        if ($this->action == "ubahPegawai" && $this->pegawaiId != null) {
            # code... @if ($divisi->id == $divisi) selected @endif
            $this->updateData = Pegawai::find($this->pegawaiId);
            $this->divisiss = $this->updateData->id_divisi;
            $this->unit_kerjass = $this->updateData->id_unit;
            $this->jenis_userss = $this->updateData->id_jenis_user;
            $this->nama_pegawai = $this->updateData->nama_pegawai;
            $this->no_hp = $this->updateData->no_hp;
            $this->alamat_pegawai = $this->updateData->alamat_pegawai;
            // dd($this->updateData->nama_pegawai);
        }
        $this->divisis = DivisiModels::all();
        $this->unit_kerjas = UnitKerjas::all();
        $this->jenis_users = JenisUsers::all();
    }
    public function save()
    {
        $this->validate([
            'nama_pegawai' => 'required|min:3|max:50',
            'no_hp' => 'required|min:11|max:13',
            'alamat_pegawai' => 'required|min:5',
        ]);

        try{
            // Create Category
            Pegawai::create([
                'nama_pegawai' => $this->nama_pegawai,
                'no_hp'=> $this->no_hp,
                'alamat_pegawai' => $this->alamat_pegawai,
                'id_divisi' => $this->divisi,
                'id_unit' => $this->unit_kerja,
                'id_jenis_user' => $this->jenis_user
            ]);
            // Set Flash Message
            session()->flash('success');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
            $this->emit('saved');
            // return redirect()->route('dtpegawai');
            // return redirect('/pesan')->with(['warning' => 'Pesan Warning']);

        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error',$e);

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
    }
    public function ubah()
    {
        $this->validate([
            'nama_pegawai' => 'required|min:3|max:50',
            'no_hp' => 'required|min:11|max:13',
            'alamat_pegawai' => 'required|min:5',
        ]);

        try{
            // Create Category
            $peg = Pegawai::find($this->pegawaiId);
            $peg->update([
                'nama_pegawai' => $this->nama_pegawai,
                'no_hp'=> $this->no_hp,
                'alamat_pegawai' => $this->alamat_pegawai,
                'id_divisi' => $this->divisi,
                'id_unit' => $this->unit_kerja,
                'id_jenis_user' => $this->jenis_user
            ]);
            // Set Flash Message
            session()->flash('success');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
            $this->emit('saved');
            // return redirect()->route('dtpegawai');
            // return redirect('/pesan')->with(['warning' => 'Pesan Warning']);

        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error',$e);

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'nama_pegawai' => 'required|min:3|max:50',
            'no_hp' => 'required|min:11|max:13',
            'alamat_pegawai' => 'required|min:5',
        ]);
    }
    public function render()
    {
        $this->mounted();
        return view('livewire.create-pegawai');
    }
}
