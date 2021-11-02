<?php

namespace Database\Seeders;

use App\Models\Aspect;
use App\Models\Feature;
use App\Models\FeatureStudent;
use App\Models\FeatureTeacher;
use App\Models\ImajiAcademy;
use App\Models\ImajiAcademyFeature;
use App\Models\PresenceStatus;
use App\Models\PretestAspect;
use App\Models\Question;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        PresenceStatus::create(['title' => 'Hadir']);
        PresenceStatus::create(['title' => 'Sakit']);
        PresenceStatus::create(['title' => 'Izin']);
        PresenceStatus::create(['title' => 'Absen']);
        PresenceStatus::create(['title' => 'Tanpa status']);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => Hash::make('admin'),
            'role' => 1
        ]);

//        User::create([
//            'name' => 'guru',
//            'email' => 'guru@guru',
//            'password' => Hash::make('guru'),
//            'role' => 2
//        ]);

//        User::create([
//            'name' => 'siswa',
//            'email' => "siswa@siswa",
//            'password' => Hash::make("siswa"),
//            'role' => 3
//        ]);
//        Student::create(['user_id'=>3]);
//        User::create([
//            'name' => 'siswa2',
//            'email' => "siswa2@siswa",
//            'password' => Hash::make("siswa"),
//            'role' => 3
//        ]);
//        Student::create(['user_id'=>4]);

        Feature::create(['title' => 'Agriculture', 'code' => 'AGRI']);
        Feature::create(['title' => 'Sociopreneur', 'code' => 'SCPR']);
        Feature::create(['title' => 'Literasi', 'code' => 'LITERASI']);
        Feature::create(['title' => 'Seni Budaya - Tari Reog', 'code' => 'REOG']);
        Feature::create(['title' => 'Seni Budaya - Tembang Macapat', 'code' => 'MACAPAT']);

        ImajiAcademy::create(['title' => 'Imaji Academy Maju Berkarya', 'code' => 'MAJU BKR', 'village' => 'Andongsari']);
        ImajiAcademy::create(['title' => 'Imaji Academy Al Ihsan', 'code' => 'AL IHSAN', 'village' => 'Sabrang']);
        ImajiAcademy::create(['title' => 'Imaji Academy Terate', 'code' => 'TERATE', 'village' => 'Kesilir']);
        ImajiAcademy::create(['title' => 'Imaji Academy Berkah', 'code' => 'BERKAH', 'village' => 'Balung Lor']);
        ImajiAcademy::create(['title' => 'Imaji Academy Darussalam 02', 'code' => 'DARUSSALAM', 'village' => 'Bagon']);

        ImajiAcademyFeature::create(['imaji_academy_id' => 1, 'feature_id' => 1]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 1, 'feature_id' => 2]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 1, 'feature_id' => 3]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 1, 'feature_id' => 5]);

        ImajiAcademyFeature::create(['imaji_academy_id' => 2, 'feature_id' => 1]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 2, 'feature_id' => 2]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 2, 'feature_id' => 3]);

        ImajiAcademyFeature::create(['imaji_academy_id' => 3, 'feature_id' => 1]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 3, 'feature_id' => 2]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 3, 'feature_id' => 3]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 3, 'feature_id' => 4]);

        ImajiAcademyFeature::create(['imaji_academy_id' => 4, 'feature_id' => 1]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 4, 'feature_id' => 2]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 4, 'feature_id' => 3]);

        ImajiAcademyFeature::create(['imaji_academy_id' => 5, 'feature_id' => 1]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 5, 'feature_id' => 2]);
        ImajiAcademyFeature::create(['imaji_academy_id' => 5, 'feature_id' => 3]);

//        FeatureTeacher::create(['iaf_id' => 1, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 2, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 3, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 4, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 5, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 6, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 7, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 8, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 9, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 10, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 11, 'user_id' => 2]);
//        FeatureTeacher::create(['iaf_id' => 12, 'user_id' => 2]);
//
//        FeatureStudent::create(['iaf_id' => 1, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 2, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 3, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 4, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 5, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 6, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 7, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 8, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 9, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 10, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 11, 'user_id' => 4]);
//        FeatureStudent::create(['iaf_id' => 12, 'user_id' => 4]);
//
//        FeatureStudent::create(['iaf_id' => 1, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 2, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 3, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 4, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 5, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 6, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 7, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 8, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 9, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 10, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 11, 'user_id' => 3]);
//        FeatureStudent::create(['iaf_id' => 12, 'user_id' => 3]);
    }
}
