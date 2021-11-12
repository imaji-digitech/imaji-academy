<?php

namespace App\Http\Livewire;

use App\Models\Feature;
use App\Models\ImajiAcademyFeature;
use App\Models\Log;
use App\Models\User;
use Livewire\Component;

class FormFeature extends Component
{
    public $action;
    public $data;
    public $dataId;
    public $realName;

    public function mount(){
        $this->data['title']='';
        if ($this->dataId!=null){
            $this->data['title']=Feature::find($this->dataId)->title;
            $this->realName=Feature::find($this->dataId)->title;
        }
    }
    public function getRules()
    {
        return [
            'data.title'=>'required'
        ];
    }
    public function create(){
        $this->validate();
        $this->resetErrorBag();
        Feature::create(['title'=>$this->data['title']]);
        Log::create(['user_id'=>auth()->id(),'note'=>'telah menambahkan fitur '.$this->data['title']]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.feature.index'));
    }

    public function update(){
        $this->validate();
        $this->resetErrorBag();

        Feature::find($this->dataId)->update(['title'=>$this->data['title']]);
        Log::create(['user_id'=>auth()->id(),'note'=>'telah mengubah nama fitur '.$this->realName.' menjadi '.$this->data['title']]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.feature.index'));
    }

    public function render()
    {
        return view('livewire.form-feature');
    }
}
