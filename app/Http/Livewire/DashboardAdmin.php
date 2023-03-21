<?php

namespace App\Http\Livewire;

use App\Models\ImajiAcademy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardAdmin extends Component
{
    public $data;
    public $activity;
    public $max;
    public $year;
    public $semester;
    public $listeners=['getActivity'=>'getActivity'];

    public function mount()
    {
        $this->year=[2023,2022,2021];
        $this->semester=['gasal','genap'];
        $this->max = [];
        $this->data['imajiAcademy'] = ImajiAcademy::get(['id'])->count();
        $this->data['student'] = User::whereRole(3)->get(['id'])->count();
//        foreach (ImajiAcademy::get() as $im) {
//
//        }

    }
    public function getActivity($im,$year,$semester){
        $this->max = 0;
        $data = DB::select("
SELECT
  features.title,
  COUNT(feature_activity_presences.id) as presence
FROM feature_activity_presences JOIN feature_activities on feature_activities.id = feature_activity_presences.feature_activity_id
    JOIN imaji_academy_features on imaji_academy_features.id = feature_activities.iaf_id
    JOIN features on imaji_academy_features.feature_id = features.id
WHERE imaji_academy_features.imaji_academy_id=$im and imaji_academy_features.year_program=$year
  and imaji_academy_features.semester='$semester'
AND feature_activity_presences.presence_status_id=1
GROUP BY features.id,features.title,feature_activities.id;");
        if ($data != null) {
            foreach ($data as $ac) {
                $this->activity[$ac->title] = [];
            }
            foreach ($data as $ac) {
                $this->activity[$ac->title][] = $ac->presence;
            }
            foreach ($this->activity as $val) {
                if ($this->max < count($val)) {
                    $this->max = count($val);
                }
            }
        }
        return [$this->activity,$this->max];
//        dd($this->activity);
    }

    public function render()
    {

        return view('livewire.dashboard-admin');
    }
}
