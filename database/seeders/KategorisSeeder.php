<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 10; $i++) {
            Kategori::create([
                'nama_kategori' => $faker->word(),
                'deskripsi_kategori' => $faker->paragraph(),
            ]);
        }
    }
}
