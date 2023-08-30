<?php

use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ImajiAcademyController;
use App\Http\Controllers\Admin\ImajiAcademyFeatureController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Teacher\MissionController;
use App\Http\Controllers\Teacher\PresenceController;
use App\Http\Controllers\Teacher\ScheduleController;
use App\Http\Controllers\Teacher\ScoreController;
use App\Http\Controllers\UserController;
use App\Imports\StudentImport;
use App\Models\ImajiAcademy;
use App\Models\Log;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Jetstream;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/


Route::get('/migration', function () {
    foreach (User::whereRole(3)->get() as $user) {
        Student::create([
            'id' => $user->id,
            'imaji_academy_id' => $user->imaji_academy_id,
            'name' => $user->name,
            'nis' => $user->nis,
            'address' => $user->address,
            'birthday' => $user->birthday,
            'school' => $user->school,
            'class' => $user->class,
            'future_goal' => $user->future_goal,
            'parent_name' => $user->parent_name,
            'parent_job' => $user->parent_job,
            'ips' => $user->ips,
            'age' => $user->age,
            'birth_place' => $user->birth_place,
            'birth_date' => $user->birth_date,
            'semester' => $user->semester,
            'home_village' => $user->home_village,
            'home_address' => $user->home_address,
            'year_enter' => $user->year_enter,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ]);
        $user->delete();
    }
});

Route::get('/dashboard', function () {
    return redirect(route('admin.dashboard'));
});
Route::get('/register', function () {
    return redirect(route('login'));
});
Route::get('/', function () {
    return redirect(route('login'));
});


Route::view('/student', 'livewire.profile-student');
Route::get('/report/{id}', function ($id) {
    $alphabet = range('A', 'Z');
    $score_practice = ['-', 'A', 'B', 'C'];
    $score_theory = ['-', 'Membanggakan', 'Cemerlang', 'Memuaskan'];
    $imajiAcademy = ImajiAcademy::find($id);
    $query = "SELECT students.id FROM `students`
JOIN feature_students ON students.id=feature_students.student_id
JOIN imaji_academy_features ON imaji_academy_features.id = feature_students.iaf_id
JOIN imaji_academies ON imaji_academies.id = imaji_academy_features.imaji_academy_id
WHERE imaji_academies.id=$id";
    $USER = DB::select(DB::raw($query));
    $users = [];
    foreach ($USER as $u) {
        array_push($users, $u->id);
    }
    $users = User::whereIn('id', $users)->get();
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadView('pdf.report-new', compact('users', 'imajiAcademy', 'score_practice', 'score_theory', 'alphabet'))->setPaper('a4', 'portrait');
    return $pdf->stream('INVOICE');
});

Route::name('admin.')->prefix('admin')->middleware(['auth:sanctum', 'web', 'verified'])->group(function () {
    Route::middleware(['checkRole:1'])->group(function () {
        Route::resources([
            'feature' => FeatureController::class,
            'imaji-academy' => ImajiAcademyController::class,
            'iaf' => ImajiAcademyFeatureController::class,
            'student' => StudentController::class,
            'teacher' => TeacherController::class,
        ]);
        Route::post('imaji-academy/import/{id}',function (Request $request, $id){
            Excel::import(new StudentImport($id), $request->file('file'));
            return redirect()->back();
        })->name('imaji-academy.import');
        Route::get('iaf/teacher/{id}', [ImajiAcademyFeatureController::class, 'showTeacher'])->name('iaf.show-teacher');
        Route::get('iaf/teacher/{id}/add', [ImajiAcademyFeatureController::class, 'addTeacher'])->name('iaf.add-teacher');
        Route::get('iaf/student/{id}', [ImajiAcademyFeatureController::class, 'showStudent'])->name('iaf.show-student');
        Route::get('iaf/student/{id}/add', [ImajiAcademyFeatureController::class, 'addStudent'])->name('iaf.add-student');
        Route::get('log', function () {
            return view('pages.admin.log.index', ['log' => Log::class]);
        })->name('log.index');
    });

    Route::middleware(['checkRole:1,2'])->group(function () {
        Route::get('schedule/', [ScheduleController::class, 'index'])->name('schedule.index');
        Route::get('schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
        Route::get('schedule/edit/{id}', [ScheduleController::class, 'edit'])->name('schedule.edit');
        Route::get('report/{iaf}', [ImajiAcademyFeatureController::class, 'report'])->name('iaf.report');

        Route::get('presence/{iaf}', [PresenceController::class, 'index'])->name('presence.index');
        Route::get('presence/{iaf}/create', [PresenceController::class, 'create'])->name('presence.create');
        Route::get('presence/{iaf}/edit/{id}', [PresenceController::class, 'edit'])->name('presence.edit');
        Route::get('presence/{iaf}/show/{id}', [PresenceController::class, 'show'])->name('presence.show');
        Route::get('presence/{iaf}/manual-presence', [PresenceController::class, 'manualPresence'])->name('presence.manual');

        Route::get('mission/{iaf}', [MissionController::class, 'index'])->name('mission.index');
        Route::get('mission/{iaf}/create', [MissionController::class, 'create'])->name('mission.create');
        Route::get('mission/{iaf}/edit/{id}', [MissionController::class, 'edit'])->name('mission.edit');

        Route::get('iaf/student/{id}', [ImajiAcademyFeatureController::class, 'showStudent'])->name('iaf.show-student');
        Route::get('iaf/student/{id}/add', [ImajiAcademyFeatureController::class, 'addStudent'])->name('iaf.add-student');

        Route::get('score/{iaf}', [ScoreController::class, 'index'])->name('score.index');
        Route::get('score/{iaf}/create', [ScoreController::class, 'create'])->name('score.create');
        Route::get('score/{iaf}/edit/{id}', [ScoreController::class, 'edit'])->name('score.edit');
        Route::get('score/{iaf}/show/{id}', [ScoreController::class, 'show'])->name('score.show');
        Route::get('score/{iaf}/manual-presence', [ScoreController::class, 'manualScore'])->name('score.manual');
    });

    Route::post('/summernote-upload', [SupportController::class, 'upload'])->name('summernote_upload');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/user', [UserController::class, "index"])->name('user');
    Route::view('/user/new', "pages.user.create")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.edit")->name('user.edit');

    Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
        Route::group(['middleware' => ['auth', 'verified']], function () {
            // User & Profile...
            Route::get('/user/profile', [UserProfileController::class, 'show'])
                ->name('profile.show');

            // API...
            if (Jetstream::hasApiFeatures()) {
                Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            }

            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
            }
        });
    });

});
