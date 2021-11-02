<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormStudent extends Component
{
    public $action;
    public $user;
    public $student;
    public $dataId;

    public function mount()
    {
        $this->user = [
            'name' => '',
            'email' => '',
            'password' => '',
            'school' => '',
            'class' => '',
            'hobby' => '',
            'future_goal' => '',
            'parent_name' => '',
            'parent_job' => '',
        ];
        if ($this->dataId != null) {
            $auth = User::find($this->dataId);
            $this->user = [
                'name' => $auth->name,
                'email' => $auth->email,
                'password' => '',
                'user_id' => $auth->user_id,
                'school' => $auth->school,
                'class' => $auth->class,
                'hobby' => $auth->hobby,
                'future_goal' => $auth->future_goal,
                'parent_name' => $auth->parent_name,
                'parent_job' => $auth->parent_job,
            ];
            $this->student = [

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
        return view('livewire.form-student');
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        $user = User::create([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'password' => Hash::make($this->user['password']),
            'role' => 3,
            'school' => $this->user['school'],
            'class' => $this->user['class'],
            'hobby' => $this->user['hobby'],
            'future_goal' => $this->user['future_goal'],
            'parent_name' => $this->user['parent_name'],
            'parent_job' => $this->user['parent_job'],
        ]);
        $this->user = [
            'name' => '',
            'email' => '',
            'password' => '',
            'school' => '',
            'class' => '',
            'hobby' => '',
            'future_goal' => '',
            'parent_name' => '',
            'parent_job' => '',
        ];
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
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
            'school' => $this->user['school'],
            'class' => $this->user['class'],
            'hobby' => $this->user['hobby'],
            'future_goal' => $this->user['future_goal'],
            'parent_name' => $this->user['parent_name'],
            'parent_job' => $this->user['parent_job'],
        ]);

        if ($this->user['password'] != '') {
            $user = User::find($this->dataId)->update([
                'password' => Hash::make($this->user['password']),
            ]);
        }
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.feature.index'));
    }
}
