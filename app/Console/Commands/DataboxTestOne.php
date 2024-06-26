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

        $c = new  \Databox\Client('780dfada91d74e4dad86cd5d63fec563');
        
        $ok = $c->push('screenPageViews', 789, null, null, 'times');
        if ($ok) {
            echo 'Inserted,...';
        }
    }
}
