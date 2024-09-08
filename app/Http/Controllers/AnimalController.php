<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::join('users', 'animals.user_id', 'users.id')
        ->join('type_animals', 'animals.type_animal_id', 'type_animals.id')->select('users.name as user_name', 'type_animals.name as type_name', 'animals.*')->get();

        return response()->json(['data' => $animals]);
    }

    public function register(Request $request)
    {
        try {

            $animal = Animal::create([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'type_animal_id' => $request->type_animal_id,
                'age' => $request->age,
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
        $animal = Animal::find($id);

        return response()->json(['message' => 'Operação concluída com sucesso!', 'animal' => $animal]);
    }

    public function update(Request $request, int $id)
    {
        $animal = Animal::find($id);

        try {
            $animal->update([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'type_animal_id' => $request->type_animal_id,
                'age' => $request->age,
                'observation' => $request->observation,
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
        $animal = Animal::find($id);

        DB::beginTransaction();
        try {
            $animal->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        
        return response()->json(['message' => 'Operação concluída com sucesso!']);
    }
}
