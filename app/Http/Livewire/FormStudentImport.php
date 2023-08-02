<?php

namespace App\Http\Livewire;

use App\Imports\StudentImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class FormStudentImport extends Component
{
    use WithFileUploads;
    public $action;
    public $imajiAcademyId;
    public $file;

    public function import()
    {

        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.form-student-import');
    }
}
