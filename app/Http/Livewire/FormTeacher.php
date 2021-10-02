<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormTeacher extends Component
{
    public $action;
    public $user;
    public $teacher;
    public $dataId;

    public function mount()
    {
        $this->user = [
            'name' => '',
            'email' => '',
            'password' => '',
        ];
        $this->teacher = [
            'school' => '',
        ];
        if ($this->dataId != null) {
            $auth = User::find($this->dataId);
            $this->user = [
                'name' => $auth->name,
                'email' => $auth->email,
                'password' => '',
            ];
            $this->teacher = [
                'user_id' => $auth->student->user_id,
                'school' => $auth->student->school,
            ];
        }
    }

    public function getRules()
    {
        if ($this->action == 'create') {
            return [
                'user.name' => 'required|max:255',
                'user.email' => 'email|required|max:255',
                'user.password' => 'required|max:255'
            ];
        } else {
            return [
                'user.name' => 'required|max:255',
                'user.email' => 'email|required|max:255',
            ];
        }
    }

    public function render()
    {
        return view('livewire.form-teacher');
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        $user = User::create([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'password' => Hash::make($this->user['password']),
            'role' => 3
        ]);
        $teacher = Teacher::create([
            'user_id' => $user->id,
            'school' => $this->teacher['school'],
        ]);
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        $user = User::find($this->dataId);
        $user->update([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
        ]);
        $teacher = Teacher::whereUserId($this->dataId)->update([
            'school' => $this->teacher['school'],
        ]);

        if ($this->user['password'] != '') {
            $user = User::find($this->dataId)->update([
                'password' => Hash::make($this->user['password']),
            ]);
        }
    }
}
