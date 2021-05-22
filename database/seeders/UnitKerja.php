<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UnitKerja extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 50; $i++){
            $uk = new \App\Models\UnitKerjas;
            $uk->nama_unit = $faker->company;
            $uk->save();
        }
    }
}
