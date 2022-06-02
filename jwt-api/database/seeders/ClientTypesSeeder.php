<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientTypes;

class ClientTypesSeeder extends Seeder
{
    /**
    * Run the database seeders.
    *
    * @return void
    */
    public function run()
    {
        ClientTypes::create([
            'description' => 'Pessoa Física'
        ]);
        
        ClientTypes::create([
            'description' => 'Pessoa Jurídica'
        ]);

    }
}
