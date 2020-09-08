<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Sponsor;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();

        return view('sponsors.index')->with([
            'sponsors' => $sponsors,
        ]);
    }

    public function create()
    {
        return view('sponsors.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'cnpj' => 'required|unique:sponsors',
            'name' => 'nullable|string',
            'email' => 'nullable|string'
        ]);

        Sponsor::create($validated);

        return $this->index()->with([
            'message_success' => "Patrocinador cadastrado com sucesso"
        ]);
    }

    public function show($id)
    {
        $sponsor = Sponsor::find($id);

        return view('sponsors.show')->with([
            'sponsors' => $sponsor
        ]);
    }

    public function edit($id)
    {
        $sponsor = Sponsor::find($id);

        return view('sponsors.edit')->with([
            'sponsors' => $sponsor
        ]);
    }

    public function update($id, Request $request)
    {
        $sponsor = Sponsor::find($id);

        $request->validate([
            'cnpj' => 'required',
            'name' => 'nullable|string',
            'email' => 'nullable|string'
        ]);

        $sponsor->update([
            'cnpj' => $request->cnpj,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return $this->index()->with([
            'message_success' => "Patrocinador atualizado com sucesso"
        ]);
    }

    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);

        $sponsor->delete();

        session()->flash('success', "Patrocinador deletado com sucesso");
        return Redirect::back();
    }
}
