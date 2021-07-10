<?php

namespace App\Jobs;

use stdClass;
use Carbon\Carbon;
use App\Models\Keluhan;
use App\Models\Notifikasi;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Events\Notifikasi as EventsNotifikasi;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DownloadPDF implements ShouldQueue
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

    // public function onQueue($queue)
    // {
    //     return $queue;
    // }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pegawai = Keluhan::where('status', '=' , 1)
                    ->where('is_done_solusi', '=' , 1)
                    ->where('is_approv', '=' , 1)
                    ->whereBetween('tgl_dibuat', [$this->datanya->mulaiTanggal, $this->datanya->sampaiTanggal])
                    // ->orWhereBetween('tgl_dibuat', [$request->query('mulaiTanggal'), $request->query('sampaiTanggal')])
                    ->orderBy('id')->get();

        $pdf = PDF::loadview('pages.export.topdf',[
            'data' => $pegawai,
            'mulaiTanggal' => $this->datanya->mulaiTanggal,
            'sampaiTanggal' => $this->datanya->sampaiTanggal
        ]);
        $pdf->setPaper('a4', 'landscape');   //horizontal
        $namafile= 'laporan-aduan-'.Carbon::now()->timestamp.'.pdf';
        $lokasi = 'public/pdf/'.$namafile;
        Storage::put($lokasi, $pdf->output());
        // proses insert notif
        $dt = new stdClass();
        $dt->text='File Anda telah siap. Export file PDF laporan aduan rentang '.Carbon::parse($this->datanya->mulaiTanggal)->isoFormat('D MMMM Y').' sampai '.Carbon::parse($this->datanya->sampaiTanggal)->isoFormat('D MMMM Y');
        // $dt->url=route('pdf',['filenya'=>$lokasi]);
        $dt->icon='fas fa-file-pdf';
        $dt->lokasi_file=Crypt::encryptString($lokasi);

        $nt= new Notifikasi();
        $nt->type='exportpdf';
        $nt->text=json_encode($dt);
        $nt->user_id=$this->datanya->user_id;
        $nt->save();
        // disini panggil broadcast notifikasi
        broadcast(new EventsNotifikasi());
        // dd($pdf->download('coba'));
        // Storage::download($lokasi)
        return true;
        // return $pdf->download('laporan-aduan-'.Carbon::now()->timestamp.'.pdf');
    }
}
