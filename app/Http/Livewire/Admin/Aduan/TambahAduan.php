<?php

namespace App\Http\Livewire\Admin\Aduan;

use App\Models\Keluhan;
use Livewire\Component;
use App\Models\DivisiModels;
use App\Models\Pegawai;

class TambahAduan extends Component
{
    public $divisis, $divisi, $divisiss, $nama_pelapor, $keterangan;
    public $action, $aduanId, $updateData;
    /**
     * Variable yang huruf 's'-nya satu itu buat mengeluarkan data semua (data master)
     * Sedangkan variable yang huruf 's'-nya dua, itu buat parsing ke form ajax select2
     */

    /**
     * UPDATE DATA
     */
    public $updateMode = false;
    public $inputs = [];
    public $dataBaru = [];
    public $i = 1, $ii=1;
    public $pic,$picnya, $hitungData, $pegawais, $datanya, $items, $nama_divisi;
    public $nama_anggota, $solusi;

    // custom select
    public string $searchText = '';
    public array $selectedIds = [];

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        $this->ii = $i;
        array_push($this->dataBaru ,$i);
        // $this->hitungData->push($this->pic);
    }
    public function remove($i)
    {
        unset($this->datanya[$i]);
        // $pos = array_search($this->pic[$i], $this->selectedIds);
        unset($this->pic[$i]);
        // dd($pos);
        // unset($this->selectedIds[$i]); // ini buat data array yg baru
        $this->i--;
    }
    public function removenew($i)
    {
        unset($this->dataBaru[$i]);
        unset($this->selectedIds[$i]);
        $this->i--;
    }
    public function choose($id)
    {
        $this->selectedIds[] = $id;
    }
    public function pilihAnggota($id)
    {
        $this->nama_anggota = $id;
    }
    public function ambilDataPegawai($id,$anggota=null)
    {
        if ($anggota) {
            $dt = Pegawai::find($this->nama_anggota);
        } else {
            $dt = Pegawai::find($this->selectedIds[$id]);
        }
        // $dt = Pegawai::find($this->selectedIds[$id]);
        return $dt->nama_pegawai;
    }

     /**
      * END UPDATE DATA
      */

    private function resetInputFields(){
        $this->nama_divisi = '';
        $this->nama_pelapor  = '';
        $this->keterangan  = '';
    }


    public function ubah()
    {
        # code...
        foreach ($this->pic as $key => $value) {
            # code...
            $this->selectedIds[] = $value; // ini buat data array yg baru kalo jadi
        }
        // $this->selectedIds[] = $this->pic;
        $ad = Keluhan::find($this->aduanId);
        $ad->id_divisi = $this->divisi;
        $ad->nama_pelapor = $this->nama_pelapor;
        $ad->keterangan = $this->keterangan;
        $ad->solusi = $this->solusi;
        $ad->save();
        //update relasi
        $ad->pic()->sync($this->selectedIds);
        if ($this->action == 'ubahAduanPenanganan') {
            # code...
            session()->flash('success_penanganan');
        } else {
            # code...
            session()->flash('success');
        }

        // dd();
        // dd($this->hitungData);

    }
    public function ubahFormUser($i)
    {
        if ($i != 'alphine') {
            # code...
            foreach ($this->pic as $key => $value) {
                # code...
                $this->selectedIds[] = $value; // ini buat data array yg baru kalo jadi
            }
        }
        // $this->selectedIds[] = $this->pic;
        $ad = Keluhan::find($this->aduanId);
        $ad->id_divisi = $this->divisiss;
        $ad->id_pegawai = $this->nama_anggota;
        $ad->nama_pelapor = $this->nama_pelapor;
        $ad->keterangan = $this->keterangan;
        $ad->status = 2;
        $ad->save();
        //update relasi
        $ad->pic()->sync($this->selectedIds);
        session()->flash('success_user');
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

    public function mount()
    {
        $this->divisis = DivisiModels::all();
        $this->pegawais = Pegawai::all();
        if ($this->action == "ubahAduan" || $this->action == "ubahAduanPenanganan" || $this->action == "ubahAduanUser" && $this->aduanId != null) {
            $this->updateData = Keluhan::find($this->aduanId);
            $this->nama_divisi = $this->updateData->divisi->nama_divisi;
            $this->divisiss = $this->updateData->id_divisi;
            $this->nama_pelapor = $this->updateData->nama_pelapor;
            $this->keterangan = $this->updateData->keterangan;
            $this->solusi = $this->updateData->solusi;

            $this->inputs = $this->updateData;
            $this->hitungData = $this->updateData->pic;
            $this->datanya = $this->updateData->pic;
            if (count($this->hitungData) > 0) {
                # code...
                $this->i = count($this->hitungData);
            }
            foreach ($this->updateData->pic as $key => $value) {
                # code...
                // $this->selectedIds[] = $value->keluhan_pic->id_pegawai; // ini buat data array yg baru kalo jadi
            }
            // echo json_encode($this->inputs);

        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'divisi' => 'required',
            'nama_pelapor' => 'required|min:3|max:20',
            'keterangan' => 'required|min:3',
        ]);
    }

    public function render()
    {
        $this->items = Pegawai::query()
            ->where('nama_pegawai', 'like', "%$this->searchText%")
            ->whereNotIn('id', $this->selectedIds)
            ->limit(10)
            ->get();
        return view('livewire.admin.aduan.tambah-aduan');
    }
}
