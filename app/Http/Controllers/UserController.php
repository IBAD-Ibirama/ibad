<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return view('users.index')->with([
            'users' => $users,
        ]);
    }

    public function create()
    {
        $all_roles = Role::all()->pluck('name');

        return view('users.create')->with([
            'roles' => $all_roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:8',
            'password' => 'required|min:5',
            'permission' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->permission);

        return $this->index()->with([
            'message_success' => "O usuário <b>" . $request->name . "</b> foi criado."
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();

        return view('users.show')->with([
            'users' => $user,
            'roles' => $roles
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $user_roles = $user->getRoleNames();
        $all_roles = Role::all()->pluck('name');

        return view('users.edit')->with([
            'users' => $user,
            'roles' => $all_roles,
            'user_roles' => $user_roles
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:8',
            'permission' => 'required',
        ]);

        if ($request->oldpassword && $request->newpassword) {
            $hashedPassword = $user->password;

            if (Hash::check($request->oldpassword, $hashedPassword)) {

                if (!Hash::check($request->newpassword, $hashedPassword)) {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->newpassword),
                    ]);

                    $user->removeRole($user->getRoleNames()[0]);
                    $user->assignRole($request->permission);

                    return $this->index()->with([
                        'message_success' => "O usuário <b>" . $user->name . "</b> foi atualizado."
                    ]);
                }

                return Redirect::back()->withErrors(['oldpassword' => 'A nova senha não pode ser igual a anterior']);
            }

            return Redirect::back()->withErrors(['oldpassword' => 'A senha antiga não confere.']);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->removeRole($user->getRoleNames()[0]);
        $user->assignRole($request->permission);

        return $this->index()->with([
            'message_success' => "O usuário <b>" . $user->name . "</b> foi atualizado."
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $oldName = $user->name;

        $user->delete();

        return $this->index()->with([
            'message_success' => "O usuário <b>" . $oldName . "</b> foi apagado."
        ]);
    }
}
