<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeAnimalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TypeAnimal::truncate();

        $typeAnimal = \App\Models\TypeAnimal::create([
            'name' => 'Cão',
            'description' => 'Cães de pequena a grande porte'
        ]);

        $typeAnimal = \App\Models\TypeAnimal::create([
            'name' => 'Gato',
            'description' => 'Felinos'
        ]);

        $typeAnimal = \App\Models\TypeAnimal::create([
            'name' => 'Coelhos',
            'description' => 'Pequeno mamífero herbívoro da ordem Lagomorpha'
        ]);

        $typeAnimal = \App\Models\TypeAnimal::create([
            'name' => 'Hamsters',
            'description' => 'Roedores'
        ]);

        $typeAnimal = \App\Models\TypeAnimal::create([
            'name' => 'Aves',
            'description' => 'Aves domésticas'
        ]);

        $typeAnimal = \App\Models\TypeAnimal::create([
            'name' => 'Répteis ',
            'description' => 'Tartarugas e lagartos'
        ]);
    }
}
