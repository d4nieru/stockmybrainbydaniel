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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string("reason_for_the_meeting");
            $table->date("meeting_date");
            $table->time("meeting_time");
            $table->string("videoconference_link")->nullable();
            $table->boolean("is_active");
            $table->integer("host_of_the_meeting_id");
            $table->integer("guest_of_the_meeting_id");
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
        Schema::dropIfExists('appointments');
    }
};
