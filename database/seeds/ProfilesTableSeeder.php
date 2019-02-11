<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $_arr_perfiles = ['admin', 'author', 'user'];

        //A diferencia de lo que pasa en los registros generados por el archivo de Factory,
        //en los generados por este Seeder, los campos de timestamp (created_at y update_at)
        //no son rellenados automáticamente, por ello es necesario establecer un valor por defecto
        //si se desea que aparezcan con un volor inicial y no un NULL
        $timestamp = mt_rand(1, time());
        $randomDate = date('Y-m-d H:i:s', $timestamp);

        for ($i = 0; $i < count($_arr_perfiles); $i++) {

            DB::table('profiles')->insert([
                'nombre' => $_arr_perfiles[$i],

                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);

        }
    }
}
