<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DashboardAdmin extends Component
{
    use WithPagination;
    public $model;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    private function queryNya(){
        $dt = DB::table('pegawai as pgw')
            ->select(DB::raw('pgw.id, pgw.nama_pegawai, (SELECT count(*)
            FROM `pegawai` as pg
            inner join keluhan_pegawai as kp
            on pgw.id = kp.id_pegawai
            inner join keluhan as k
            on kp.id_keluhan = k.id
            where pgw.id = pg.id
            and k.status = 1 and k.is_approv = 1 and k.is_done_solusi = 1) as selesai ,
            (SELECT count(*)
            FROM `pegawai` as pg
            inner join keluhan_pegawai as kp
            on pgw.id = kp.id_pegawai
            inner join keluhan as k
            on kp.id_keluhan = k.id
            where pgw.id = pg.id
            and k.status = 3 and k.is_approv = 0 and k.is_done_solusi = 1) as pending ,
            (SELECT count(*)
            FROM `pegawai` as pg
            inner join keluhan_pegawai as kp
            on pgw.id = kp.id_pegawai
            inner join keluhan as k
            on kp.id_keluhan = k.id
            where pgw.id = pg.id
            and k.status = 2 and k.is_approv = 0 and k.is_done_solusi = 0) as progress'))
            ;
        return $dt;
    }
    private function cari($query)
    {
        return empty($query) ? $this->queryNya()
            : $this->queryNya()->where('nama_pegawai', 'like', '%'.$query.'%');
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
        $pegawai = $this->cari($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

        return [
            "view" => 'livewire.table.dashboard-admin',
            "pegawais" => $pegawai
        ];
    }

    public function render()
    {
        // return view('livewire.table.dashboard-admin');
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }
}
