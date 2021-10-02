<?php

namespace App\Http\Livewire;

use App\Models\FeatureTeacher;
use App\Models\User;
use Livewire\Component;

class FormAddingTeacher extends Component
{
    public $user;
    public $optionUsers;
    public $dataId;

    public function mount()
    {
        $this->user = [];
//        $this->optionImajiAcademy = eloquent_to_options(ImajiAcademyFeature::get(), 'id', 'title');
        $this->optionUsers = eloquent_to_options(
            User::whereRole(2)
//                ->doesntHave('featureTeachers')
                ->get(),
            'id',
            'name'
        );
    }

    public function addTeacher()
    {
        foreach ($this->user as $user) {
            FeatureTeacher::create([
                'user_id' => $user,
                'iaf_id' => $this->dataId
            ]);
        }
        $this->user = [];
        $this->optionUsers = eloquent_to_options(
            User::whereRole(2)
//                ->doesntHave('featureTeachers')
                ->get(),
            'id',
            'name'
        );
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.iaf.show-teacher',$this->dataId));
    }

    public function render()
    {
        return view('livewire.form-adding-teacher');
    }
}
