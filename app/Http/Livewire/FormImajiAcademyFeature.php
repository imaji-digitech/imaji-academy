<?php

namespace App\Http\Livewire;

use App\Models\Feature;
use App\Models\ImajiAcademy;
use App\Models\ImajiAcademyFeature;
use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class FormImajiAcademyFeature extends Component
{
    public $action;
    public $data;
    public $dataId;
    public $optionImajiAcademy;
    public $optionFeature;
    public $optionSemester;

    public function mount()
    {
        $this->optionSemester = [
            ['value' => 'Gasal', 'title' => 'Gasal'],
            ['value' => 'Genap', 'title' => 'Genap'],
        ];
        $this->data = [
            'imaji_academy_id' => 1,
            'feature_id' => 1,
            'year_program'=> Carbon::now()->year,
            'semester'=>'gasal'
        ];
        $this->optionImajiAcademy = eloquent_to_options(ImajiAcademy::get(), 'id', 'title');
        $this->optionFeature = eloquent_to_options(Feature::get(), 'id', 'title');
        if ($this->dataId != null) {
            $m = ImajiAcademyFeature::find($this->dataId);
            $this->data = [
                'imaji_academy_id' => $m->imaji_academy_id,
                'feature_id' => $m->feature_id,
                'year_program'=> $m->year_program,
                'semester'=>$m->semester
            ];
        }
    }

    public function getRules()
    {
        return [
            'data.feature_id' => 'required',
            'data.imaji_academy_id' => 'required',
            'data.year_program'=>'required',
            'data.semester'=>'required',
        ];
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        ImajiAcademyFeature::create($this->data);
        Log::create(['user_id'=>auth()->id(),
            'note'=>'telah menambahkan fitur '
                .Feature::find($this->data['feature_id'])->title. ' ke '
                .ImajiAcademy::find($this->data['imaji_academy_id'])])->title;
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
        ImajiAcademyFeature::find($this->dataId)->update([
            'imaji_academy_id' => $this->data['imaji_academy_id'],
            'feature_id' => $this->data['feature_id']
        ]);
    }

    public function render()
    {
        return view('livewire.form-imaji-academy-feature');
    }
}
