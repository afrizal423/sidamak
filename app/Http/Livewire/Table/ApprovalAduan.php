<?php

namespace App\Http\Livewire\Table;

use Carbon\Carbon;
use App\Models\Keluhan;
use Livewire\Component;
use Livewire\WithPagination;

class ApprovalAduan extends Component
{
    use WithPagination;
    public $model = Keluhan::class;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    public $id_aduan, $singledata;
    protected $listeners = [ "deleteItem" => "delete_item", "tutupModal" => "tutupModal" ];

    public $divisi, $nama_penerima, $nama_pelapor,$keterangan, $dibuat_pada, $status, $solusi;
    public $pic = [];
    public $selectedtypes = [];
    public $selectAll = false;

    public function updatedSelectAll($id){
        if ($id) {
            $this->selectedtypes = $this->model::pluck('id');
        } else {
            $this->selectedtypes = [];
        }

    }
    public function penilaian($id, $tmpnilai){
        $nilai='';
        switch ($tmpnilai) {
            case '0':
                $nilai = 'Kurang';
                break;
            case '1':
                $nilai = 'Baik';
                break;
            case '2':
                $nilai = 'Sangat Baik';
                break;

            default:
                break;
        }
        dd($nilai, $id);
    }
    public function approv(){
        $this->model::query()
            ->whereIn('id',$this->selectedtypes)
            ->update([
                'is_approv' => true,
                'status' => 1,
                'tgl_selesai' => Carbon::now()
            ]);
        $this->selectedtypes = [];
        $this->selectAll = false;
        session()->flash('success','Category Created Successfully!!');
    }
    public function lihat($id){
        // $this->approv();
        $this->singledata = $this->model::findOrFail($id);
        $this->divisi = $this->singledata->divisi->nama_divisi;
        $this->nama_penerima = $this->singledata->pegawai->nama_pegawai;
        $this->nama_pelapor = $this->singledata->nama_pelapor;
        $this->pic = $this->singledata->pic;
        $this->keterangan = $this->singledata->keterangan;
        $this->dibuat_pada = $this->singledata->created_at;
        $this->status = $this->singledata->status;

        $this->openModal();
    }

    public function solusi($id){
        $this->singledata = $this->model::findOrFail($id);
        $this->divisi = $this->singledata->divisi->nama_divisi;
        $this->nama_penerima = $this->singledata->pegawai->nama_pegawai;
        $this->nama_pelapor = $this->singledata->nama_pelapor;
        $this->pic = $this->singledata->pic;
        $this->keterangan = $this->singledata->keterangan;
        $this->dibuat_pada = $this->singledata->created_at;
        $this->status = $this->singledata->status;
        $this->id_aduan = $id;
        $this->solusi = $this->singledata->solusi;

        $this->openModalsolusi();
    }
    public function simpanSolusi()
    {
        $this->validate([
            'solusi' => 'required|min:5'
        ]);

        $dt = $this->model::findOrFail($this->id_aduan);
        $dt->update([
            'solusi' => $this->solusi,
            'is_done_solusi' => true
        ]);
        $this->tutupModal();
        session()->flash('success','Category Created Successfully!!');
    }
    public function tutupModal()
    {
     $this->emit('tutup');
    }
    public function openModalsolusi()
    {
        $this->emit('showsolusi');
    }
    public function openModal()
    {
        $this->emit('show');
    }

    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'progressnya':
                $pegawai = $this->model::search($this->search)
                    ->where('status', '!=' , 0)
                    ->where('status', '!=' , 1)
                    ->where('is_approv', '=' , 0)
                    ->orderBy('status', $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.approval-aduan',
                    "aduans" => $pegawai
                ];
                break;

            default:
                # code...
                break;
        }
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
        // return view('livewire.table.approval-aduan');
    }
}
