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
        ];
        $this->student = [
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
            ];
            $this->student = [
                'user_id' => $auth->student->user_id,
                'school' => $auth->student->school,
                'class' => $auth->student->class,
                'hobby' => $auth->student->hobby,
                'future_goal' => $auth->student->future_goal,
                'parent_name' => $auth->student->parent_name,
                'parent_job' => $auth->student->parent_job,
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
            'role' => 3
        ]);
        $student = Student::create([
            'user_id' => $user->id,
            'school' => $this->student['school'],
            'class' => $this->student['class'],
            'hobby' => $this->student['hobby'],
            'future_goal' => $this->student['future_goal'],
            'parent_name' => $this->student['parent_name'],
            'parent_job' => $this->student['parent_job'],
        ]);
        $this->user = [
            'name' => '',
            'email' => '',
            'password' => '',
        ];
        $this->student = [
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
        ]);
        $student = Student::whereUserId($this->dataId)->update([
            'school' => $this->student['school'],
            'class' => $this->student['class'],
            'hobby' => $this->student['hobby'],
            'future_goal' => $this->student['future_goal'],
            'parent_name' => $this->student['parent_name'],
            'parent_job' => $this->student['parent_job'],
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
