<?php

namespace App\Http\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination;

    public $name, $email, $phone, $address, $state, $nationality, $cid, $image, $title, $gender, $department, $occupation, $dob, $status, $lga, $blood_group;
    protected $listeners = [
        'deleteConfirm' => 'delete',
        'deleteMutipleConfirm' => 'buckDelete'
    ];
    public $perPage = 25;
    public $form = false;
    public $checked = [];
    public $update = false;
    public $search = "";
    function refreshInputs()
    {
        $this->title = null;
        $this->email = null;
        $this->address = null;
        $this->state = null;
        $this->nationality = null;
        $this->image = null;
        $this->gender = null;
        $this->status = null;
        $this->department = null;
        $this->occupation = null;
        $this->dob = null;
        $this->blood_group = null;
        $this->lga = null;
        $this->search = null;
        $this->cid = null;
        $this->form = null;
        $this->update = null;
    }

    function add()
    {
        $this->update = false;
    }

    function showForm()
    {
        $this->form = true;
    }

    function save()
    {
        $data = $this->validate([
            'title' => 'required',
            'code' => 'required|unique:courses',
            'unit' => 'required|min:1|numeric|digits:1',
            'level_id' => 'required',
        ]);
        $saved = Course::create($data);

        if ($saved) {
            $this->form = false;

            $this->dispatchBrowserEvent('swal:success', [
                'icon' => 'success',
                'confirmButton' => '#0d2364',
                'text' => $saved->code . ' has been added to list of courses',
                'title' => 'Course added Successfully',
                'timer' => 5000,
            ]);

            $this->refreshInputs();
        }
        return redirect()->back();
    }
    public function render()
    {
        $term = "%$this->search%";
        $patients = Patient::
            where('title', 'LIKE', $term)
            ->orWhere('name', 'LIKE', $term)
            ->orWhere('patient_id', 'LIKE', $term)
            ->orWhere('gender', 'LIKE', $term)
            ->orWhere('email', 'LIKE', $term)
            ->orWhere('status', 'LIKE', $term)
            ->orWhere('phone', 'LIKE', $term)
            // ->orWhereHas('level', function (Builder $query) {
            //     $query->where('name', 'LIKE', "%$this->search%");
            // })
            ->paginate($this->perPage);
        return view('livewire.patients.index', compact(['patients']));
    }
}