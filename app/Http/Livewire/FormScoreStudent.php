<?php

namespace App\Http\Livewire;

use App\Models\FeatureScoreStudent;
use Livewire\Component;

class FormScoreStudent extends Component
{
    public $students;
    public $score;
    public $iaf;
    public $dataId;
    public $essay;
    public $query;
    protected $rules = [
        'score.*' => 'required|numeric|max:100',
    ];

    public function mount()
    {
        $this->students = FeatureScoreStudent::whereFeatureScoreId($this->dataId)->get();
        $this->essay = [];
        foreach ($this->students as $q) {
            $this->essay[$q->id] = $q->note;
            $this->score[$q->id] = $q->score;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


//    protected $messages = [
//        'score.required' => 'aa',
//    ];

    public function changeScore($id)
    {
        $this->validate();
        if (is_numeric($this->score[$id])) {
            FeatureScoreStudent::find($id)->update(['score' => $this->score[$id]]);
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
        $studentss = $this->getData();
        return view('livewire.form-score-student', compact('studentss'));
    }

    public function getData()
    {
        $query = $this->query;
        if ($this->query == null) {
            $student = FeatureScoreStudent::whereFeatureScoreId($this->dataId)->get();
        } else {
            $student = FeatureScoreStudent::whereFeatureScoreId($this->dataId)
                ->whereHas('student', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })->get();
        }
        return $student;
    }
}
