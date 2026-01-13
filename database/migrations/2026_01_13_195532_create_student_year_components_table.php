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
        Schema::create('student_year_components', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_year_history_id')
                ->constrained('student_year_histories')
                ->cascadeOnDelete();

            // Dados congelados do componente
            $table->string('component_name');
            $table->string('area_name')->nullable();

            $table->string('curricular_type');
            // formacao_geral | complementar | itinerario

            $table->integer('total_hours')->nullable();

            $table->string('final_result');
            // nota, conceito, aprovado, reprovado, etc.

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_year_components');
    }
};
