<?php

namespace App\Http\Livewire;

use App\Models\FeatureStudent;
use App\Models\ImajiAcademy;
use App\Models\ImajiAcademyFeature;
use App\Models\ImajiAcademyStudent;
use App\Models\Log;
use App\Models\User;
use Livewire\Component;

class FormAddingStudent extends Component
{
    public $user;
    public $optionUsers;
    public $dataId;

    public function mount()
    {
        $this->user = [];
        $this->optionUsers = eloquent_to_options(
            User::whereRole(3)
//                ->with('featureStudents')
//                ->doesntHave('featureStudents')
                ->get(),
            'id',
            'name'
        );
    }

    public function addStudent()
    {
        foreach ($this->user as $user) {
            FeatureStudent::create([
                'user_id' => $user,
                'iaf_id' => $this->dataId
            ]);
            $iaf=ImajiAcademyFeature::find($this->dataId);
            Log::create(['user_id'=>auth()->id(),'note'=>'telah menambahkan murid '.User::find($user)->name. ' ke kelas '. $iaf->feature->title. ' - '.$iaf->imajiAcademy->title]);
        }
        $this->user = [];
        $this->optionUsers = eloquent_to_options(
            User::whereRole(3)
//                ->with('featureStudents')
//                ->doesntHave('featureStudents')
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
        $this->emit('redirect', route('admin.iaf.index'));
    }

    public function render()
    {
        return view('livewire.form-adding-student');
    }
}
