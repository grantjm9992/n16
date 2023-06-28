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
        Schema::create('event_change_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user')->nullable();
            $table->string('event_id')->nullable();
            $table->string('date_changed')->nullable();
            $table->string('name')->nullable();
            $table->string('original_teacher')->nullable();
            $table->string('new_teacher')->nullable();
            $table->string('original_classroom')->nullable();
            $table->string('new_classroom')->nullable();
            $table->string('original_start_date')->nullable();
            $table->string('new_start_date')->nullable();
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
        Schema::dropIfExists('event_change_log');
    }
};
