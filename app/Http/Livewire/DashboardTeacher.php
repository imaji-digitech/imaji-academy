<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DashboardTeacher extends Component
{
    public $user;
    public $activity;
    public function mount()
    {
        $this->activity=0;
        $this->user=auth()->user();
        foreach ($this->user->featureTeachers as $ft){
            $this->activity+=$ft->imajiAcademyFeature->featureActivities->count();
        }

    }

    public function render()
    {
        return view('livewire.dashboard-teacher');
    }
}
