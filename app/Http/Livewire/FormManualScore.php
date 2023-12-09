<?php

namespace App\Http\Livewire;

use App\Models\FeatureActivity;
use App\Models\FeatureActivityPresence;
use App\Models\FeatureScore;
use App\Models\FeatureScoreStudent;
use App\Models\FeatureStudent;
use App\Models\PresenceStatus;
use Livewire\Component;

class FormManualScore extends Component
{
    public $optionStudent;
    public $optionScore;
    public $optionPractice;
    public $optionTheory;

    public $iaf;
    public $student;
    public $score;
    public $practice;
    public $theory;
    public $note;
    public $studentValue;

    public function mount()
    {
        $this->optionStudent = [];
        foreach (FeatureStudent::whereIafId($this->iaf)->get() as $user) {
            $this->optionStudent[] = ['value' => $user->student_id, 'title' => $user->student->name];
        }
        $this->optionScore = [];
        foreach (FeatureScore::whereIafId($this->iaf)->get() as $user) {
            $this->optionScore[] = ['value' => $user->id, 'title' => $user->module];
        }
        $this->optionTheory = [
            ['value' => '1', 'title' => 'A'],
            ['value' => '2', 'title' => 'B'],
            ['value' => '3', 'title' => 'C'],
        ];
        $this->optionPractice = [
            ['value' => '1', 'title' => 'Membanggakan'],
            ['value' => '2', 'title' => 'Cemerlang'],
            ['value' => '3', 'title' => 'Memuaskan'],
        ];
        $this->practice = 1;
        $this->theory = 1;
        $this->note = '';
        if ($this->optionScore!=null){
            $this->score=$this->optionScore[0]['value'];
        }
        if ($this->optionStudent!=null){
            $this->student=$this->optionStudent[0]['value'];
        }
    }

    public function render()
    {
        return view('livewire.form-manual-score');
    }
    public function getRules()
    {
        return [
           'studentValue'=>'required|numeric|max:100',
        ];
    }


    public function addScore()
    {
        $this->validate();
        FeatureScoreStudent::create([
            'feature_score_id'=>$this->score,
            'student_id' => $this->student,
            'score_status'=>1,
            'score'=>$this->studentValue,
            'score_practice'=>0,
            'score_theory'=>0,
            'note' => $this->note,
        ]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.score.index', $this->iaf));
    }
}
