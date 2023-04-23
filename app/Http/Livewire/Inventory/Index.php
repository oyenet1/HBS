<?php

namespace App\Http\Livewire\Inventory;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads, WithPagination;
    protected $listeners = [
        'deleteConfirm' => 'delete',
        'deleteMutipleConfirm' => 'buckDelete'
    ];
    public $perPage = 25;
    public $form = false;
    public $checked = [];
    public $update = false;
    public $search = "";
    public function render()
    {
        $term = "%$this->search%";
        $inventories = Inventory::
            where('code', 'LIKE', $term)
            ->orWhere('name', 'LIKE', $term)
            ->orWhere('price', 'LIKE', $term)
            ->orWhere('category', 'LIKE', $term)
            // ->orWhereHas('level', function (Builder $query) {
            //     $query->where('name', 'LIKE', "%$this->search%");
            // })
            ->paginate($this->perPage);
        return view('livewire.inventory.index', compact(['inventories']));
    }
}