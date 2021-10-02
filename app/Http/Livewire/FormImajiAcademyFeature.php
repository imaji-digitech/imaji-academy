<?php

namespace App\Http\Livewire;

use App\Models\Feature;
use App\Models\ImajiAcademy;
use App\Models\ImajiAcademyFeature;
use Livewire\Component;

class FormImajiAcademyFeature extends Component
{
    public $action;
    public $data;
    public $dataId;
    public $optionImajiAcademy;
    public $optionFeature;

    public function mount()
    {
        $this->data = [
            'imaji_academy_id' => 1,
            'feature_id' => 1
        ];
        $this->optionImajiAcademy = eloquent_to_options(ImajiAcademy::get(), 'id', 'title');
        $this->optionFeature = eloquent_to_options(Feature::get(), 'id', 'title');
        if ($this->dataId != null) {
            $m = ImajiAcademyFeature::find($this->dataId);
            $this->data = [
                'imaji_academy_id' => $m->imaji_academy_id,
                'feature_id' => $m->feature_id
            ];
        }
    }

    public function getRules()
    {
        return [
            'data.feature_id' => 'required',
            'data.imaji_academy_id' => 'required',
        ];
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        ImajiAcademyFeature::create([
            'imaji_academy_id' => $this->data['imaji_academy_id'],
            'feature_id' => $this->data['feature_id']
        ]);
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
