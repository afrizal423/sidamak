<?php

namespace App\Console\Commands;

use stdClass;
use App\Models\Keluhan;
use App\Models\Notifikasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use App\Events\Notifikasi as EventsNotifikasi;


class NotifAduanPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifaduanpending:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memberi notifikasi ketika ada aduan yang statusnya pending';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dt = Keluhan::where('status',3)->get()->count();
        if ($dt > 0) {
            $dt = new stdClass();
            $dt->text='Terdapat aduan statusnya pending, silahkan ke halaman manage aduan untuk melihatnya.';
            $dt->url=Crypt::encryptString(route('manage_aduan'));
            $dt->icon='fas fa-info';

            $nt= new Notifikasi();
            $nt->type='notifstatuspending';
            $nt->text=json_encode($dt);
            $nt->user_id=1;
            $nt->save();

            $dt = new stdClass();
            $dt->text='Terdapat aduan statusnya pending, silahkan ke halaman penangan aduan untuk melihatnya.';
            $dt->url=Crypt::encryptString(route('penanganan_aduan_user'));
            $dt->icon='fas fa-info';

            $nt= new Notifikasi();
            $nt->type='notifstatuspending';
            $nt->text=json_encode($dt);
            $nt->user_id=2;
            $nt->save();

            // disini panggil broadcast notifikasi
            broadcast(new EventsNotifikasi());
        }
        return 0;
    }
}
