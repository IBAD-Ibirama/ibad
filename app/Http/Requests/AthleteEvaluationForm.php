<?php

namespace App\Http\Requests;

use App\AthleteEvaluation;
use App\AthleteEvaluationPhysicalTest;
use App\AthleteEvaluationBodyIndex;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use \Exception as Exception;

class AthleteEvaluationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'athlete_id'            => ['required', 'numeric', 'exists:athletes,id'],
            'realization_date'      => ['required', 'date', 'before:tomorrow'],
            'physicalTests'         => ['array'],
            'physicalTests.*.id'    => ['required', 'numeric'],
            'physicalTests.*.value' => ['nullable', 'numeric', 'min:0'],
            'bodyIndexes'           => ['array'],
            'bodyIndexes.*.id'      => ['required', 'numeric'],
            'bodyIndexes.*.value'   => ['nullable', 'numeric', 'min:0']
        ];
    }

    /**
     * Persist evaluation's data.
     * 
     * @param \App\AthleteEvaluation $evaluation
     */
    public function persist(AthleteEvaluation $evaluation)
    {
        try {
            DB::beginTransaction();
    
            $evaluation->athlete_id = $this->athlete_id;
            $evaluation->realization_date = $this->realization_date;
            $evaluation->save();
    
            $this->persistPhysicalTests($evaluation);
            $this->persistBodyIndexes($evaluation);

            if($evaluation->physicalTests()->count() == 0 && $evaluation->bodyIndexes()->count() == 0) {
                throw new Exception('Nenhuma avaliação foi inserida.');
            }

            DB::commit();
        }
        catch(Exception $exception) {
            DB::rollback();
            throw $exception;
        }
    }

    /**
     * Persist evaluation's physical tests.
     * 
     * @param \App\AthleteEvaluation $evaluation
     */
    private function persistPhysicalTests(AthleteEvaluation $evaluation)
    {
        $evaluation->physicalTests()->delete();
        foreach($this->physicalTests as $physicalTest) {
            if(!empty($physicalTest['value'])) {
                $evaluationPhysicalTest = new AthleteEvaluationPhysicalTest();
                $evaluationPhysicalTest->physical_test_id = $physicalTest['id'];
                $evaluationPhysicalTest->value = $physicalTest['value'];
                if($evaluation->physicalTests()->where('physical_test_id', $evaluationPhysicalTest->physical_test_id)->count() > 0) {
                    throw new Exception('A avaliação não pode ter testes físicos duplicados.');
                }
                $evaluation->physicalTests()->save($evaluationPhysicalTest);
            }
        }
    }

    /**
     * Persist evaluation's body indexes.
     * 
     * @param \App\AthleteEvaluation $evaluation
     */
    private function persistBodyIndexes(AthleteEvaluation $evaluation)
    {
        $evaluation->bodyIndexes()->delete();
        foreach($this->bodyIndexes as $bodyIndex) {
            if(!empty($bodyIndex['value'])) {
                $evaluationBodyIndex = new AthleteEvaluationBodyIndex();
                $evaluationBodyIndex->body_index_id = $bodyIndex['id'];
                $evaluationBodyIndex->value = $bodyIndex['value'];
                if($evaluation->bodyIndexes()->where('body_index_id', $evaluationBodyIndex->body_index_id)->count() > 0) {
                    throw new Exception('A avaliação não pode ter índices corporais duplicados.');
                }
                $evaluation->bodyIndexes()->save($evaluationBodyIndex);
            }
        }
    }
}
