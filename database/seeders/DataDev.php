<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DataDev extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // jenis user
        // $admin = new \App\Models\JenisUsers;
        // $admin->nama_jenis= "Pegawai Tetap";
        // $admin->save();
        // $admin1 = new \App\Models\JenisUsers;
        // $admin1->nama_jenis= "Pegawai Kontrak";
        // $admin1->save();
        // $admin2 = new \App\Models\JenisUsers;
        // $admin2->nama_jenis= "Magang";
        // $admin2->save();
        // $admin3 = new \App\Models\JenisUsers;
        // $admin3->nama_jenis= "PKL";
        // $admin3->save();

        // unit kerja
        $faker = Faker::create('id_ID');

    	// for($i = 1; $i <= 50; $i++){
        //     $uk = new \App\Models\UnitKerjas;
        //     $uk->nama_unit = $faker->company;
        //     $uk->save();
        // }

        // //divisi
        // for($i = 1; $i <= 80; $i++){
        //     $uk = new \App\Models\DivisiModels;
        //     $uk->nama_divisi = $faker->jobTitle;
        //     $uk->save();
        // }

        //pegawai
        for($i = 1; $i <= 150; $i++){
            $uk = new \App\Models\Pegawai;
            $uk->nama_pegawai = $faker->name;
            $uk->no_hp = $faker->e164PhoneNumber;
            $uk->alamat_pegawai = $faker->address;
            $uk->id_divisi = rand(1,50);
            $uk->id_unit = rand(1,50);
            $uk->id_jenis_user = rand(1,4);
            $uk->save();
        }
    }
}
