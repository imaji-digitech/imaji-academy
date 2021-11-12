<?php

namespace App\Http\Livewire;

use App\Models\ImajiAcademy;
use App\Models\Log;
use Livewire\Component;

class FormImajiAcademy extends Component
{
    public $action;
    public $data;
    public $dataId;
    public $realName;

    public function mount(){
        $this->data['title']='';
        if ($this->dataId!=null){
            $this->data['title']=ImajiAcademy::find($this->dataId)->title;
            $this->realName=ImajiAcademy::find($this->dataId)->title;
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
        Log::create(['user_id'=>auth()->id(),'note'=>'telah menambahkan imaji academy '.$this->data['title']]);

        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.imaji-academy.index'));
    }

    public function update(){
        $this->validate();
        $this->resetErrorBag();
        ImajiAcademy::find($this->dataId)->update(['title'=>$this->data['title']]);
        Log::create(['user_id'=>auth()->id(),'note'=>'telah mengubah nama imaji academy '.$this->realName.' menjadi '.$this->data['title']]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.imaji-academy.index'));
    }

    public function render()
    {
        return view('livewire.form-imaji-academy');
    }
}
