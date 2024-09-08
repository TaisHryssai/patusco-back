<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeAnimal;

class TypeAnimalController extends Controller
{
    public function index()
    {
        $type_animals = TypeAnimal::all();

        return response()->json(['data' => $type_animals]);
    }

    public function show(int $id)
    {
        $type_animal = TypeAnimal::find($id);

        return response()->json(['message' => 'Operação concluída com sucesso!', 'type_animal' => $type_animal]);
    }
}
