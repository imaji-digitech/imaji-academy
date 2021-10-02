<?php

namespace App\Http\Livewire;

use App\Models\FeatureScoreStudent;
use Livewire\Component;

class FormScoreStudent extends Component
{
    public $students;
    public $iaf;
    public $dataId;
    public $essay;

    public function mount()
    {
        $this->students = FeatureScoreStudent::whereFeatureScoreId($this->dataId)->get();
        $this->essay = [];
        foreach ($this->students as $q) {
            $this->essay[$q->id] = $q->note;
        }
    }

    public function changeScoreTheory($id, $status)
    {
        FeatureScoreStudent::find($id)->update(['score_theory' => $status]);
        $this->students = FeatureScoreStudent::whereFeatureScoreId($this->dataId)->get();
    }
    public function changeScorePractice($id, $status)
    {
        FeatureScoreStudent::find($id)->update(['score_practice' => $status]);
        $this->students = FeatureScoreStudent::whereFeatureScoreId($this->dataId)->get();
    }

    public function changeNote($id)
    {
        FeatureScoreStudent::find($id)->update(['note' => $this->essay[$id]]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Berhasil memberi keterangan',
            'timeout' => 1000,
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.form-score-student');
    }
}
