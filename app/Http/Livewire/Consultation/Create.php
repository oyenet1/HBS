<?php

namespace App\Http\Livewire\Consultation;

use App\Models\Inventory;
use App\Models\User;
use App\Models\Patient;
use Livewire\Component;

class Create extends Component
{
    public $patient_id, $user_id, $admitted, $fee, $purpose, $visited_at, $checkout_at, $status, $inventory_id, $consultation_id, $quantity = 1;

    function refreshInputs()
    {
        $this->patient_id = null;
        $this->user_id = null;
        $this->admitted = null;
        $this->fee = null;
        $this->purpose = null;
        $this->quantity = null;
        $this->visited_at = null;
        $this->checkout_at = null;
        $this->status = null;
        $this->inventory_id = null;
        $this->consultation_id = null;
    }

    function save()
    {
        $data = $this->validate([
            'patient_id' => "required",
            'user_id' => 'nullable',
            'admitted' => 'nullable',
            'purpose' => 'required',
            'quantity.*' => 'nullable|numeric',
            'fee' => 'required|numeric',
            'visited_at' => 'required|before_or_equal:today',
            'checkout_at' => 'nullable|after_or_equal:today',
            'inventory_id.*' => 'required',
            'consultation_id.*' => 'nullable',
        ]);

    }
    public function render()
    {
        $patients = Patient::select(['id', 'name'])->get();
        $doctors = User::whereRelation('roles', 'name', 'doctor')->get();
        $inventories = Inventory::all();
        return view('livewire.consultation.create', compact(['patients', 'doctors', 'inventories']));
    }
}