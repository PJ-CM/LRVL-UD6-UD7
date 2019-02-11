<?php

use App\User;
use App\Profile;
use Illuminate\Database\Seeder;

class ProfileUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static $users;
        static $profiles;
        $users = User::all();
        $users_tot = count($users);
        $id_no = 1;
        $profiles = Profile::all()->except($id_no);
        $profiles_tot = count($profiles);

        //Estableciendo perfil de ADMIN para el usuario ADMIN
        DB::table('profile_user')->insert([
            'profile_id' => 1,
            'user_id' => 1,
        ]);

        //Estableciendo perfiles para los demás usuarios
        for ($i = 2; $i <= $users_tot; $i++) {
            //A cada usuario se le asigna una cantidad aleatoria de perfiles
            $tot_profiles_asignar = random_int(1, $profiles_tot);

            //Habiendo dos posibilidades para $tot_profiles_asignar (1, 2)
            if($tot_profiles_asignar == 1) {
                DB::table('profile_user')->insert([
                    'profile_id' => $profiles->random()->id,
                    //partiendo del usuario con ID = 2
                    'user_id' => $i,
                ]);

            } else if($tot_profiles_asignar == 2) {
                for ($j = 1; $j <= $tot_profiles_asignar; $j++) {
                    DB::table('profile_user')->insert([
                        //perfiles posibles (2, 3)
                        'profile_id' => ($j + 1),
                        //partiendo del usuario con ID = 2
                        'user_id' => $i,
                    ]);
                }
            }
        }
    }
}
