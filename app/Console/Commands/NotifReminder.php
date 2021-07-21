<?php

namespace App\Console\Commands;

use stdClass;
use Carbon\Carbon;
use App\Models\Reminder;
use App\Models\Notifikasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use App\Events\Notifikasi as EventsNotifikasi;

class NotifReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifreminder:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifikasi Reminder Acara Tiap Hari (tengah malam)';

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
        $date = Carbon::now();

        $dt = Reminder::where('tgl_kegiatan', '=', $date->format('Y-m-d'))->get()->count();
        if ($dt > 0) {
            $dt = new stdClass();
            $dt->text='Terdapat agenda pada hari ini, silahkan ke halaman kalender untuk melihatnya.';
            $dt->url=Crypt::encryptString(route('reminder_index'));
            $dt->icon='fas fa-clock';

            $nt= new Notifikasi();
            $nt->type='notifreminder';
            $nt->text=json_encode($dt);
            $nt->user_id=1;
            $nt->save();

            $dt = new stdClass();
            $dt->text='Terdapat agenda pada hari ini, silahkan ke halaman kalender untuk melihatnya.';
            $dt->url=Crypt::encryptString(route('reminder_index_user'));
            $dt->icon='fas fa-clock';

            $nt= new Notifikasi();
            $nt->type='notifreminder';
            $nt->text=json_encode($dt);
            $nt->user_id=2;
            $nt->save();

            // disini panggil broadcast notifikasi
            broadcast(new EventsNotifikasi());
        }
        return 0;
    }
}
