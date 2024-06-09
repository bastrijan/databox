<?php

// app/Console/Commands/RunSelfManagedLoop.php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunSelfManagedLoop extends Command
{
    protected $signature = 'run:self-managed-loop';
    protected $description = 'Run a self-managed loop to execute tasks at intervals';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        while (true) {
            // Your logic here
            \Artisan::call('metrics:fetch-and-push');

            // Sleep for 30 minutes (1800 seconds)
            sleep(15);
        }
    }
}
