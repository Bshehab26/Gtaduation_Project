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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('picture')->default('no-event-picture.jpg');
            $table->string('subject')->nullable();
            $table->text('description');
            $table->foreignId('organizer_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('venue_id')->constrained('venues');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status',['upcoming', 'ongoing', 'ended', 'canceled']);
            $table->boolean('featured')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
