<?php

namespace App\Http\Controllers;

use App\Responsible;
use App\User;
use App\Athlete;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ResponsibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsibles = Responsible::all();

        return view('responsibles.index')->with([
            'responsibles' => $responsibles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $athletes = Athlete::all();
        return view('responsibles.create')->with([
            'users' => $users,
            'athletes' => $athletes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cpf' => 'required|min:14',
            'phone' => 'required'
        ]);

        $responsible = new Responsible([
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'user_id' => $request->user_id
        ]);

        $responsible->save();

        //Adiciona todos os atletas ao responsável
        $athletes = Athlete::all();
        foreach($athletes as $athlete){
            $idAthlete = $athlete->id;
            if($request->$idAthlete){
                $responsible->athletes()->attach($athlete->id);
            }
        }

        return $this->index()->with([
            'message_success' => "O responsável foi cadastrado com sucesso"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Responsible  $responsible
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $responsible = Responsible::find($id);

        return view('responsibles.show')->with([
            'responsible' => $responsible
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Responsible  $responsible
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $responsible = Responsible::find($id);

        $users = User::all();
        $athletes = Athlete::all();

        return view('responsibles.edit')->with([
            'responsible' => $responsible,
            'users' => $users,
            'athletes' => $athletes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Responsible  $responsible
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $responsible = Responsible::find($id);

        $request->validate([
            'cpf' => 'required|min:14',
            'phone' => 'required',
        ]);

        $responsible->update([
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'user_id' => $request->user_id
        ]);

        $athletes = Athlete::all();
        foreach($athletes as $athlete){
            $responsible->athletes()->detach($athlete->id);
        }

        foreach($athletes as $athlete){
            $idAthlete = $athlete->id;
            if($request->$idAthlete){
                $responsible->athletes()->attach($athlete->id);
            }
        }

        return $this->index()->with([
            'message_success' => "O responsável foi atualizado com sucesso"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Responsible  $responsible
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responsible = Responsible::find($id);

        $responsible->delete();

        session()->flash('success', "Responsável apagado com sucesso");
        return Redirect::back();
    }
}
