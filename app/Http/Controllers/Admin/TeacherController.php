<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = User::class;
        return view('pages.admin.teacher.index', compact('teacher'));
    }

    public function create()
    {
        return view('pages.admin.teacher.create');
    }

    public function show($id)
    {
        return view('pages.admin.teacher.show', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.admin.teacher.edit', compact('id'));
    }
}
