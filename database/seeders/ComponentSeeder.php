<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Component;
use App\Models\Area;

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        // ===== ÁREAS =====

        // Fundamental
        $lingFund = Area::where('name', 'Linguagens')->where('education_stage', 'fundamental')->first();
        $matFund  = Area::where('name', 'Matemática')->where('education_stage', 'fundamental')->first();
        $natFund  = Area::where('name', 'Ciências da Natureza')->where('education_stage', 'fundamental')->first();
        $humFund  = Area::where('name', 'Ciências Humanas')->where('education_stage', 'fundamental')->first();

        // Médio – FGB
        $lingMed = Area::where('name', 'Linguagens e Suas Tecnologias')->where('education_stage', 'medio')->first();
        $matMed  = Area::where('name', 'Matemática e Suas Tecnologias')->where('education_stage', 'medio')->first();
        $natMed  = Area::where('name', 'Ciências da Natureza e Suas Tecnologias')->where('education_stage', 'medio')->first();
        $humMed  = Area::where('name', 'Ciências Humanas e Sociais Aplicadas')->where('education_stage', 'medio')->first();

        // Médio – Técnica
        $tecMed = Area::where('name', 'Formação Técnica e Profissional')->where('education_stage', 'medio')->first();

        // ===== ENSINO FUNDAMENTAL =====

        $fundamental = [
            ['name' => 'Língua Portuguesa', 'area' => $lingFund],
            ['name' => 'Arte', 'area' => $lingFund],
            ['name' => 'Educação Física', 'area' => $lingFund],
            ['name' => 'Língua Inglesa', 'area' => $lingFund],
            ['name' => 'Matemática', 'area' => $matFund],
            ['name' => 'Ciências', 'area' => $natFund],
            ['name' => 'História', 'area' => $humFund],
            ['name' => 'Geografia', 'area' => $humFund],
            ['name' => 'Ensino Religioso', 'area' => null],
        ];

        foreach ($fundamental as $component) {
            Component::firstOrCreate(
                ['name' => $component['name'], 'education_stage' => 'fundamental'],
                ['area_id' => $component['area']?->id, 'curricular_type' => 'formacao_geral']
            );
        }

        // ===== ENSINO MÉDIO – FGB =====

        $medioFGB = [
            ['name' => 'Língua Portuguesa', 'area' => $lingMed],
            ['name' => 'Arte', 'area' => $lingMed],
            ['name' => 'Educação Física', 'area' => $lingMed],
            ['name' => 'Língua Inglesa', 'area' => $lingMed],
            ['name' => 'Matemática', 'area' => $matMed],
            ['name' => 'Biologia', 'area' => $natMed],
            ['name' => 'Física', 'area' => $natMed],
            ['name' => 'Química', 'area' => $natMed],
            ['name' => 'História', 'area' => $humMed],
            ['name' => 'Geografia', 'area' => $humMed],
            ['name' => 'Filosofia', 'area' => $humMed],
            ['name' => 'Sociologia', 'area' => $humMed],
        ];

        foreach ($medioFGB as $component) {
            Component::firstOrCreate(
                ['name' => $component['name'], 'education_stage' => 'medio'],
                ['area_id' => $component['area']?->id, 'curricular_type' => 'formacao_geral']
            );
        }

        // ===== ENSINO MÉDIO – ITINERÁRIOS =====

        $itinerarios = [
            ['name' => 'Projeto de Vida', 'area' => $lingMed],
            ['name' => 'Matemática Aplicada', 'area' => $matMed],
            ['name' => 'Ciências Humanas Integradas', 'area' => $humMed],
        ];

        foreach ($itinerarios as $component) {
            Component::firstOrCreate(
                ['name' => $component['name'], 'education_stage' => 'medio'],
                ['area_id' => $component['area']?->id, 'curricular_type' => 'itinerario']
            );
        }

        // ===== ENSINO MÉDIO – FORMAÇÃO TÉCNICA =====

        $tecnica = [
            'Fundamentos da Formação Técnica',
            'Práticas Profissionais',
            'Projeto Integrador',
        ];

        foreach ($tecnica as $name) {
            Component::firstOrCreate(
                ['name' => $name, 'education_stage' => 'medio'],
                ['area_id' => $tecMed?->id, 'curricular_type' => 'tecnica_profissional']
            );
        }
    }
}
