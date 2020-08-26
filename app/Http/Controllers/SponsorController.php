<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sponsor;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::all();

        return view('sponsors.index')->with([
            'sponsors' => $sponsors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sponsors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'cnpj' => 'required|unique:sponsors',
            'name' => 'nullable|string',
            'email' => 'nullable|string'
        ]);

        $sponsor = Sponsor::create($validated);

        return redirect()->to(route('sponsors.show', $sponsor));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $sponsor = Sponsor::find($id);

        return view('sponsors.show')->with([
            'sponsors' => $sponsor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsors)
    {
        return view('sponsors.edit')->with([
            'sponsors' => $sponsors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sponsor = Sponsor::find($id);

        $request->validate([
            'cnpj' => 'required|unique:sponsors',
            'name' => 'nullable|string',
            'email' => 'nullable|string'
        ]);

        $sponsor -> update([
            'cnpj' => $request->cnpj,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return $this->index()->with([
            'message_success'=> "Patrocinador atualizado com sucesso." 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);

        $sponsor->delete();

        return $this->index()->with([
            'message_success'=> "Patrocinador deletado com sucesso" 
        ]);
    }
}
