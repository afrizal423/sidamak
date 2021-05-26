<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DivisiModels;



class Divisi extends Component
{
    use WithPagination;
    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';
    public $nama_divisi, $jikaUpdate, $id_divisi;
    protected $listeners = [ "deleteItem" => "delete_item", "tutupModal" => "tutupModal" ];

    private function resetInputFields(){
        $this->nama_divisi = '';
    }
    /**
     * Listener atau function yang bukan komunikasi data
     * alias popup,dll
     */
    public function ubahstatus(){
        $this->jikaUpdate = false;
    }
    public function tambah(){
        $this->resetInputFields();
        $this->ubahstatus();
        $this->openModal();
    }
    public function openModal()
    {
     $this->emit('show');
    }
    public function tutupModal()
    {
     $this->emit('tutup');
    }
    /**
     * End Listener
     */

    /**
     * Bagian komunikasi data
     */
    public function store()
    {
        $this->validate([
            'nama_divisi' => 'required'
        ]);

        try{
            // Create Category
            DivisiModels::create([
                'nama_divisi'=>$this->nama_divisi
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
    }
    public function update()
    {
        $this->validate([
            'nama_divisi' => 'required'
        ]);

        try{
            // Update
            $div = DivisiModels::find($this->id_divisi);
            $div->update([
                'nama_divisi' => $this->nama_divisi
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
            "message" => "Data " . $this->nama_divisi . " berhasil dihapus!"
        ]);
    }
     /**
      * End bagian komunikasi data
      */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
    public function edit($id){
        $div = DivisiModels::findOrFail($id);
        $this->nama_divisi = $div->nama_divisi;
        $this->id_divisi=$id;
        $this->jikaUpdate = true;
        $this->openModal();
    }
    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'divisi':
                $unit_kerjas = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.divisi',
                    "divisis" => $unit_kerjas
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
        // return view('livewire.table.divisi');
    }
}
