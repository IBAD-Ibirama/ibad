<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Team;
use App\TeamLevel;
#use App\Trainer;
use App\Local;
use When\When;
use App\Training;
use App\TrainingHelper;
use App\User;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use DateTime;

class TrainingController extends Controller
{
    public function index(){
        $trainings = Training::orderBy('date', 'asc')->get();
        return view('training.index', compact('trainings'));
    }

    public function show(Training $training){
        $helpers = TrainingHelper::all()->where('training_id','=',$training->id);
        $trainers= User::find($training->trainer_id);
        #dd($trainers->name);
        return view('training.show')
        ->with(compact('training'))
        ->with(compact('helpers'))
        ->with(compact('trainers'));
    }

    public function create()
    {
      $teams = Team::all();
      $teams_can_have_auxiliary = DB::table('teams')
      ->join('team_levels', 'teams.team_level_id' , '=', 'team_levels.id')
      ->where('team_levels.requires_auxiliary', '=', 'true')
      ->select('teams.id')
      ->get();
  
      $trainers = array();
      $users = User::all();
      foreach ($users as $user) { 
        if($user->getRoleNames()[0] == "treinador"){
          array_push($trainers, $user);
        }
      }
      $athletes = DB::table('athletes')
      ->join('users', 'athletes.user_id', '=' ,'users.id')
      ->join('teams', 'athletes.team_id', '=', 'teams.id')
      ->join('team_levels', 'teams.team_level_id' , '=', 'team_levels.id')
      ->where('team_levels.can_be_auxiliary', '=', 'true')
      ->select('athletes.id', 'users.name')
      ->get();

      $place = DB::select('select * from locals');
      return view('training.create')
          ->with(compact('teams'))
          ->with(compact('trainers'))
          ->with(compact('place'))
          ->with(compact('athletes'))
          ->with(compact('teams_can_have_auxiliary'));
    }
    
  
    public function store(Request $request)
    {
      $team_id = $request['team_select'];
      $trainer_id= $request['trainer_select'];
      $local_id=$this->handleTrainingLocal($request)->id;
      $week_day = $request['day_select'];
      $init_time = $request['training_init_time'];
      $end_time = $request['training_end_time'];
      $init_date = $request['training_init'];
      $repeat_until = $request['training_repeat'];
      
      $auxiliary1 = $request['auxiliary1'];
      $auxiliary2 = $request['auxiliary2'];
      
      
      $recurent = new When();
      $recurent->startDate($this->dateFromString($init_date))
      ->freq("weekly")
      ->count($this->calculateWeeks($init_date, $repeat_until))
      ->byday($this->ptWeekDayToEn($week_day))
      ->generateOccurrences();
  
      foreach ($recurent->occurrences as $datas){
        
        $dates_string = strval(date_format($datas, 'd-m-Y'));
        $arr2 = str_split($dates_string, 10);
        foreach($arr2 as $date_value){
          $training_unit = new Training();
          
          
          $training_unit->date = new DateTime($date_value);
          $training_unit->time_init= $init_time;
          $training_unit->time_end= $end_time;
          $training_unit->week_day=$week_day;
          $training_unit->trainer_id=$trainer_id;
          $training_unit->team_id=$team_id;
          $training_unit->local_id=$local_id;
          $training_unit->save();

          if($auxiliary1 != null)
            $this->handleHelpers($auxiliary1, $training_unit->id);
        
          if($auxiliary2 != null)
            $this->handleHelpers($auxiliary2, $training_unit->id);
        }
      }
      $path = route('training.index');
      return Redirect::to($path);
      }

      private function handleHelpers(int $auxiliary, int $training_id){
        $training_helper = new TrainingHelper();
        $training_helper->helper_id=$auxiliary;
        $training_helper->training_id=$training_id;
        $training_helper->save();
      }

      private function handleTrainingLocal(Request $request){
        $trainingLocalId = $request['local_select'];
        $local;
        if($trainingLocalId != ''){
            $local = Local::find($trainingLocalId);
        } else {
            $local= new Local();
            $local->description = $request['training_local'];
            $local->save();
        }
        return $local;
      }
    
