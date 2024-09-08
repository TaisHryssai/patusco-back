<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index($role_id)
    {
        $agenda = Agenda::join('users as user', 'agendas.user_id', '=', 'user.id')
        ->join('users as doctor', 'agendas.doctor_id', '=', 'doctor.id')
        ->join('animals', 'agendas.animal_id', '=', 'animals.id')
        ->join('type_animals', 'animals.type_animal_id', '=', 'type_animals.id')
        ->select('agendas.*', 'user.name as user_name', 'doctor.name as doctor_name', 'animals.name as animal_name', 'type_animals.name as type_animal_name');

        if($role_id == 1 || $role_id == 3 || $role_id == 4){
            $agenda = $agenda->where('user.role_id', $role_id);
        }
        
        if($role_id == 2){
            $agenda = $agenda->where('doctor.role_id', $role_id);
        }

        if (request()->has('date')) {
            $agenda = $agenda->whereDate('agendas.consultation_date', request('date'));
        }
        
        if (request()->has('type_animal')) {
            $agenda = $agenda->where('animals.type_animal_id', request('type_animal'));
        }

        $agenda = $agenda->get()
        ->map(function ($item) {
            $item->consultation_date = Carbon::parse($item->consultation_date)->format('d/m/Y');
            return $item;
        });

        return response()->json(['data' => $agenda]);
    }

    public function register(Request $request)
    {
        try {
            $agenda = Agenda::create([
                'user_id' => $request->user_id,
                'animal_id' => $request->animal_id,
                'doctor_id' => $request->doctor_id,
                'created_by_id' => $request->created_by_id,
                'symptoms' => $request->symptoms,
                'period' => $request->period,
                'observation' => $request->observation,
                'consultation_date' => $request->consultation_date,
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
        $agenda = Agenda::find($id);

        return response()->json(['message' => 'Operação concluída com sucesso!', 'agenda' => $agenda]);
    }

    public function update(Request $request, int $id)
    {
        $agenda = Agenda::find($id);

        try {
            $agenda->update([
                'user_id' => $request->user_id,
                'animal_id' => $request->animal_id,
                'doctor_id' => $request->doctor_id,
                'created_by_id' => $request->created_by_id,
                'symptoms' => $request->symptoms,
                'period' => $request->period,
                'observation' => $request->observation,
                'consultation_date' => $request->consultation_date,
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
        $agenda = Agenda::find($id);

        DB::beginTransaction();
        try {
            $agenda->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        
        return response()->json(['message' => 'Operação concluída com sucesso!']);
    }
}
