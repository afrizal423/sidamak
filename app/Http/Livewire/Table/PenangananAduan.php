<?php

namespace App\Http\Livewire\Table;

use stdClass;
use App\Models\Keluhan;
use Livewire\Component;
use App\Models\Notifikasi;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Events\Notifikasi as EventsNotifikasi;


class PenangananAduan extends Component
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
    public function lihat($id){
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
        // notif
        $dt = new stdClass();
        $dt->text='Aduan telah selesai, silahkan approv ke halaman approval untuk mengerjakannya.';
        $dt->url=Crypt::encryptString(route('approval_aduan'));
        $dt->icon='fas fa-info';

        $nt= new Notifikasi();
        $nt->type='notifapprov';
        $nt->text=json_encode($dt);
        $nt->user_id=1;
        $nt->save();
        // disini panggil broadcast notifikasi
        broadcast(new EventsNotifikasi());
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
                    ->where('is_approv', '!=' , 1)
                    ->orderBy('status', $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.penanganan-aduan',
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
        // return view('livewire.table.status-progress');
        $data = $this->get_pagination_data();
        // dd($data['progressnya']);
        return view($data['view'], $data);
    }
}
