<?php

namespace App\Http\Livewire;

use App\Models\FeatureActivityPresence;
use Livewire\Component;

class StudentPresence extends Component
{
    public $students;
    public $iaf;
    public $dataId;
    public $essay;

    public function mount()
    {
        $this->students = FeatureActivityPresence::whereFeatureActivityId($this->dataId)->get();
        $this->essay = [];
        foreach ($this->students as $q) {
            $this->essay[$q->id] = $q->note;
        }
    }

    public function change($id, $status)
    {
        FeatureActivityPresence::find($id)->update(['presence_status_id' => $status]);
        $this->students = FeatureActivityPresence::whereFeatureActivityId($this->dataId)->get();
    }

    public function changeNote($id)
    {
        FeatureActivityPresence::find($id)->update(['note' => $this->essay[$id]]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Berhasil memberi keterangan',
            'timeout' => 1000,
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.student-presence');
    }
}
