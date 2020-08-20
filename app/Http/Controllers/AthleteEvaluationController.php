<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\AthleteEvaluation;
use App\PhysicalTest;
use App\AthleteEvaluationPhysicalTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Exception as Exception;

class AthleteEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $athleteEvaluations = AthleteEvaluation::all()->sortByDesc('realization_date');
        return view('athlete_evaluation.index', compact('athleteEvaluations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Finds all athletes to set option list
        $athletes = Athlete::all();

        //Finds all physical tests to define evaluation's options
        $physicalTests = PhysicalTest::all();

        //Shows evaluation's create view
        return view('athlete_evaluation.create', compact('athletes', 'physicalTests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Creates a database transaction to store all values or rollbacks operation
        DB::beginTransaction();

        try {
            //Receives evaluation's data from request
            $athleteEvaluationData = $request->only(['athlete_id', 'realization_date']);
    
            //Inserts evaluation's data in database or throws error
            $athleteEvaluation = AthleteEvaluation::create($athleteEvaluationData);
            if(!$athleteEvaluation) {
                throw new Exception('Erro ao inserir avaliação do atleta.');
            }
    
            //Receives physical test's values
            $physicalTests = $request->input('physical_tests');
            $values = $request->input('values');

            //Assigns entered input values to physical test record
            foreach($physicalTests as $i => $physicalTest) {

                //Checks if this physical test received value
                if(!empty($value = $values[$i])) {

                    //Organizes data to inser
                    $rowData = ['physical_test_id' => $physicalTest, 'value' => $value];
                    $athleteEvaluationPhysicalTest = new AthleteEvaluationPhysicalTest($rowData);

                    //Inserts value in database
                    $athleteEvaluation->physicalTests()->save($athleteEvaluationPhysicalTest);
                }
            }

            //If there is 1 or more physical tests, then the evaluation is completed
            if($athleteEvaluation->physicalTests()->count() == 0) {
                throw new Exception('Nenhum teste físico foi inserido.');
            }

            DB::commit();
                
            //Returns to resource index
            return redirect()->route('avaliacao_atleta.index');
        }
        catch(Exception $exception) {
            DB::rollback();
            throw $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AthleteEvaluation  $athleteEvaluation
     * @return \Illuminate\Http\Response
     */
    public function show(AthleteEvaluation $athleteEvaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AthleteEvaluation  $athleteEvaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(AthleteEvaluation $athleteEvaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AthleteEvaluation  $athleteEvaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AthleteEvaluation $athleteEvaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AthleteEvaluation  $athleteEvaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(AthleteEvaluation $athleteEvaluation)
    {
        //
    }
}
