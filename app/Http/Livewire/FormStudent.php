<?php

namespace App\Http\Livewire;

use App\Models\ImajiAcademy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class FormStudent extends Component
{
    public $action;
    public $user;
    public $student;
    public $dataId;
    public $optionSemester;
    public $optionVillage;
    public $optionClass;
    public $optionIps;

    public function mount()
    {
        $this->optionIps = [
            ['value' => 1, 'title' => 'Iya'],
            ['value' => 0, 'title' => 'Tidak'],
        ];
        $this->optionVillage = [];
        foreach (ImajiAcademy::get() as $imajiAcademy) {
            $this->optionVillage[] = [
                'value' => $imajiAcademy->id,
                'title' => "$imajiAcademy->title - $imajiAcademy->village - $imajiAcademy->year_program",
            ];
        }
        $this->optionClass = [
            ['value' => "Paud/belum sekolah", 'title' => 'Paud/belum sekolah'],
            ['value' => "TK A", 'title' => 'TK A/nol kecil'],
            ['value' => "TK B", 'title' => 'TK B/nol besar'],
            ['value' => 1, 'title' => 'SD Kelas 1'],
            ['value' => 2, 'title' => 'SD Kelas 2'],
            ['value' => 3, 'title' => 'SD Kelas 3'],
            ['value' => 4, 'title' => 'SD Kelas 4'],
            ['value' => 5, 'title' => 'SD Kelas 5'],
            ['value' => 6, 'title' => 'SD Kelas 6'],
            ['value' => 7, 'title' => 'SMP Kelas 1'],
            ['value' => 8, 'title' => 'SMP Kelas 2'],
            ['value' => 9, 'title' => 'SMP Kelas 3'],
        ];
        $this->optionSemester = [
            ['value' => 'Gasal', 'title' => 'Gasal'],
            ['value' => 'Genap', 'title' => 'Genap'],
        ];
        $this->user = [
            'name'         => '',
            'email'        => '',
            'password'     => '-',
            'school'       => '',
            'class'        => 'Paud / belum sekolah',
            'hobby'        => '',
            'future_goal'  => '',
            'parent_name'  => '',
            'parent_job'   => '',
            'nis'          => '',
            'birthday'     => '',
            'ips'          => 0,
            'age'          => 0,
            'role'         => 3,
            'semester'     => 'gasal',
            'imaji_academy_id'      => 1,
            'birth_place'  => '',
            'birth_date'   => null,
            'year_enter' => Carbon::now()->year,
            'home_village' => '',
            'home_address' => '',
        ];
//        {{--        'birth_place', 'birth_place', 'year_program', 'semester',--}}
//        {{--        'village', 'school_grade', 'home_village', 'home_address'--}}
        if ($this->dataId != null) {
            $auth = User::find($this->dataId);
            $this->user = [
                'name'        => $auth->name,
                'nis'         => $auth->nis,
                'birthday'    => $auth->birthday,
                'user_id'     => $auth->user_id,
                'school'      => $auth->school,
                'class'       => $auth->class,
                'hobby'       => $auth->hobby,
                'future_goal' => $auth->future_goal,
                'parent_name' => $auth->parent_name,
                'parent_job'  => $auth->parent_job,

                'ips' => 0,
                'age' => 0,
            ];
            $this->student = [

            ];
        }
    }

    public function getRules()
    {
        if ($this->action == 'create') {
            return [
                'user.name'   => 'required|max:255',
                'user.school' => 'required|max:255',

            ];
        } else {
            return [
                'user.name'   => 'required|max:255',
                'user.school' => 'required|max:255',
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
        $this->user['password'] = Hash::make($this->user['password']);
        $this->user['email'] = Str::slug($this->user['name']).time();
        $this->user['nis'] = User::getCode($this->user['imaji_academy_id'],$this->user['year_enter']);
        $user = User::create($this->user);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon'    => 'success',
        ]);
        $this->emit('redirect', route('admin.student.index'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        $user = User::find($this->dataId);
        $user->update([
            'name'        => $this->user['name'],
            'school'      => $this->user['school'],
            'class'       => $this->user['class'],
            'hobby'       => $this->user['hobby'],
            'future_goal' => $this->user['future_goal'],
            'parent_name' => $this->user['parent_name'],
            'parent_job'  => $this->user['parent_job'],
            'nis'         => $this->user['nis'],
            'birthday'    => $this->user['birthday'],
        ]);


        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil diubah',
            'timeout' => 3000,
            'icon'    => 'success',
        ]);
        $this->emit('redirect', route('admin.student.index'));
    }
}
