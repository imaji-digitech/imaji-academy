<?php

namespace App\Http\Livewire;

use App\Models\FeatureScore;
use App\Models\FeatureScoreStudent;
use App\Models\FeatureStudent;
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
                'user_id'=>$fs->user_id,
                'score_practice'=>0,
                'score_theory'=>0,
                'note'=>''
            ]);
        }
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
