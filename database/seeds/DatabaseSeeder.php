<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Professional::class, 100)->create();
        factory(App\Company::class, 100)->create();
        factory(App\Role::class, 1)->create();
        factory(App\Offer::class, 100)->create();
//        factory(App\AcademicFormation::class, 100)->create();
//        factory(App\Ability::class, 100)->create();
//        factory(App\Language::class, 100)->create();
//        factory(App\ProfessionalExperience::class, 100)->create();
//        factory(App\ProfessionalReference::class, 100)->create();
//        factory(App\Course::class, 100)->create();
    }
}