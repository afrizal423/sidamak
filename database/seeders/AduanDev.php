<?php

namespace Database\Seeders;

use App\Models\Keluhan;
use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AduanDev extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dd(Pegawai::inRandomOrder()
        // ->take(rand(1,10))
        // ->pluck('id')
        // ->toArray());
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 1000; $i++) {
            $pgw=Pegawai::inRandomOrder()
            ->take(rand(1,7))
            ->pluck('id')
            ->toArray();

            $ad = new Keluhan();
            $ad->id_divisi = rand(1,50);
            $ad->id_pegawai = rand(1,50);
            $ad->nama_pelapor = $faker->name;
            $ad->keterangan = $faker->sentence;
            $ad->solusi = $faker->text;
            $ad->status = rand(1, 3);
            $ad->is_done_solusi = 1;
            $ad->is_approv = rand(0, 1);
            $ad->tgl_dibuat=$faker->dateTimeBetween();
            $ad->tgl_selesai=$faker->dateTimeBetween();
            $ad->save();
            $ad = Keluhan::find($ad->id);
            $ad->pic()->attach($pgw);
        }
    }
}
