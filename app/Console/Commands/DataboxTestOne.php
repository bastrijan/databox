<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DataboxTestOne extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'databox:testone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Databox Test One';

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
     * @return mixed
     */
    public function handle()
    {
        //

        $c = new  \Databox\Client('1zbcmbkz2xq8w4cgswko40o0wg0ccso8');
        
        $ok = $c->push('baki metrik', 110, null, null, 'MKD');
        if ($ok) {
            echo 'Inserted,...';
        }
    }
}
