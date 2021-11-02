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
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Jetstream;

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

Route::name('admin.')->prefix('admin')->middleware(['auth:sanctum', 'web', 'verified'])->group(function () {

    Route::middleware(['checkRole:1'])->group(function () {
        Route::resources([
            'feature' => FeatureController::class,
            'imaji-academy' => ImajiAcademyController::class,
            'iaf' => ImajiAcademyFeatureController::class,
            'student' => StudentController::class,
            'teacher' => TeacherController::class,
        ]);
        Route::get('iaf/teacher/{id}', [ImajiAcademyFeatureController::class, 'showTeacher'])->name('iaf.show-teacher');
        Route::get('iaf/teacher/{id}/add', [ImajiAcademyFeatureController::class, 'addTeacher'])->name('iaf.add-teacher');
        Route::get('iaf/student/{id}', [ImajiAcademyFeatureController::class, 'showStudent'])->name('iaf.show-student');
        Route::get('iaf/student/{id}/add', [ImajiAcademyFeatureController::class, 'addStudent'])->name('iaf.add-student');
    });

    Route::middleware(['checkRole:2'])->group(function () {
        Route::get('schedule/',[ScheduleController::class,'index'])->name('schedule.index');
        Route::get('schedule/create',[ScheduleController::class,'create'])->name('schedule.create');
        Route::get('schedule/edit/{id}',[ScheduleController::class,'edit'])->name('schedule.edit');

        Route::get('presence/{iaf}',[PresenceController::class,'index'])->name('presence.index');
        Route::get('presence/{iaf}/create',[PresenceController::class,'create'])->name('presence.create');
        Route::get('presence/{iaf}/edit/{id}',[PresenceController::class,'edit'])->name('presence.edit');
        Route::get('presence/{iaf}/show/{id}',[PresenceController::class,'show'])->name('presence.show');

        Route::get('mission/{iaf}',[MissionController::class,'index'])->name('mission.index');
        Route::get('mission/{iaf}/create',[MissionController::class,'create'])->name('mission.create');
        Route::get('mission/{iaf}/edit/{id}',[MissionController::class,'edit'])->name('mission.edit');

        Route::get('score/{iaf}',[ScoreController::class,'index'])->name('score.index');
        Route::get('score/{iaf}/create',[ScoreController::class,'create'])->name('score.create');
        Route::get('score/{iaf}/edit/{id}',[ScoreController::class,'edit'])->name('score.edit');
        Route::get('score/{iaf}/show/{id}',[ScoreController::class,'show'])->name('score.show');
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
