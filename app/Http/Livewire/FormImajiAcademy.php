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

    public function mount()
    {
        $this->data['title'] = '';
        $this->data['code'] = '';
        $this->data['village'] = '';
        $this->data['village_program'] = '';
        $this->data['year_program'] = '';
        $this->data['year_program_code'] = '';
        $this->data['village_code'] = '';
        $this->data['note'] = '';

        if ($this->dataId != null) {
            $im=ImajiAcademy::find($this->dataId);
            $this->data['title'] = $im->title;
            $this->data['village'] = $im->village;
            $this->data['code'] = $im->code;
            $this->data['village_program'] = $im->title;
            $this->data['year_program'] = $im->year_program;
            $this->data['year_program_code'] = $im->year_program_code;
            $this->data['village_code'] = $im->village_code;
            $this->data['note'] = $im->note;
            $this->realName = $im->title;
        }
    }

    public function getRules()
    {
        return [
            'data.title' => 'required'
        ];
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        ImajiAcademy::create(['title' => $this->data['title']]);
        Log::create(['user_id' => auth()->id(), 'note' => 'telah menambahkan imaji academy ' . $this->data['title']]);

        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.imaji-academy.index'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        ImajiAcademy::find($this->dataId)->update($this->data);
        Log::create(['user_id' => auth()->id(), 'note' => 'telah mengubah nama imaji academy ' . $this->realName . ' menjadi ' . $this->data['title']]);
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
