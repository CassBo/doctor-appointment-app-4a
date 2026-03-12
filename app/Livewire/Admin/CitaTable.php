<?php

namespace App\Livewire\Admin;

use App\Models\Cita;
use Livewire\Component;
use Livewire\WithPagination;

class CitaTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $citas = Cita::with(['patient', 'doctor', 'specialty'])
            ->where(function ($query) {
                $query->where('date', 'like', '%' . $this->search . '%')
                    ->orWhereHas('patient', function ($query) {
                        $query->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('doctor', function ($query) {
                        $query->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.cita-table', [
            'citas' => $citas,
        ]);
    }
}
