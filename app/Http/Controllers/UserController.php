<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::join('roles', 'users.role_id', 'roles.id')->select('users.*', 'roles.name as role_name')->get();

        return response()->json(['data' => $users]);
    }

    public function listReceptionist()
    {
        $receptionists = User::join('roles', 'users.role_id', 'roles.id')->where('users.role_id', 1)->select('users.*', 'roles.name as role_name')->get();

        return response()->json(['data' => $receptionists]);
    }

    public function listDoctor()
    {
        $doctors = User::join('roles', 'users.role_id', 'roles.id')->where('users.role_id', 2)->select('users.*', 'roles.name as role_name')->get();

        return response()->json(['data' => $doctors]);
    }

    public function listClients()
    {
        $clients = User::join('roles', 'users.role_id', 'roles.id')->where('users.role_id', 3)->select('users.*', 'roles.name as role_name')->get();

        return response()->json(['data' => $clients]); 
    }

    public function listAnimals(int $user_id)
    {
        $user_animals = Animal::join('users', 'animals.user_id', 'users.id')
        ->join('type_animals', 'animals.type_animal_id', 'type_animals.id')
        ->where('users.id', $user_id)->select('users.name as user_name', 'type_animals.name as type_name', 'animals.*')->get();

        return response()->json(['data' => $user_animals]);
    }

    public function register(Request $request)
    {
        try {
            if (!empty($request->password)) {
                $password = bcrypt($request->password);
            } else {
                $password = bcrypt('password');
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'role_id' => $request->role_id,
                'address' => $request->address,
                'password' => $password,
                'observation' => $request->observation,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return response()->json(['message' => 'Operação concluída com sucesso!']);
    }

    public function show(int $id)
    {
        $user = User::find($id);

        return response()->json(['message' => 'Operação concluída com sucesso!', 'user' => $user]);
    }

    public function update(Request $request, int $id)
    {
        $user = User::find($id);

        try {
            if (!empty($request->password)) {
                $password = bcrypt($request->password);
            } else {
                $password = $user->password;
            }

            $user->update([
                'name' => $request->name ? $request->name : $user->name,
                'email' => $request->email ? $request->email : $user->email,
                'contact' => $request->contact ? $request->contact : $user->contact,
                'role_id' => $request->role_id ? $request->role_id : $user->role_id,
                'address' => $request->address ? $request->address : $user->address,
                'password' => $password,
                'observation' => $request->observation ? $request->observation : $user->observation,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return response()->json(['message' => 'Operação concluída com sucesso!']);
    }

    public function destroy(int $id)
    {
        $user = User::find($id);

        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json(['message' => 'Operação concluída com sucesso!']);
    }
}
