<?php

namespace App\Http\Controllers;

use App\SystemUser;
use Illuminate\Http\Request;

class SystemUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemUsers = SystemUser::all();
        return view('systemUsers.index')->with([
            'systemUsers' => $systemUsers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('systemUsers.create');
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
            'name' => 'required|min:3',
            'email' => 'required|min:8',
            'password' => 'required|min:5',
            'permission' => 'required|min:3'
        ]);
        $systemUser = new SystemUser([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'permission' => $request->permission
        ]);
        $systemUser->save();

        return $this->index()->with([
            'message_success'=> "The user <b>".$systemUser->name. "</b> was created." 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SystemUser  $systemUser
     * @return \Illuminate\Http\Response
     */
    public function show(SystemUser $systemUser)
    {
        return view('systemUsers.show')->with([
            'systemUser' => $systemUser
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SystemUser  $systemUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemUser $systemUser)
    {
        return view('systemUsers.edit')->with([
            'systemUser' => $systemUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SystemUser  $systemUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemUser $systemUser)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:8',
            'password' => 'required|min:5',
            'permission' => 'required|min:3'
        ]);
        $systemUser->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'permission' => $request->permission
        ]);

        return $this->index()->with([
            'message_success'=> "The user <b>".$systemUser->name. "</b> was updated." 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SystemUser  $systemUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemUser $systemUser)
    {
        $oldName = $systemUser->name;
        $systemUser->delete();

        return $this->index()->with([
            'message_success'=> "The user <b>".$oldName. "</b> was deleted." 
        ]);
    }
}
