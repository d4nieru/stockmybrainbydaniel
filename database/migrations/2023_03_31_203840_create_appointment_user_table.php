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
        Schema::create('appointment_user', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->nullable()->unsigned();
            $table->biginteger('appointment_id')->nullable()->unsigned();
            $table->foreign('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreign('appointment_id')->nullable()->references('id')->on('appointments')->onDelete('cascade');
            $table->integer("workspace_id");
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
        Schema::table('appointment_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['appointment_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('appointment_id');
            $table->dropColumn('workspace_id');
        });
        //Schema::dropIfExists('appointment_user');
    }
};
