<?php

namespace App\Services;

use App\Models\SchoolYear;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Validation\ValidationException;
use App\Models\StudentYearHistory;
use App\Models\StudentYearComponent;

class CloseSchoolYearService
{
    public function close(SchoolYear $schoolYear): void
    {
        if ($schoolYear->is_closed) {
            throw new Exception('O ano letivo já está fechado.');
        }

        DB::transaction(function () use ($schoolYear) {
            $this->validatePreConditions($schoolYear);
            $this->generateStudentHistories($schoolYear);
            $this->markAsClosed($schoolYear);
        });
    }

    protected function validate1800_1200(int $fgb, int $flex, int $total): void
    {
        if ($fgb < 1800) {
            throw new \Exception("FGB insuficiente: {$fgb}h (mínimo 1800h).");
        }

        if ($flex < 1200) {
            throw new \Exception("Itinerários + Técnica insuficientes: {$flex}h (mínimo 1200h).");
        }

        if ($total < 3000) {
            throw new \Exception("Carga horária total insuficiente: {$total}h (mínimo 3000h).");
        }
    }

    protected function validate2400_600(int $fgb, int $flex, int $total): void
    {
        if ($fgb < 2400) {
            throw new \Exception("FGB insuficiente: {$fgb}h (mínimo 2400h).");
        }

        if ($flex < 600) {
            throw new \Exception("Itinerários + Técnica insuficientes: {$flex}h (mínimo 600h).");
        }

        if ($total < 3000) {
            throw new \Exception("Carga horária total insuficiente: {$total}h (mínimo 3000h).");
        }
    }

    protected function validateLegalWorkload(SchoolYear $schoolYear): void
    {
        $total = 0;
        $fgb = 0;
        $itinerario = 0;
        $tecnica = 0;

        foreach ($schoolYear->classes as $class) {
            foreach ($class->components as $classComponent) {

                $hours = $classComponent->lessons()->count();
                $type = $classComponent->component->curricular_type;

                $total += $hours;

                match ($type) {
                    'formacao_geral' => $fgb += $hours,
                    'itinerario' => $itinerario += $hours,
                    'tecnica_profissional' => $tecnica += $hours,
                    default => null,
                };
            }
        }

        // ENSINO FUNDAMENTAL
        if ($schoolYear->education_stage === 'fundamental') {
            if ($total < 800) {
                throw new \Exception(
                    "Carga horária insuficiente no Ensino Fundamental ({$total}h / mínimo 800h)."
                );
            }
            return;
        }

        // ENSINO MÉDIO
        if ($schoolYear->education_stage === 'medio') {

            if (! $schoolYear->workload_rule) {
                throw new \Exception(
                    'Ano letivo do Ensino Médio sem regra de carga horária definida.'
                );
            }

            if ($schoolYear->uses1800_1200()) {
                $this->validate1800_1200($fgb, $itinerario + $tecnica, $total);
                return;
            }

            if ($schoolYear->uses2400_600()) {
                $this->validate2400_600($fgb, $itinerario + $tecnica, $total);
                return;
            }

            throw new \Exception('Regra de carga horária desconhecida.');
        }
    }


    protected function validatePreConditions(SchoolYear $schoolYear): void
    {
        if ($schoolYear->periods()->count() === 0) {
            throw ValidationException::withMessages([
                'periods' => 'O ano letivo não possui períodos cadastrados.',
            ]);
        }

        $this->validateClasses($schoolYear);
        $this->validateLegalWorkload($schoolYear);
    }

    protected function generateStudentHistories(SchoolYear $schoolYear): void
    {
        foreach ($schoolYear->classes as $class) {
            foreach ($class->enrollments as $enrollment) {

                $history = StudentYearHistory::create([
                    'person_id' => $enrollment->student->person_id,
                    'school_name' => $schoolYear->school->name,
                    'school_inep' => $schoolYear->school->inep_code,
                    'year' => $schoolYear->year,
                    'course_name' => $class->course->name,
                    'education_stage' => $class->course->stage,
                    'is_internal' => true,
                ]);

                foreach ($class->components as $classComponent) {

                    $finalResult = $this->calculateFinalResult(
                        $enrollment,
                        $classComponent->component,
                        $schoolYear
                    );

                    StudentYearComponent::create([
                        'student_year_history_id' => $history->id,
                        'component_name' => $classComponent->component->name,
                        'area_name' => optional($classComponent->component->area)->name,
                        'curricular_type' => $classComponent->component->curricular_type,
                        'total_hours' => $classComponent->component->annual_hours,
                        'final_result' => $finalResult,
                    ]);
                }
            }
        }
    }


    protected function markAsClosed(SchoolYear $schoolYear): void
    {
        $schoolYear->update([
            'is_closed' => true,
            'closed_at' => now(),
        ]);
    }

    protected function calculateFinalResult($enrollment, $component, $schoolYear): string
    {
        $grades = $enrollment->grades()
            ->where('component_id', $component->id)
            ->pluck('grade_value');

        // EXEMPLO simples (média)
        $numeric = $grades->map(fn ($g) => floatval(str_replace(',', '.', $g)));

        $average = $numeric->avg();

        return $average >= 6 ? 'Aprovado' : 'Reprovado';
    }


    protected function validateClasses(SchoolYear $schoolYear): void
    {
        foreach ($schoolYear->classes as $class) {

            if ($class->components()->count() === 0) {
                throw ValidationException::withMessages([
                    'components' => "A turma {$class->name} não possui componentes.",
                ]);
            }

            foreach ($class->components as $classComponent) {

                // Carga horária
                $lessonCount = $classComponent->lessons()->count();
                $requiredHours = $classComponent->component->annual_hours;

                if ($requiredHours && $lessonCount < $requiredHours) {
                    throw ValidationException::withMessages([
                        'hours' => "Carga horária insuficiente em {$classComponent->component->name} ({$class->name}).",
                    ]);
                }

                // Frequência
                foreach ($class->enrollments as $enrollment) {
                    $attendanceCount = $classComponent
                        ->lessons()
                        ->whereHas('attendances', function ($q) use ($enrollment) {
                            $q->where('enrollment_id', $enrollment->id);
                        })
                        ->count();

                    if ($attendanceCount < $lessonCount) {
                        throw ValidationException::withMessages([
                            'attendance' => "Frequência incompleta para {$enrollment->student->person->name}.",
                        ]);
                    }
                }

                // Notas
                foreach ($class->enrollments as $enrollment) {
                    foreach ($schoolYear->periods as $period) {
                        $exists = $enrollment->grades()
                            ->where('component_id', $classComponent->component_id)
                            ->where('period_id', $period->id)
                            ->exists();

                        if (! $exists) {
                            throw ValidationException::withMessages([
                                'grades' => "Nota ausente para {$enrollment->student->person->name}.",
                            ]);
                        }
                    }
                }
            }
        }
    }

}
