<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeatureSchedule;
use App\Models\FeatureTeacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = FeatureTeacher::whereUserId(auth()->id())->get();
        $sc=[];
//        dd($schedules);
        foreach ($schedules as $schedule){
//            dd($schedule);
//            if ($schedule->imajiAcademyFeature->featureSchedules->count()!=0) {
                foreach ($schedule->imajiAcademyFeature->featureSchedules as $s) {
//                    dd($s);
                    array_push($sc, $s);
                }
//            }
        }
//dd($sc);
        for ($i=0;$i<count($sc);$i++){
            for ($j=0;$j<count($sc)-1;$j++){
                if ($sc[$i]->day<$sc[$j]->day){
                    $temp=$sc[$i];
                    $sc[$i]=$sc[$j];
                    $sc[$j]=$temp;
                }
            }
        }

//        dd($sc);
        $schedules=$sc;

        return view('pages.teacher.schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('pages.teacher.schedule.create');
    }

    public function show($id)
    {
        return view('pages.teacher.schedule.show', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.teacher.schedule.edit', compact('id'));
    }
}
