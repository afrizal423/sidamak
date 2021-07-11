<?php

namespace App\Jobs;

use stdClass;
use Carbon\Carbon;
use App\Models\Notifikasi;
use Illuminate\Bus\Queueable;
use App\Exports\LaporanAduanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Events\Notifikasi as EventsNotifikasi;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DownloadExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $datanya;
    public $timeout = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dt)
    {
        $this->datanya = $dt;
        Carbon::setLocale('id');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $namafile= 'laporan-aduan-'.Carbon::now()->timestamp.'.xlsx';
        $lokasi = 'public/excel/'.$namafile;
        // proses insert notif
        $dt = new stdClass();
        $dt->text='File Anda telah siap. Export file Excel laporan aduan rentang '.Carbon::parse($this->datanya->mulaiTanggal)->isoFormat('D MMMM Y').' sampai '.Carbon::parse($this->datanya->sampaiTanggal)->isoFormat('D MMMM Y');
        // $dt->url=route('pdf',['filenya'=>$lokasi]);
        $dt->icon='fas fa-file-excel';
        $dt->lokasi_file=Crypt::encryptString($lokasi);

        $nt= new Notifikasi();
        $nt->type='exportexcel';
        $nt->text=json_encode($dt);
        $nt->user_id=$this->datanya->user_id;
        $nt->save();
        // disini panggil broadcast notifikasi
        broadcast(new EventsNotifikasi());

        Excel::store(new LaporanAduanExport($this->datanya), $lokasi);
    }
}
