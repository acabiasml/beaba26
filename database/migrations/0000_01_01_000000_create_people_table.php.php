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
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            // Identificação
            $table->string('full_name');
            $table->string('social_name')->nullable();

            // Dados pessoais
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('race')->nullable();

            // Documentos civis
            $table->string('cpf')->nullable()->unique();
            $table->string('rg')->nullable();
            $table->string('rg_issuer')->nullable();
            $table->string('rg_issuer_state', 2)->nullable();
            $table->date('rg_issue_date')->nullable();

            // Naturalidade
            $table->string('nationality')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('state_of_birth', 2)->nullable();

            // Filiação e responsáveis
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_cpf')->nullable();
            $table->string('guardian_phone_1')->nullable();
            $table->string('guardian_phone_2')->nullable();

            // Outros documentos
            $table->string('birth_certificate')->nullable();
            $table->string('voter_id')->nullable();
            $table->string('military_doc')->nullable();

            // Saúde e programas sociais
            $table->string('sus_card')->nullable();
            $table->string('blood_type')->nullable();
            $table->text('health_notes')->nullable();
            $table->string('nis')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
