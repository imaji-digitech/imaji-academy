<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;

class FeatureController extends Controller
{
    public function index()
    {
        $feature = Feature::class;
        return view('pages.admin.feature.index', compact('feature'));
    }

    public function create()
    {
        return view('pages.admin.feature.create');
    }

    public function show($id)
    {
        return view('pages.admin.feature.show', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.admin.feature.edit', compact('id'));
    }

}
