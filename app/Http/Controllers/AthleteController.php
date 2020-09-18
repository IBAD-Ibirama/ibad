<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AthleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $athletes = Athlete::all();

        return view('athletes.index')->with([
            'athletes' => $athletes
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
        return view('athletes.create')->with([
            'users' => $users
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
            'birthdate' => 'required',
            'gender' => 'required',
            'rg' => 'required|min:9',
            'telephone' => 'required|min:14',
            'shift' => 'required',
            'grade' => 'required',
            'health_problem' => 'required',
            'medication' => 'required',
            'cloth_size' => 'required',
            'blood_type' => 'required',
            'school' => 'required'
        ]);

        $athlete = new Athlete([
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'rg' => $request->rg,
            'telephone' => $request->telephone,
            'shift' => $request->shift,
            'grade' => $request->grade,
            'health_problem' => $request->health_problem,
            'medication' => $request->medication,
            'cloth_size' => $request->cloth_size,
            'blood_type' => $request->blood_type,
            'school' => $request->school,
            'user_id' => $request->usuario
        ]);
        $athlete->save();

        if ($request->imagem) {
            $this->saveImages($request->imagem, $athlete->id);
        }

        return $this->index()->with([
            'message_success' => "O atleta foi cadastrado com sucesso"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $athlete = Athlete::find($id);

        return view('athletes.show')->with([
            'athlete' => $athlete
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $athlete = Athlete::find($id);
        $users = User::all();

        $athlete->blood_type = str_replace(' ', '', $athlete->blood_type);

        return view('athletes.edit')->with([
            'athlete' => $athlete,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $athlete = Athlete::find($id);

        $request->validate([
            'birthdate' => 'required',
            'gender' => 'required',
            'rg' => 'required|min:9',
            'telephone' => 'required|min:14',
            'shift' => 'required',
            'grade' => 'required',
            'health_problem' => 'required',
            'medication' => 'required',
            'cloth_size' => 'required',
            'blood_type' => 'required',
            'school' => 'required'
        ]);



        $athlete->update([
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'rg' => $request->rg,
            'telephone' => $request->telephone,
            'shift' => $request->shift,
            'grade' => $request->grade,
            'health_problem' => $request->health_problem,
            'medication' => $request->medication,
            'cloth_size' => $request->cloth_size,
            'blood_type' => $request->blood_type,
            'school' => $request->school,
            'user_id' => $request->usuario
        ]);

        if ($request->imagem) {
            $this->saveImages($request->imagem, $athlete->id);
        }

        return $this->index()->with([
            'message_success' => "O atleta foi atualizado com sucesso"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $athlete = Athlete::find($id);

        $athlete->delete();

        return $this->index()->with([
            'message_success' => "O atleta foi excluido"
        ]);
    }

    public function saveImages($imageInput, $athlete_id)
    {

        $image = Image::make($imageInput);
        if ($image->width() > $image->height()) { //Landscape
            $image->widen(1200)
                ->save(public_path() . "/images/athletes/" . $athlete_id . "_large.jpg")
                ->widen(400)->pixelate(12)
                ->save(public_path() . "/images/athletes/" . $athlete_id . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->widen(60)
                ->save(public_path() . "/images/athletes/" . $athlete_id . "_thumb.jpg");
        } else { //Portrait
            $image->heighten(900)
                ->save(public_path() . "/images/athletes/" . $athlete_id . "_large.jpg")
                ->heighten(400)->pixelate(12)
                ->save(public_path() . "/images/athletes/" . $athlete_id . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->heighten(60)
                ->save(public_path() . "/images/athletes/" . $athlete_id . "_thumb.jpg");
        }
    }

    public function deleteImages($athlete_id)
    {
        if (file_exists(public_path() . "/images/athletes/" . $athlete_id . "_large.jpg")) {
            unlink(public_path() . "/images/athletes/" . $athlete_id . "_large.jpg");
        }
        if (file_exists(public_path() . "/images/athletes/" . $athlete_id . "_thumb.jpg")) {
            unlink(public_path() . "/images/athletes/" . $athlete_id . "_thumb.jpg");
        }
        if (file_exists(public_path() . "/images/athletes/" . $athlete_id . "_pixelated.jpg")) {
            unlink(public_path() . "/images/athletes/" . $athlete_id . "_pixelated.jpg");
        }

        return back()->with([
            'message_success' => "A imagem foi apagada."
        ]);
    }
}
