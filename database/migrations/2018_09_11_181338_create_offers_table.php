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
            $table->string('code')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('position')->nullable();
            $table->string('broad_field')->nullable();
            $table->string('specific_field')->nullable();
            $table->string('training_hours')->nullable();
            $table->string('experience_time')->nullable();
            $table->string('remuneration')->nullable();
            $table->string('working_day')->nullable();
            $table->string('number_jobs')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->text('activities')->nullable();
            $table->text('aditional_information')->nullable();
            $table->text('city')->nullable();
            $table->text('province')->nullable();
            $table->text('status')->nullable();
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