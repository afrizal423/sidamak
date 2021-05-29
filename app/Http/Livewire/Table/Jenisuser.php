<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;


class Jenisuser extends Component
{
    use WithPagination;
    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';
    public $nama_jenis, $jikaUpdate, $id_jenis;
    protected $listeners = [ "deleteItem" => "delete_item", "tutupModal" => "tutupModal" ];

    private function resetInputFields(){
        $this->nama_jenis = '';
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
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'nama_jenis' => 'required|min:3',
        ]);
    }
    public function store()
    {
        $this->validate([
            'nama_jenis' => 'required|min:3'
        ]);

        try{
            // Create Category
            $this->model::create([
                'nama_jenis'=>$this->nama_jenis
            ]);
            $this->tutupModal();

            // Set Flash Message
            session()->flash('success','Category Created Successfully!!');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error',$e);

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
    }
    public function update()
    {
        $this->validate([
            'nama_jenis' => 'required'
        ]);

        try{
            // Update
            $div = $this->model::find($this->id_jenis);
            $div->update([
                'nama_jenis' => $this->nama_jenis
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
            "message" => "Data " . $this->nama_jenis . " berhasil dihapus!"
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
          $jen = $this->model::findOrFail($id);
          $this->nama_jenis = $jen->nama_jenis;
          $this->id_jenis=$id;
          $this->jikaUpdate = true;
          $this->openModal();
      }

    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'jenis_user':
                $jenis_users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.jenisuser',
                    "jenis_users" => $jenis_users
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
    }
}
