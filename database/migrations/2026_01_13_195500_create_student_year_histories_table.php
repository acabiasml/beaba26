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
        Schema::create('student_year_histories', function (Blueprint $table) {
            $table->id();

            // Pessoa (aluno)
            $table->foreignId('person_id')
                ->constrained('people')
                ->cascadeOnDelete();

            // Escola de origem (pode ser externa)
            $table->string('school_name');
            $table->string('school_inep')->nullable();

            // Ano letivo
            $table->year('year');

            // Curso / etapa (texto congelado)
            $table->string('course_name'); 
            $table->string('education_stage'); 
            // fundamental / medio

            // Origem do histórico
            $table->boolean('is_internal')->default(true);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_year_histories');
    }
};
