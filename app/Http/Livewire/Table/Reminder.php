<?php

namespace App\Http\Livewire\Table;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Reminder as ModelsReminder;

class Reminder extends Component
{
    public $model = ModelsReminder::class;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    public $id_pegawai;
    protected $listeners = [ "deleteItem" => "delete_item", "tutupModal" => "tutupModal" ];


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
        Carbon::setLocale('id');
        switch ($this->name) {
            case 'reminder':
                $cur_date=Carbon::today();
                DB::enableQueryLog();
                $pegawai = $this->model::search($this->search)
                    ->select('*', DB::raw("DATEDIFF(`tgl_kegiatan`,'".$cur_date->format("Y-m-d")."') as `days`"))
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
                $query = DB::getQueryLog();

                return [
                    "view" => 'livewire.table.reminder',
                    "reminders" => $pegawai
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
        // dd($data['reminders']);
        return view($data['view'], $data);

    }
}