      private function calculateWeeks($inicio, $fim){
        $date1 =  $this->dateFromString($inicio);
        $date2 =  $this->dateFromString($fim);
        $difference_in_weeks = $date1->diff($date2)->days / 7;
        return (int)$difference_in_weeks;
      }
    
      private function dateFromString($date){
        return new DateTime(DateTime::createFromFormat('d-m-Y', str_replace("/", "-", $date))->format('d-m-Y'));
      }
    
      private function ptWeekDayToEn($weekDay){
        $return_word= "";
        switch ($weekDay) {
          case "segunda":
            $return_word= "mo";
              break;
          case "terca":
            $return_word= "tu";
            break;
          case "quarta":
            $return_word= "we";
            break;
          case "quinta":
            $return_word= "th";
            break;
          case "sexta":
            $return_word= "fr";
            break;
        }
        return $return_word;
      }    

      public function destroy($id)
      {
          $training = Training::find($id);
    
          $training->delete();
        
          session()->flash('success', "Treino <b></b> foi removida.");
          return Redirect::back();
      }

    public function edit(int $id )
    {
      $training = Training::find($id);
      $teams = Team::all();
      $teams_can_have_auxiliary = DB::table('teams')
      ->join('team_levels', 'teams.team_level_id' , '=', 'team_levels.id')
      ->where('team_levels.requires_auxiliary', '=', 'true')
      ->select('teams.id')
      ->get();
  
   
      #$trainers = Trainer::all();
      $athletes = DB::table('athletes')
      ->join('users', 'athletes.user_id', '=' ,'users.id')
      ->join('teams', 'athletes.team_id', '=', 'teams.id')
      ->join('team_levels', 'teams.team_level_id' , '=', 'team_levels.id')
      ->where('team_levels.can_be_auxiliary', '=', 'true')
      ->select('athletes.id', 'users.name')
      ->get();

      $place = DB::select('select * from locals');
      return view('training.edit')
          ->with(compact('teams'))
          #->with(compact('trainers'))
          ->with(compact('place'))
          ->with(compact('athletes'))
          ->with(compact('training'))
          ->with(compact('teams_can_have_auxiliary'));
    }

  public function update(Request $request, int $id)
  {
    $team_id = $request['team_select'];
    #$trainer_id= $request['trainer_select'];
    $local_id=$this->handleTrainingLocal($request)->id;
    $week_day = $request['day_select'];
    $init_time = $request['training_init_time'];
    $end_time = $request['training_end_time'];
    $init_date = $request['training_init'];
    $repeat_until = $request['training_repeat'];
    
    $auxiliary1 = $request['auxiliary1'];
    $auxiliary2 = $request['auxiliary2'];
    
    
    $recurent = new When();
    $recurent->startDate($this->dateFromString($init_date))
    ->freq("weekly")
    ->count($this->calculateWeeks($init_date, $repeat_until))
    ->byday($this->ptWeekDayToEn($week_day))
    ->generateOccurrences();

    foreach ($recurent->occurrences as $datas){
      
      $dates_string = strval(date_format($datas, 'd-m-Y'));
      $arr2 = str_split($dates_string, 10);
      foreach($arr2 as $date_value){
        $training_unit = Training::find($id);
        
        
        $training_unit->date = new DateTime($date_value);
        $training_unit->time_init= $init_time;
        $training_unit->time_end= $end_time;
        $training_unit->week_day=$week_day;
        $training_unit->trainer_id=1;
        $training_unit->team_id=$team_id;
        $training_unit->local_id=$local_id;
        $training_unit->save();

        if($auxiliary1 != null)
          $this->handleHelpers($auxiliary1, $training_unit->id);
      
        if($auxiliary2 != null)
          $this->handleHelpers($auxiliary2, $training_unit->id);
      }
    }

      
   

    $path = route('training.show',  $training_unit -> id);
    return Redirect::to($path);
  }
}
