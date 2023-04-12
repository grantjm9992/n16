<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('old_id')->nullable();
            $table->uuid('company_id');
            $table->text('description')->nullable();
            $table->uuid('classroom_id')->nullable();
            $table->string('classroom_name')->nullable();
            $table->uuid('teacher_id')->nullable();
            $table->string('teacher_name')->nullable();
            $table->string('teacher_colour')->nullable();
            $table->uuid('event_type_id')->nullable();
            $table->string('event_type_colour')->nullable();
            $table->uuid('group_id')->nullable();
            $table->string('group_name')->nullable();
            $table->uuid('user_id')->nullable();
            $table->uuid('department_id')->nullable();
            $table->uuid('status_id')->nullable();
            $table->uuid('series_id')->nullable();
            $table->uuid('resource_id')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date');
            $table->timestamps();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('old_id')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('colour')->nullable();
            $table->string('text_colour')->nullable();
            $table->uuid('company_id');
            $table->uuid('teacher_type_id')->nullable();
            $table->string('start_date');
            $table->timestamps();
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->integer('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
