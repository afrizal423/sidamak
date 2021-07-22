<?php

namespace App\Http\Livewire\Admin\Dashboard\Chart;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart1 extends Component
{
    public $selesai, $progress, $pending, $tgl_dibuat;
    public function mount()
    {
        $year=date("Y");
        $nexty=$year+1;
        $dt = DB::table('keluhan as klh')
            ->select(DB::raw('DISTINCT(DATE(tgl_dibuat)) as tgl_dibuat,
        (SELECT count(*) from `keluhan` as kl
         where kl.status=1 and kl.tgl_dibuat=klh.tgl_dibuat) as selesai,
         (SELECT count(*) from `keluhan` as kl
         where kl.status=2 and kl.tgl_dibuat=klh.tgl_dibuat) as progress,
         (SELECT count(*) from `keluhan` as kl
         where kl.status=3 and kl.tgl_dibuat=klh.tgl_dibuat) as pending'))
        //  ->whereBetween('tgl_dibuat', [$year."-01-01 00:00:00", $year+1."-01-01 23:59:59"])
         ->whereBetween('tgl_dibuat', [$year."-01-01 00:00:00", $nexty."-01-01 23:59:59"])
         ->get();
         foreach ($dt as $key) {
            //  echo $key->tgl_dibuat;
             $this->tgl_dibuat[] = str_replace('"', '', $key->tgl_dibuat);
             $this->pending[] = $key->pending;
             $this->progress[] = $key->progress;
             $this->selesai[] = $key->selesai;
         }
        //  dd($dt);
        // echo json_encode($this->tgl_dibuat);
    }
    public function render()
    {
        return view('livewire.admin.dashboard.chart.chart1');
    }
}
