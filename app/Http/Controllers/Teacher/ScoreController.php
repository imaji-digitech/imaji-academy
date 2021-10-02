<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\FeatureActivity;
use App\Models\FeatureScore;

class ScoreController extends Controller
{
    public function index($iaf)
    {
        $score = FeatureScore::class;
        return view('pages.teacher.score.index', compact('score', 'iaf'));
    }

    public function create($iaf)
    {
        return view('pages.teacher.score.create', compact('iaf'));
    }

    public function edit($iaf, $id)
    {
        return view('pages.teacher.score.edit', compact('iaf', 'id'));
    }

    public function show($iaf, $id)
    {
        return view('pages.teacher.score.show', compact('iaf', 'id'));
    }
}
