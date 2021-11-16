<?php

namespace App\Http\Livewire\Table;


use App\Models\FeatureActivity;
use App\Models\FeatureScore;
use App\Models\FeatureStudent;
use App\Models\ImajiAcademyFeature;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Presence extends Main
{
    public function exportPresence($id)
    {
        $iaf=ImajiAcademyFeature::find($id);
        $q1 = FeatureActivity::whereIafId($id)->get();
        $q2 = DB::select(DB::raw("
SELECT feature_activities.id as activities_id, users.id as user_id,presence_statuses.title as presence_status
FROM imaji_academy_features
JOIN feature_activities ON feature_activities.iaf_id=imaji_academy_features.id
JOIN feature_activity_presences on feature_activity_presences.feature_activity_id=feature_activities.id
JOIN users on feature_activity_presences.user_id=users.id
JOIN presence_statuses on presence_statuses.id=feature_activity_presences.presence_status_id
WHERE imaji_academy_features.id=$id"));
        $q3 = FeatureStudent::whereIafId($id)->get();

        $fileName = Str::slug($iaf->imajiAcademy->title.'-'.$iaf->feature->title.'-'.Carbon::now()->format('d/m/y')).".csv";
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function () use ($iaf, $q3, $q2, $q1) {
            $delimiter = ';';
            $file = fopen('php://output', 'w');
            fputcsv($file, [$iaf->imajiAcademy->title.'-'.$iaf->feature->title], $delimiter);
            $head = ['NIS', 'Nama'];
            foreach ($q1 as $q) {
                array_push($head, $q->created_at->format('d/m/Y H:i'));
            }
            fputcsv($file, $head, $delimiter);
            $col = [];
            foreach ($q3 as $name) {
                $col[$name->user_id] = ['nis' => $name->user->nis, 'name' => $name->user->name];
            }
            foreach ($q1 as $presence) {
                foreach ($q3 as $name) {
                    $col[$name->user_id][$presence->id] = ' - ';
                }
            }
            foreach ($q2 as $activity) {
                $col[$activity->user_id][$activity->activities_id] = $activity->presence_status;
            }
            foreach ($col as $c) {
                fputcsv($file, $c, $delimiter);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    public function exportScore($id)
    {
        $iaf=ImajiAcademyFeature::find($id);
        $q1 = FeatureScore::whereIafId($id)->get();
        $q2 = DB::select(DB::raw("
SELECT feature_scores.id as score_id, users.id as user_id,score_practice, score_theory,feature_scores.module as module
FROM imaji_academy_features
JOIN feature_scores ON feature_scores.iaf_id=imaji_academy_features.id
JOIN feature_score_students on feature_score_students.feature_score_id=feature_scores.id
JOIN users on feature_score_students.user_id=users.id
WHERE imaji_academy_features.id=$id"));
        $q3 = FeatureStudent::whereIafId($id)->get();

        $fileName = Str::slug($iaf->imajiAcademy->title.'-'.$iaf->feature->title.'-'.Carbon::now()->format('d/m/y')).".csv";
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function () use ($iaf, $q3, $q2, $q1) {
            $delimiter = ';';
            $file = fopen('php://output', 'w');
            fputcsv($file, [$iaf->imajiAcademy->title.'-'.$iaf->feature->title], $delimiter);
            $head = ['NIS', 'Nama'];
            foreach ($q1 as $q) {
                array_push($head, $q->module."_teori");
                array_push($head, $q->module."_praktik");
            }
            fputcsv($file, $head, $delimiter);
            $col = [];
            foreach ($q3 as $name) {
                $col[$name->user_id] = ['nis' => $name->user->nis, 'name' => $name->user->name];
            }
            foreach ($q1 as $q) {
                foreach ($q3 as $name) {
                    $col[$name->user_id][$q->module."_teori"] = ' - ';
                    $col[$name->user_id][$q->module."_praktik"] = ' - ';
                }
            }
            $t=['-','A','B','C'];
            $p=['-','Membanggakan','Cemerlang','Memuaskan'];
            foreach ($q2 as $activity) {
                $col[$activity->user_id][$activity->module."_teori"] = $t[$activity->score_theory];
                $col[$activity->user_id][$activity->module."_praktik"] = $p[$activity->score_practice];
            }
            foreach ($col as $c) {
                fputcsv($file, $c, $delimiter);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
