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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_component_id')
                ->constrained('class_components')
                ->cascadeOnDelete();

            $table->string('weekday'); // segunda, terça, etc.
            $table->integer('lesson_number'); // 1ª, 2ª aula, etc.

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
