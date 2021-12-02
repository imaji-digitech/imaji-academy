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
            'nis' => '',
            'birthday' => '',
            'ips' => 0,
            'age' => 0,
            'role' => 3
        ];
        if ($this->dataId != null) {
            $auth = User::find($this->dataId);
            $this->user = [
                'name' => $auth->name,
                'email' => $auth->email,
                'nis' => $auth->nis,
                'birthday' => $auth->birthday,
                'password' => '',
                'user_id' => $auth->user_id,
                'school' => $auth->school,
                'class' => $auth->class,
                'hobby' => $auth->hobby,
                'future_goal' => $auth->future_goal,
                'parent_name' => $auth->parent_name,
                'parent_job' => $auth->parent_job,

                'ips' => 0,
                'age' => 0
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
                'user.password' => 'required|max:255',
                'user.school' => 'require|max:255',
                'user.class' => 'require|max:255',
                'user.hobby' => 'require|max:255',
                'user.future_goal' => 'require|max:255',
                'user.parent_name' => 'require|max:255',
                'user.parent_job' => 'require|max:255',
                'user.nis' => 'require|max:255',
                'user.birthday' => 'require|max:255',
                'user.ips' => 'require|max:255',
                'user.age' => 'require|max:255',
                'user.role' =>'require|max:255'
            ];
        } else {
            return [
                'user.name' => 'required|max:255',
                'user.email' => 'email|required|max:255',
                'user.school' => 'require|max:255',
                'user.class' => 'require|max:255',
                'user.hobby' => 'require|max:255',
                'user.future_goal' => 'require|max:255',
                'user.parent_name' => 'require|max:255',
                'user.parent_job' => 'require|max:255',
                'user.nis' => 'require|max:255',
                'user.birthday' => 'require|max:255',
                'user.ips' => 'require|max:255',
                'user.age' => 'require|max:255',
                'user.role' =>'require|max:255'
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
        $this->user['password'] = Hash::make($this->user['password']);
        $user = User::create($this->user);
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
            'nis' => $this->user['nis'],
            'birthday' => $this->user['birthday'],
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
        $this->emit('redirect', route('admin.student.index'));
    }
}
