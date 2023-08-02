<?php

namespace App\Imports;


use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithHeadingRow
{
    public $imaji_academy_id;

    public function __construct($imaji_academy_id)
    {
        $this->imaji_academy_id = $imaji_academy_id;
    }


    public function collection(Collection $collection)
    {
        foreach ($collection as $row){

            try{
                Student::create([
                    'imaji_academy_id'=>$this->imaji_academy_id,
                    'name'=>$row['nama_anak'],
                    'address'=>$row['desa'],
                    'school'=>$row['asal_lembaga'],
                    'class'=>$row['kelas'],
                    'age'=>$row['usia'],
                    'nis'=>Student::getCode($this->imaji_academy_id,now()->year)
                ]);
            }catch (\Exception $exception){}
        }
    }
}
