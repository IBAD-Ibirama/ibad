<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\AthleteEvaluation;

class AthleteEvaluationPhysicalTestChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $athleteId = (int) $request->input('athlete');
        $physicalTestId = (int) $request->input('id');

        $data = $this->findData($athleteId, $physicalTestId);
        
        return Chartisan::build()
            ->labels(array_keys($data))
            ->dataset('Values', array_values($data));
    }
    
    /**
     * Busca os dados para o grafico.
     * 
     * @param int $athleteId
     * @param int $physicalTestId
     * @return array
     */
    private function findData(int $athleteId, int $physicalTestId) {
        $data = [];
        $evaluations = AthleteEvaluation::where('athlete_id', $athleteId)->orderBy('realization_date')->get();
        foreach($evaluations as $evaluation) {
            $physicalTest = $evaluation->physicalTests()->where('physical_test_id', $physicalTestId)->first();
            if($physicalTest) {
                $data[$evaluation->realization_date] = $physicalTest->value;
            }
        }
        return $data;
    }
}