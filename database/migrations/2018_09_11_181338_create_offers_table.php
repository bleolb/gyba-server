<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('code');
            $table->string('contact');
            $table->string('email');
            $table->string('phone');
            $table->string('cell_phone');
            $table->string('contract_type');
            $table->string('position');
            $table->string('broad_field');
            $table->string('specific_field');
            $table->string('training_hours');
            $table->string('remuneration');
            $table->string('working_day');
            $table->string('number_jobs');
            $table->text('activities');
            $table->text('aditional_information');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            Schema::dropIfExists('offers');
        });
    }
}