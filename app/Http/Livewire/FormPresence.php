<?php

namespace App\Http\Livewire;

use App\Models\FeatureActivity;
use App\Models\FeatureActivityPresence;
use App\Models\FeatureStudent;
use Livewire\Component;

class FormPresence extends Component
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
            'note' => '',
        ];
        if ($this->dataId != null) {
            $data = FeatureActivity::find($this->dataId);
            $this->data = [
                'user_id' => $data->user_id,
                'iaf_id' => $data->iaf_id,
                'module' => $data->module,
                'note' => $data->note,
                'created_at' => $data->created_at,
            ];
        }
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        $fa=FeatureActivity::create($this->data);
        foreach (FeatureStudent::whereIafId($this->iaf)->get() as $fs){
            FeatureActivityPresence::create([
                'presence_status_id'=>5,
                'user_id'=>$fs->user_id,
                'feature_activity_id'=>$fa->id,
                'note'=>''
            ]);
        }
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.presence.index', $this->iaf));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        FeatureActivity::find($this->dataId)->update($this->data);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.presence.index', $this->iaf));
    }

    public function render()
    {
        return view('livewire.form-presence');
    }

    protected function getRules()
    {
        return ['data.module' => 'required'];
    }
}
