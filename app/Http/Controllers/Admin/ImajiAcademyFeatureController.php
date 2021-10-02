<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureStudent;
use App\Models\FeatureTeacher;
use App\Models\ImajiAcademyFeature;

class ImajiAcademyFeatureController extends Controller
{
    public function index()
    {
        $iaf = ImajiAcademyFeature::class;
        return view('pages.admin.iaf.index', compact('iaf'));
    }

    public function create()
    {
        return view('pages.admin.iaf.create');
    }

    public function show($id)
    {
        return view('pages.admin.iaf.show', compact('id'));
    }

    public function showTeacher($id)
    {
        $iaf= FeatureTeacher::class;
        return view('pages.admin.iaf.show-teacher', compact('id','iaf'));
    }

    public function addTeacher($id)
    {
        return view('pages.admin.iaf.add-teacher', compact('id'));
    }

    public function showStudent($id)
    {
        $iaf= FeatureStudent::class;
        return view('pages.admin.iaf.show-student', compact('id','iaf'));
    }

    public function addStudent($id)
    {
        return view('pages.admin.iaf.add-student', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.admin.iaf.edit', compact('id'));
    }
}
