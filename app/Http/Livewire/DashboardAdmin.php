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

    public function mount()
    {
        $this->max = [];
        $this->data['imajiAcademy'] = ImajiAcademy::get(['id'])->count();
        $this->data['student'] = User::whereRole(3)->get(['id'])->count();
        foreach (ImajiAcademy::get() as $im) {
            $this->max[$im->id] = 0;
            $data = DB::select("
SELECT
  features.title,
  COUNT(feature_activity_presences.id) as presence
FROM feature_activity_presences JOIN feature_activities on feature_activities.id = feature_activity_presences.feature_activity_id
    JOIN imaji_academy_features on imaji_academy_features.id = feature_activities.iaf_id
    JOIN features on imaji_academy_features.feature_id = features.id
WHERE imaji_academy_features.imaji_academy_id=$im->id
AND feature_activity_presences.presence_status_id=1
GROUP BY features.id,features.title,feature_activities.id;");
            if ($data != null) {
                foreach ($data as $ac) {
                    $this->activity[$im->id][$ac->title] = [];
                }
                foreach ($data as $ac) {
                    array_push($this->activity[$im->id][$ac->title], $ac->presence);
                }
                foreach ($this->activity[$im->id] as $val) {
                    if ($this->max[$im->id] < count($val)) {
                        $this->max[$im->id] = count($val);
                    }
                }
            }
        }
    }

    public function render()
    {

        return view('livewire.dashboard-admin');
    }
}
