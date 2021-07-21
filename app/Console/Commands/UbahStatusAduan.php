<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UbahStatusAduan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changestatusaduan:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengubah Status Aduan Menjadi Pending Daily';

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
        DB::table('keluhan')
            ->where('status', '=', 2)
            ->update([
                'status' => 3
            ]);
        $this->info('data telah terganti menjadi pending');
        echo 'asdsa';
        // return 0;
    }
}
