<?php

namespace App\Http\Livewire\Consultation;

use App\Models\Consultation;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $cid;
    use WithPagination;
    public $checked = [];
    protected $listeners = [
        'deleteConfirm' => 'delete',
        'deleteMutipleConfirm' => 'buckDelete'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(Consultation $consult)
    {

        $this->cid = $consult->id;
        $this->dispatchBrowserEvent('swal:confirm');
    }

    public function delete()
    {

        $consult = Consultation::findOrFail($this->cid);
        $true = $consult->delete();

        if ($true) {
            $this->dispatchBrowserEvent('swal:success', [
                'icon' => 'success',
                'text' => 'Record has been removed from the system including all the associated data(invoices)',
                'title' => 'Deleted Successfully',
                'timer' => 5000,
            ]);
        }
        $this->refreshInputs();
    }
    public function render()
    {
        return view('livewire.consultation.index');
    }
}