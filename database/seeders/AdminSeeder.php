<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Models\Role::where('code', 'A01')->firstOrFail();

        \App\Models\User::where('role_id', $role->id)->delete();
        $user = \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'admin@patusco.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
            'contact' => '(42) 99999-9999',
            'address' => 'AV. Beira Rio.'
        ]);
    }
}
