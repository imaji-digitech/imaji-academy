<?php

namespace App\Http\Livewire;

use App\Models\FeatureActivityPresence;
use Livewire\Component;

class StudentPresence extends Component
{
    public $iaf;
    public $dataId;
    public $essay;
    public $query;

    public function mount()
    {
        $students = FeatureActivityPresence::whereFeatureActivityId($this->dataId);
        $this->essay = [];
        foreach ($students as $q) {
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
        $students = $this->setData();
//        dd($students);
        return view('livewire.student-presence', compact('students'));
    }

    public function setData()
    {
        $query = $this->query;
        if ($this->query != null) {
            $students = FeatureActivityPresence::whereFeatureActivityId($this->dataId)
                ->whereHas('student', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->get();
        } else {
            $students = FeatureActivityPresence::whereFeatureActivityId($this->dataId)->get();
        }

        return $students;
    }
}
