<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\AthleteEvaluation;
use App\PhysicalTest;
use App\BodyIndex;
use App\AthleteEvaluationPhysicalTest;
use App\AthleteEvaluationBodyIndex;
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
        
        //Finds all body indexes to define evaluation's options
        $bodyIndexes = BodyIndex::all();

        //Shows evaluation's create view
        return view('athlete_evaluation.create', compact('athletes', 'physicalTests', 'bodyIndexes'));
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
            $physicalTestsValues = $request->input('physical_tests_values');

            //Assigns entered input values to physical test record
            foreach($physicalTests as $i => $physicalTest) {

                //Checks if this physical test received value
                if(!empty($value = $physicalTestsValues[$i])) {

                    //Organizes data to inser
                    $rowData = ['physical_test_id' => $physicalTest, 'value' => $value];
                    $athleteEvaluationPhysicalTest = new AthleteEvaluationPhysicalTest($rowData);

                    //Inserts value in database
                    $athleteEvaluation->physicalTests()->save($athleteEvaluationPhysicalTest);
                }
            }
    
            //Receives physical test's values
            $bodyIndexes = $request->input('body_indexes');
            $bodyIndexesValues = $request->input('body_indexes_values');

            //Assigns entered input values to physical test record
            foreach($bodyIndexes as $i => $bodyIndex) {

                //Checks if this body index received value
                if(!empty($value = $bodyIndexesValues[$i])) {

                    //Organizes data to inser
                    $rowData = ['body_index_id' => $bodyIndex, 'value' => $value];
                    $athleteEvaluationBodyIndex = new AthleteEvaluationBodyIndex($rowData);

                    //Inserts value in database
                    $athleteEvaluation->bodyIndexes()->save($athleteEvaluationBodyIndex);
                }
            }

            //If there is 1 or more physical tests, then the evaluation is completed
            if($athleteEvaluation->physicalTests()->count() == 0 && $athleteEvaluation->bodyIndexes()->count() == 0) {
                throw new Exception('Nenhuma avaliação foi inserida.');
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
