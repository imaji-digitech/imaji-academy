<?php

namespace App\Http\Livewire;

use App\Models\FeatureActivity;
use App\Models\FeatureActivityPresence;
use App\Models\FeatureStudent;
use App\Models\PresenceStatus;
use Livewire\Component;

class FormManualPresence extends Component
{
    public $optionStudent;
    public $optionPresence;
    public $optionStatusPresence;
    public $iaf;
    public $student;
    public $presence;
    public $status;
    public $note;

    public function mount()
    {
        $this->note='';
        $this->optionStudent = [];
        foreach (FeatureStudent::whereIafId($this->iaf)->get() as $user) {
            array_push($this->optionStudent, ['value' => $user->user_id, 'title' => $user->user->name]);
        }
        $this->optionPresence = [];
        foreach (FeatureActivity::whereIafId($this->iaf)->get() as $user) {
            array_push($this->optionPresence, ['value' => $user->id, 'title' => $user->module]);
        }
        $this->optionStatusPresence = eloquent_to_options(PresenceStatus::get(),'id','title');
        $this->status=1;
        if ($this->optionPresence!=null){
            $this->presence=$this->optionPresence[0]['value'];
        }
        if ($this->optionStudent!=null){
            $this->student=$this->optionStudent[0]['value'];
        }
    }

    public function render()
    {
        return view('livewire.form-manual-presence');
    }

    public function addPresence()
    {
        FeatureActivityPresence::create([
            'presence_status_id' => $this->status,
            'student_id' => $this->student,
            'feature_activity_id' => $this->presence,
            'note' => $this->note
        ]);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.presence.index', $this->iaf));
    }
}
