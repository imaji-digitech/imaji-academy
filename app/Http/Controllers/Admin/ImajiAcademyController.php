<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\ImajiAcademy;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImajiAcademyController extends Controller
{
    public function index()
    {
        $imajiAcademy = ImajiAcademy::class;
        return view('pages.admin.imaji-academy.index', compact('imajiAcademy'));
    }

    public function create()
    {
        return view('pages.admin.imaji-academy.create');
    }

    public function show($id)
    {
        return view('pages.admin.imaji-academy.show', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.admin.imaji-academy.edit', compact('id'));
    }

    public function importStudent(Request $request, $id)
    {
        Excel::import(new StudentImport($id), $request->file);
    }
}
