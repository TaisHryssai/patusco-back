<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::truncate();

        $role = \App\Models\Role::create([
            'code' => 'R01',
            'name' => 'receptionist',
            'description' => 'Responsável por atender e direcionar visitantes, realizar agendamentos.'
        ]);

        $role = \App\Models\Role::create([
            'code' => 'D01',
            'name' => 'doctor',
            'description' => 'Profissional de saúde especializado no diagnóstico, tratamento e prevenção de doenças em animais.'
        ]);

        $role = \App\Models\Role::create([
            'code' => 'C01',
            'name' => 'client',
            'description' => 'Cliente que frequenta a clinica.'
        ]);

        $role = \App\Models\Role::create([
            'code' => 'A01',
            'name' => 'admin',
            'description' => 'Responsável pelo controle da clinica.'
        ]);
    }
}
