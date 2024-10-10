<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'id' => '1',
            'codigo' => '12345',
            'nombre' => 'Cerveza',
            'descripcion' => 'Algo de prueba',
            'presentacione_id' => '1'
        ]);
    }
}
