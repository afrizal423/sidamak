<?php

namespace App\Http\Livewire\Table;

use Carbon\Carbon;
use App\Models\Keluhan;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryAduan extends Component
{
    use WithPagination;
    public $model = Keluhan::class;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    public $id_pegawai, $singledata;
    protected $listeners = [ "deleteItem" => "delete_item", "tutupModal" => "tutupModal" ];

    public $divisi, $nama_penerima, $nama_pelapor,$keterangan, $dibuat_pada, $status, $solusi;
    public $pic = [];

    public $mulaiTanggal;
    public $sampaiTanggal;

    public function lihat($id){
        $this->singledata = $this->model::findOrFail($id);
        $this->divisi = $this->singledata->divisi->nama_divisi;
        $this->nama_penerima = $this->singledata->pegawai->nama_pegawai;
        $this->nama_pelapor = $this->singledata->nama_pelapor;
        $this->pic = $this->singledata->pic;
        $this->keterangan = $this->singledata->keterangan;
        $this->solusi = $this->singledata->solusi;
        $this->dibuat_pada = $this->singledata->created_at;
        $this->status = $this->singledata->status;

        $this->openModal();
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
                    ->where('status', '=' , 1)
                    ->where('is_done_solusi', '=' , 1)
                    ->where('is_approv', '=' , 1)
                    ->whereBetween('tgl_selesai', [$this->mulaiTanggal, $this->sampaiTanggal])
                    ->orWhereBetween('tgl_dibuat', [$this->mulaiTanggal, $this->sampaiTanggal])
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    // ->orderBy('status', $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.history-aduan',
                    "progressnya" => $pegawai
                ];
                break;

            default:
                # code...
                break;
        }
    }

    public function render()
    {
        // return view('livewire.table.history-aduan');
        $data = $this->get_pagination_data();
        // dd($data['progressnya']);
        return view($data['view'], $data);
    }
}
