<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [

            // Ensino Fundamental – BNCC
            ['name' => 'Linguagens', 'education_stage' => 'fundamental'],
            ['name' => 'Matemática', 'education_stage' => 'fundamental'],
            ['name' => 'Ciências da Natureza', 'education_stage' => 'fundamental'],
            ['name' => 'Ciências Humanas', 'education_stage' => 'fundamental'],
            ['name' => 'Ensino Religioso', 'education_stage' => 'fundamental'],

            // Ensino Médio – Formação Geral Básica
            ['name' => 'Linguagens e Suas Tecnologias', 'education_stage' => 'medio'],
            ['name' => 'Matemática e Suas Tecnologias', 'education_stage' => 'medio'],
            ['name' => 'Ciências da Natureza e Suas Tecnologias', 'education_stage' => 'medio'],
            ['name' => 'Ciências Humanas e Sociais Aplicadas', 'education_stage' => 'medio'],

            // Ensino Médio – Formação Técnica e Profissional
            ['name' => 'Formação Técnica e Profissional', 'education_stage' => 'medio'],
        ];

        foreach ($areas as $area) {
            Area::firstOrCreate($area);
        }
    }
}
