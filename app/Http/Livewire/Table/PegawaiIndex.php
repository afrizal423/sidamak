<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;

class PegawaiIndex extends Component
{
    use WithPagination;
    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    public $id_pegawai;
    protected $listeners = [ "deleteItem" => "delete_item", "tutupModal" => "tutupModal" ];
    public $divisi, $unit_kerja, $jenis_user, $nama_pegawai, $no_hp, $alamat_pegawai;


    public function lihat($id){
        $div = $this->model::findOrFail($id);

        $this->divisi = $div->divisi->nama_divisi;
        $this->unit_kerja = $div->unit_kerja->nama_unit;
        $this->jenis_user = $div->jenis_user->nama_jenis;
        $this->nama_pegawai = $div->nama_pegawai;
        $this->no_hp = $div->no_hp;
        $this->alamat_pegawai = $div->alamat_pegawai;
        // dd($this->nama_pegawai);
        $this->openModal();
    }
    public function openModal()
    {
        $this->emit('show');
    }

    public function delete_item ($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'pegawai':
                $pegawai = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.pegawai-index',
                    "pegawais" => $pegawai
                ];
                break;

            default:
                # code...
                break;
        }
    }

    public function render()
    {
        // return view('livewire.table.pegawai-index');
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }
}
