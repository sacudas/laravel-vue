<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->string('emmersion_company')->nullable(true);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('track_id')->nullable(false);
            $table->unsignedBigInteger('curriculum_exit_id')->nullable(false);
            $table->unsignedBigInteger('section_id')->nullable(false);
            $table->enum('empoyment_status', array('1','2'))->default('1');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('track_id')
            ->references('id')
            ->on('tracks')
            ->onDelete('cascade');

            $table->foreign('curriculum_exit_id')
            ->references('id')
            ->on('curriculum_exits')
            ->onDelete('cascade');

            $table->foreign('section_id')
            ->references('id')
            ->on('sections')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curricula');
    }
};
