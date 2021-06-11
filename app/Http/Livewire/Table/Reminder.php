<?php

namespace App\Http\Livewire\Table;

use Session;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;
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

    public $newReminder, $isModalOpen, $isUpdate, $id_reminder;
    protected $listeners = [ "deleteItem" => "delete_item", "tutupModal" => "tutupModal" ];

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

    public function tambah ()
    {
        $this->resetNewAppointment();

        $this->newReminder['tgl_kegiatan'] = Carbon::today()
            ->format('Y-m-d');

        $this->newReminder['waktu_kegiatan'] = Carbon::today()
            ->format('H:i');

        $this->isModalOpen = true;
    }

    private function resetNewAppointment()
    {
        $this->newReminder = [
            'nama_kegiatan' => '',
            'tempat_acara' => '',
            'keterangan' => '',
            'tgl_kegiatan' => '',
            'waktu_kegiatan' => '',
            'priority' => 'normal',
        ];
    }

    public function saveReminder()
    {
        ModelsReminder::create($this->newReminder);
        // dd($this->newReminder);
        $this->isModalOpen = false;
        // Session::flash('sukses');
        session()->flash('success');
    }

    public function edit($id){
        $rmd = $this->model::findOrFail($id);
        $this->newReminder = [
            'nama_kegiatan' => $rmd->nama_kegiatan,
            'tempat_acara' => $rmd->tempat_acara,
            'keterangan' => $rmd->keterangan,
            'tgl_kegiatan' => $rmd->tgl_kegiatan,
            'waktu_kegiatan' => $rmd->waktu_kegiatan,
            'priority' => $rmd->priority,
        ];
        $this->id_reminder = $id;
        $this->isUpdate = true;
        $this->isModalOpen = true;
    }

    public function updateReminder()
    {
        try{
            // Update
            $rmd = $this->model::find($this->id_reminder);
            $rmd->update([
                'nama_kegiatan' => $this->newReminder['nama_kegiatan'],
                'tempat_acara' => $this->newReminder['tempat_acara'],
                'keterangan' => $this->newReminder['keterangan'],
                'tgl_kegiatan' => $this->newReminder['tgl_kegiatan'],
                'waktu_kegiatan' => $this->newReminder['waktu_kegiatan'],
                'priority' => $this->newReminder['priority'],
            ]);
            $this->isModalOpen = false;


            // Set Flash Message
            session()->flash('success');

            // Reset Form Fields After Creating Category
            $this->resetNewAppointment();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error',$e);

            // Reset Form Fields After Creating Category
            $this->resetNewAppointment();
        }
        $this->isUpdate = false;
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
