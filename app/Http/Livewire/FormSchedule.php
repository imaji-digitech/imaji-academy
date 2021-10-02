<?php

namespace App\Http\Livewire;

use App\Models\FeatureSchedule;
use Livewire\Component;

class FormSchedule extends Component
{
    public $data;
    public $action;
    public $optionDay;
    public $dataId;
    public $iaf;
    public $optionIaf;

    public function mount()
    {
        $this->optionIaf = [];
        foreach (auth()->user()->featureTeachers as $ss) {
            array_push(
                $this->optionIaf,
                [
                    'title' => $ss->imajiAcademyFeature->imajiAcademy->title . " " . $ss->imajiAcademyFeature->feature->title,
                    'value'=>$ss->iaf_id
                ]
            );
        }
        $this->optionDay = [
            ['title' => 'Minggu', 'value' => '0'],
            ['title' => 'Senin', 'value' => '1'],
            ['title' => 'Selasa', 'value' => '2'],
            ['title' => 'Rabu', 'value' => '3'],
            ['title' => 'Kamis', 'value' => '4'],
            ['title' => 'Jumat', 'value' => '5'],
            ['title' => 'Sabtu', 'value' => '6'],

        ];
        $this->data = [
            'iaf_id' => 1,
            'day' => 0,
            'time' => '',
        ];
        if ($this->dataId != null) {
            $data = FeatureSchedule::find($this->dataId);
            $this->data = [
                'iaf_id' => $data->iaf,
                'day' => $data->day,
                'time' => $data->time,
            ];
        }
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        FeatureSchedule::create($this->data);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.schedule.index'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        FeatureSchedule::find($this->dataId)->update($this->data);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.schedule.index'));
    }

    public function render()
    {
        return view('livewire.form-schedule');
    }

    protected function getRules()
    {
        return [
            'data.day' => 'required',
            'data.time' => 'required',
        ];
    }
}
