<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\FeatureActivity;

class PresenceController extends Controller
{
    public function index($iaf)
    {
        $presence = FeatureActivity::class;
        return view('pages.teacher.presence.index', compact('presence', 'iaf'));
    }

    public function create($iaf)
    {
        return view('pages.teacher.presence.create', compact('iaf'));
    }

    public function edit($iaf, $id)
    {
        return view('pages.teacher.presence.edit', compact('iaf', 'id'));
    }

    public function show($iaf, $id)
    {
        return view('pages.teacher.presence.show', compact('iaf', 'id'));
    }
}
