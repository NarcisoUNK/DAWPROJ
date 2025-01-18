<?php

namespace Database\Seeders;

use App\Models\Seat;
use Illuminate\Support\Facades\DB;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('user')->insert([[
            'username' => 'prom',
            'password' => 'prom',
            'email' => 'prom@prom.prom',
            'permissions' => 111,
            'name' => 'prom',
        ],[
            'username' => 'client',
            'password' => 'client',
            'email' => 'client@client.client',
            'permissions' => 000,
            'name' => 'client',
        ]]);

        DB::table('race')->insert([[
            'id_user' => 1,
            'race_name' => 'FORMULA 1 AUSTRALIAN GRAND PRIX 2025',
            'year' => '2025',
            'country' => 'Australia',
            'city' => 'Melbourne',
        ],[
            'id_user' => 1,
            'race_name' => 'FORMULA 1 HEINEKEN CHINESE GRAND PRIX 2025',
            'year' => '2025',
            'country' => 'China',
            'city' => 'Shanghai',
        ],[
            'id_user' => 1,
            'race_name' => 'FORMULA 1 LENOVO JAPANESE GRAND PRIX 2025',
            'year' => '2025',
            'country' => 'Japan',
            'city' => 'Suzuka',
        ]]);

        DB::table('grandstand')->insert([[
            'id_race' => 1,
            'name' => 'Main Grandstand',
        ],[
            'id_race' => 1,
            'name' => 'Turn 5',
        ],[
            'id_race' => 1,
            'name' => 'Turn 12',
        ],[
            'id_race' => 2,
            'name' => 'Main Grandstand',
        ],[
            'id_race' => 2,
            'name' => 'Turn 3',
        ],[
            'id_race' => 2,
            'name' => 'Turn 10',
        ],[
            'id_race' => 3,
            'name' => 'Main Grandstand',
        ],[
            'id_race' => 3,
            'name' => 'Turn 6',
        ],[
            'id_race' => 3,
            'name' => 'Turn 8',
        ],]);

        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 50; $j++) {
                DB::table('seat')->insert([
                    'id_grandstand' => $i,
                    'n_seat_grandstand' => $j,
                    'price' => rand(29999,159999)/100,
                ]);
            }
        }

        for ($i = 1; $i <= 5; $i++) {
            $seat = Seat::all()->random();
            DB::table('ticket')->insert([
                'id_seat' => $seat->id_seat,
                'id_user' => 1,
                'final_price' => $seat->price,
            ]);
        }
    }
}
