<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::class;
        return view('pages.admin.student.index', compact('student'));
    }

    public function create()
    {
        return view('pages.admin.student.create');
    }

    public function show($id)
    {
        return view('pages.admin.student.show', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.admin.student.edit', compact('id'));
    }
}
