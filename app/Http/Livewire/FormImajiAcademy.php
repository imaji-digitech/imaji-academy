<?php

namespace App\Http\Livewire;

use App\Models\ImajiAcademy;
use Livewire\Component;

class FormImajiAcademy extends Component
{
    public $action;
    public $data;
    public $dataId;

    public function mount(){
        $this->data['title']='';
        if ($this->dataId!=null){
            $this->data['title']=ImajiAcademy::find($this->dataId)->title;
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
        ImajiAcademy::create(['title'=>$this->data['title']]);
    }

    public function update(){
        $this->validate();
        $this->resetErrorBag();
        ImajiAcademy::find($this->dataId)->update(['title'=>$this->data['title']]);
    }

    public function render()
    {
        return view('livewire.form-imaji-academy');
    }
}
