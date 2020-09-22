<?php

namespace App\Http\Controllers;

use Validator;
use App\Athlete;
use App\Team;
use App\TeamLevel;
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
    public function index()
    {
      $trainings = Training::orderBy('date', 'asc')->get();

      return view('training.index', compact('trainings'));
    }

    public function show(Training $training)
    {
      $helpers = TrainingHelper::all()->where('training_id','=',$training->id);

      return view('training.show', compact('training', 'helpers'));
    }

    public function create()
    {
      $teams = Team::all();
      $teams_can_have_auxiliary = $this->getAllTeamNeedAuxiliarys();

      $trainers = $this->getAllTrainers();
      $athletes = $this->getAllHelpers();

      $place = Local::all();

      return view('training.create', compact('teams','trainers','place','athletes', 'teams_can_have_auxiliary'));
    }

    private function getAllTrainers()
    {
      $trainers = DB::table('users')
          ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
          ->where('model_has_roles.role_id', '=', '4')
          ->get();
      return $trainers;
    }

    private function getAllHelpers()
    {
      $athletes = DB::table('athletes')
        ->join('users', 'athletes.user_id', '=' ,'users.id')
        ->join('teams', 'athletes.team_id', '=', 'teams.id')
        ->join('team_levels', 'teams.team_level_id' , '=', 'team_levels.id')
        ->where('team_levels.can_be_auxiliary', '=', 'true')
        ->select('athletes.id', 'users.name')
        ->get();
      return $athletes;
    }

    private function getAllTeamNeedAuxiliarys()
    {
      $teams_can_have_auxiliary = DB::table('teams')
        ->join('team_levels', 'teams.team_level_id' , '=', 'team_levels.id')
        ->where('team_levels.requires_auxiliary', '=', 'true')
        ->select('teams.id')
        ->get();
      return $teams_can_have_auxiliary;
    }

    public function store(Request $request)
    {

      $request->validate([
          'team_select' => 'required',
          'trainer_select' => 'required',
          'training_init_time' => 'required',
          'training_end_time' => 'required',
          'training_init' => 'required',
          'training_repeat' => 'required',
          'training_local' => 'required',
      ],[
          'required' => 'Informe :attribute',
      ],
      [
        'team_select' => 'a turma',
        'trainer_select' => 'o treinador',
        'training_init_time' => 'a hora de inicio do treino',
        'training_end_time' => 'a hora de termino do treino',
        'training_init' => 'o dia inicial',
        'training_repeat' => 'o dia de fim do periodo',
        'training_local' => 'o local onde ocorrerá o treino',
      ]);

      $team_id = $request['team_select'];
      $trainer_id= $request['trainer_select'];
      $local_id = $this->handleTrainingLocal($request)->id;
      $week_day = $request['day_select'];
      $week_day_pt = $request['day_select_pt'];
      $init_time = $request['training_init_time'];
      $end_time = $request['training_end_time'];
      $init_date = $request['training_init'];
      $repeat_until = $request['training_repeat'];

      $auxiliary1 = $request['auxiliary1'];
      $auxiliary2 = $request['auxiliary2'];


      //validar Auxiliares
      $team = Team::find($team_id);
      if($team->teamLevel->requires_auxiliary){
        $request->validate([
          'auxiliary1' => 'required',
          'auxiliary2' => 'required',
        ],[
            'required' => 'Informe :attribute',
        ],
        [
          'auxiliary1' => 'o auxiliar 1',
          'auxiliary2' => 'o auxiliar 2',
        ]);

        if($auxiliary1 == $auxiliary2){
            $validator =Validator::make($request->all(), []);
            $validator->errors()->add('auxiliary1', 'Auxiliar 1 é igual ao auxiliar 2');
            $validator->errors()->add('auxiliary2', 'Auxiliar 2 é igual ao auxiliar 1');
            return Redirect::back()->withErrors($validator)->withInput();
        }
      }

      $recurent = new When();
      $recurent->startDate(new DateTime($init_date))
      ->freq("weekly")
      ->count($this->calculateWeeks($init_date, $repeat_until))
      ->byday($week_day)
      ->generateOccurrences();

      foreach ($recurent->occurrences as $date){
          $training = new Training();
          $training->date = $date;
          $training->time_init = $init_time;
          $training->time_end = $end_time;
          $training->week_day = $week_day_pt;
          $training->trainer_id = $trainer_id;
          $training->team_id = $team_id;
          $training->local_id = $local_id;
          $training->save();

          if($auxiliary1 != null) {
              $this->handleHelpers($auxiliary1, $training->id);
          }

          if($auxiliary2 != null){
              $this->handleHelpers($auxiliary2, $training->id);
          }
      }

      $path = route('training.index');
      return Redirect::to($path)->with([
          'success' => "Treino(s) foram cadastrado(s) com sucesso."
      ]);
    }

    private function handleHelpers(int $auxiliary, int $training_id)
    {
      $training_helper = new TrainingHelper();
      $training_helper->helper_id = $auxiliary;
      $training_helper->training_id = $training_id;
      $training_helper->save();
    }

    private function handleTrainingLocal(Request $request)
    {
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

    private function calculateWeeks($inicio, $fim)
    {
      $initDate = new DateTime($inicio);
      $endDate = new DateTime($fim);
      $difference_in_weeks = $initDate->diff($endDate)->days / 7 + 1;

      return (int)$difference_in_weeks;
    }

    public function edit(Training $training)
    {
      if(count($training->frequencies()->get())){
        session()->flash('failure', "Não é possivel alterar dado do treino com frequencia.");
        return Redirect::back();
      }
      $teams = Team::all();
      $teams_can_have_auxiliary = $this->getAllTeamNeedAuxiliarys();
      $helpers = TrainingHelper::all()->where('training_id','=',$training->id);
      $trainers = $this->getAllTrainers();
      $athletes = $this->getAllHelpers();

      $place = Local::all();
      return view('training.edit', compact('teams','trainers','place','athletes','training','teams_can_have_auxiliary', 'helpers'));
    }

    public function update(Request $request, Training $training)
    {
      $request->validate([
          'team_select' => 'required',
          'trainer_select' => 'required',
          'training_init_time' => 'required',
          'training_end_time' => 'required',
          'training_init' => 'required',
          'training_local' => 'required',
      ],[
          'required' => 'Informe :attribute',
      ],
      [
        'team_select' => 'a turma',
        'trainer_select' => 'o treinador',
        'training_init_time' => 'a hora de inicio do treino',
        'training_end_time' => 'a hora de termino do treino',
        'training_init' => 'o dia inicial',
        'training_local' => 'o local onde ocorrerá o treino',
      ]);

      $auxiliary1 = $request['auxiliary1'];
      $auxiliary2 = $request['auxiliary2'];

      //validar Auxiliares
      $team = Team::find($request['team_select']);
      if($team->teamLevel->requires_auxiliary){
        $request->validate([
          'auxiliary1' => 'required',
          'auxiliary2' => 'required',
        ],[
            'required' => 'Informe :attribute',
        ],
        [
          'auxiliary1' => 'o auxiliar 1',
          'auxiliary2' => 'o auxiliar 2',
        ]);

        if($auxiliary1 == $auxiliary2){
            $validator =Validator::make($request->all(), []);
            $validator->errors()->add('auxiliary1', 'Auxiliar 1 é igual ao auxiliar 2');
            $validator->errors()->add('auxiliary2', 'Auxiliar 2 é igual ao auxiliar 1');
            return Redirect::back()->withErrors($validator)->withInput();
        }
      }

      $training->date        = new DateTime($request['training_init']);
      $training->time_init   = $request['training_init_time'];
      $training->time_end    = $request['training_end_time'];
      $training->week_day    = $request['day_select_pt'];
      $training->trainer_id  = $request['trainer_select'];
      $training->team_id     = $request['team_select'];
      $training->local_id    = $this->handleTrainingLocal($request)->id;
      $training->save();

      $helpers = TrainingHelper::all()->where('training_id','=',$training->id);

      foreach ($helpers as $helpers){
          $helpers->delete();
      }

      if($auxiliary1 != null) {
        $this->handleHelpers($auxiliary1, $training->id);
      }

      if($auxiliary2 != null){
        $this->handleHelpers($auxiliary2, $training->id);
      }

      $path = route('training.show',  $training->id);
      return Redirect::to($path);
  }

  public function destroy(Training $training)
  {
      if(count($training->frequencies()->get())){
        session()->flash('failure', "Não é possivel remover o treino com frequencia.");
        return Redirect::back();
      }

      try {
        $helpers = TrainingHelper::all()->where('training_id','=',$training->id);
        foreach ($helpers as $helpers){
            $helpers->delete();
        }
        $training->delete();
        session()->flash('success', "Treino foi removido.");

      } catch (\Exception $e) {
        session()->flash('warning', "Não foi possivel remover o Treino.");
      }

      return Redirect::back();
  }
}
