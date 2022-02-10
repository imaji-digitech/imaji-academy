<?php

namespace App\Http\Livewire;

use App\Models\FeatureActivityPresence;
use App\Models\FeatureReport;
use Livewire\Component;

class StudentReport extends Component
{
    public $students;
    public $iaf;
    public $dataId;
    public $essay;

    public function mount()
    {
        $this->students = FeatureReport::whereIafId($this->dataId)->get();
        $this->essay = [];
        foreach ($this->students as $q) {
            $this->essay[$q->id] = $q->note;
        }
    }

    public function changeAttitude($id, $status)
    {
        $this->students->find($id)->update(['attitude' => $status]);
    }
//    public function changeCourtesy($id, $status)
//    {
//        $this->students->find($id)->update(['courtesy' => $status]);
//    }

    public function changeNote($id)
    {
        $this->students->find($id)->update(['note' => $this->essay[$id]]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Berhasil memberi keterangan',
            'timeout' => 1000,
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.student-report');
    }
}
