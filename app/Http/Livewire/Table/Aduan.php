<?php

namespace App\Http\Livewire\Table;

use App\Models\Keluhan;
use Livewire\Component;

class Aduan extends Component
{
    public $model = Keluhan::class;
    public $name, $search, $sortAs, $sortAsc;
    public $perPage = 10;
    public $sortField = "id";

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
            case 'Aduan':
                $aduans = $this->model::search($this->search)->with('pic')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.aduan',
                    "aduans" => $aduans
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
        // echo json_encode($data['aduans']);
        return view($data['view'], $data);

    }
}
