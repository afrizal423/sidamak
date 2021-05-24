<?php

namespace App\Http\Livewire\Table;
use App\Models\UnitKerjas;
use Livewire\Component;
use Livewire\WithPagination;


class Unitkerja extends Component
{
    use WithPagination;

    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';
    public $nama_unit, $jikaUpdate, $id_unit;
    protected $listeners = [ "deleteItem" => "delete_item", "tutupModal" => "tutupModal" ];

    private function resetInputFields(){
        $this->nama_unit = '';
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();

    }
    public function openModal()
    {
     $this->emit('show');
    }

    public function tutupModal()
    {
     $this->emit('tutup');
    }

    public function store()
    {
        $this->validate([
            'nama_unit' => 'required'
        ]);

        try{
            // Create Category
            UnitKerjas::create([
                'nama_unit'=>$this->nama_unit
            ]);
            $this->tutupModal();

            // Set Flash Message
            session()->flash('success','Category Created Successfully!!');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error','Something goes wrong while creating category!!');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
        $this->tutupModal();
    }



    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'unit_kerjas':
                $unit_kerjas = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.unitkerja',
                    "unit_kerjas" => $unit_kerjas
                ];
                break;

            default:
                # code...
                break;
        }
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
            "message" => "Data " . $this->nama_unit . " berhasil dihapus!"
        ]);
    }

    public function ubahstatus(){
        $this->jikaUpdate = false;
        // $this->openModal();
    }
    public function tambah(){
        $this->resetInputFields();
        $this->ubahstatus();
        $this->openModal();
    }

    public function edit($id){
        $category = UnitKerjas::findOrFail($id);
        $this->nama_unit = $category->nama_unit;
        $this->id_unit=$id;
        $this->jikaUpdate = true;
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'nama_unit' => 'required'
        ]);

        try{
            // Create
            $user = UnitKerjas::find($this->id_unit);
            $user->update([
                'nama_unit' => $this->nama_unit
            ]);
            $this->tutupModal();


            // Set Flash Message
            session()->flash('success');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error',$e);

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }
        $this->jikaUpdate = false;
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view($data['view'], $data);

        // return view('livewire.table.unitkerja');
    }
}
