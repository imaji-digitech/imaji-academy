<?php

namespace App\Http\Livewire;

use App\Models\FeatureScore;
use App\Models\FeatureScoreStudent;
use App\Models\FeatureStudent;
use App\Models\ImajiAcademyFeature;
use App\Models\Log;
use Livewire\Component;

class FormScore extends Component
{
    public $data;
    public $action;
    public $dataId;
    public $iaf;

    public function mount()
    {
        $this->data = [
            'user_id' => auth()->id(),
            'iaf_id' => $this->iaf,
            'module' => '',
        ];
        if ($this->dataId != null) {
            $data = FeatureScore::find($this->dataId);
            $this->data = [
                'user_id' => $data->user_id,
                'iaf_id' => $data->iaf_id,
                'module' => $data->module,
                'created_at' => $data->created_at,
            ];
        }
    }
    protected function getRules()
    {
        return ['data.module' => 'required'];
    }
    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        $fa=FeatureScore::create($this->data);
        foreach (FeatureStudent::whereIafId($this->iaf)->get() as $fs){
            FeatureScoreStudent::create([
                'feature_score_id'=>$fa->id,
                'student_id'=>$fs->student_id,
                'score_status'=>1,
                'score'=>0,
                'score_practice'=>0,
                'score_theory'=>0,
                'note'=>''
            ]);
        }
        $iaf=ImajiAcademyFeature::find($this->iaf);
        Log::create(['user_id'=>auth()->id(),'note'=>'telah melakukan penilaian pada kelas '. $iaf->feature->title. ' - '.$iaf->imajiAcademy->title]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.score.index', $this->iaf));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        FeatureScore::find($this->dataId)->update($this->data);
        $iaf=ImajiAcademyFeature::find($this->iaf);
        Log::create(['user_id'=>auth()->id(),'note'=>'telah melakukan perubahan deskripsi penilaian pada kelas '. $iaf->feature->title. ' - '.$iaf->imajiAcademy->title]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.score.index', $this->iaf));
    }
    public function render()
    {
        return view('livewire.form-score');
    }
}
