<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NotifReminderHourly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifreminder:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifikasi Reminder Tiap 1 jam sebelum acara';

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
        return 0;
    }
}
