<?php

namespace App\Http\Livewire\Table;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination;

    public $model;
    public $name;
    public $dataId;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = [ "deleteItem" => "delete_item" ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.user.new'),
                            'create_new_text' => 'Buat User Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;
            case 'student':
                $students = $this->model::searchStudent($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.student',
                    "students" => $students,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.student.create'),
                            'create_new_text' => 'Buat siswa baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;
            case 'teacher':
                $teachers = $this->model::searchTeacher($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.teacher',
                    "teachers" => $teachers,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.teacher.create'),
                            'create_new_text' => 'Buat tutor baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;
            case 'feature':
                $features = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.feature',
                    "features" => $features,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.feature.create'),
                            'create_new_text' => 'Buat Fitur Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;
            case 'imajiAcademy':
                $imajiAcademys = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.imaji-academy',
                    "imajiAcademys" => $imajiAcademys,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.imaji-academy.create'),
                            'create_new_text' => 'Buat Imaji Academy Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
            case 'imajiAcademyStudent':
                $imajiAcademys = Student::searchStudentImajiAcademy($this->search,$this->dataId)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);
//dd($imajiAcademys);
                return [
                    "view" => 'livewire.table.student',
                    "students" => $imajiAcademys,
                    "data" => array_to_object([
                        'href' => [

                        ]
                    ])
                ];
                break;
            case 'iaf':
                $iafs = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.iaf',
                    "iafs" => $iafs,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.iaf.create'),
                            'create_new_text' => 'Tambahkan Fitur pada Imaji Academy',

                        ]
                    ])
                ];
                break;
            case 'iaf-student':
                $iafs = $this->model::search($this->dataId,$this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.iaf-student',
                    "iafs" => $iafs,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.iaf.add-student',$this->dataId),
                            'create_new_text' => 'Tambahkan siswa',
                        ]
                    ])
                ];
                break;
            case 'iaf-teacher':
                $iafs = $this->model::search($this->dataId,$this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.iaf-teacher',
                    "iafs" => $iafs,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.iaf.add-teacher',$this->dataId),
                            'create_new_text' => 'Tambahkan tutor',
                        ]
                    ])
                ];
                break;
            case 'presence':
                $presences = $this->model::search($this->dataId,$this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.presence',
                    "presences" => $presences,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.presence.create',$this->dataId),
                            'create_new_text' => 'Lakukan presensi',
                        ]
                    ])
                ];
                break;
            case 'score':
                $scores = $this->model::search($this->dataId,$this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.score',
                    "scores" => $scores,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.score.create',$this->dataId),
                            'create_new_text' => 'Lakukan penilaian',
                        ]
                    ])
                ];
                break;
            case 'log':
                $logs = $this->model::search($this->dataId,$this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.log',
                    "logs" => $logs,
                    "data" => array_to_object([
                        'href' => []
                    ])
                ];
                break;
            default:
                # code...
                break;
        }
    }

    public function delete_item ($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
