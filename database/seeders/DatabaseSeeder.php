<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Caracteristica;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Presentacione;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DocumentoSeeder::class);
        Caracteristica::create([
            'id' => '1',
            'nombre' => 'Lacteos',
            'descripcion' => 'Leche y sus derivados',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '2',
            'nombre' => 'Cafes',
            'descripcion' => 'Bebidas con alto nivel de cafeina (contiene azucar)',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '3',
            'nombre' => 'Panes',
            'descripcion' => 'Compuestos blandos y duros ricos en almidon',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '4',
            'nombre' => 'Jugos',
            'descripcion' => 'Extractos de frutas naturales',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '5',
            'nombre' => 'Nestle',
            'descripcion' => 'Compañia por excelencia de helados',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '6',
            'nombre' => 'Nescafe',
            'descripcion' => 'Compañia distribuidora de cafes y productos derivados del mismo',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '7',
            'nombre' => 'CocaCola',
            'descripcion' => 'Rica bebida derivada de limon, azucar, menta y almidon',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '8',
            'nombre' => 'Pomo de Plastico',
            'descripcion' => 'Material no ecologico',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '9',
            'nombre' => 'Bote de cristal',
            'descripcion' => 'Material poco ecologico',
            'estado' => '1'
        ]);

        Caracteristica::create([
            'id' => '10',
            'nombre' => 'Papel forro',
            'descripcion' => 'Material degradable y favorecedor del M.A',
            'estado' => '1'
        ]);

        Marca::create([
            'id' => '2',
            'caracteristica_id' => '5'
        ]);

        Marca::create([
            'id' => '3',
            'caracteristica_id' => '6'
        ]);

        Marca::create([
            'id' => '4',
            'caracteristica_id' => '7'
        ]);

        Categoria::create([
            'id' => '1',
            'caracteristica_id' => '1'
        ]);


        Categoria::create([
            'id' => '2',
            'caracteristica_id' => '2'
        ]);

        Categoria::create([
            'id' => '3',
            'caracteristica_id' => '3'
        ]);

        Categoria::create([
            'id' => '4',
            'caracteristica_id' => '4'
        ]);

        Presentacione::create([
            'id' => '1',
            'caracteristica_id' => '8' 
        ]);

        Presentacione::create([
            'id' => '2',
            'caracteristica_id' => '9' 
        ]);

        Presentacione::create([
            'id' => '3',
            'caracteristica_id' => '10' 
        ]);

    }
}
