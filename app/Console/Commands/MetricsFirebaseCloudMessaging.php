<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FirebaseCloudMessagingService;
use App\Services\DataboxService;
use Illuminate\Support\Facades\Log;


class MetricsFirebaseCloudMessaging extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrics:fcm-fetch-and-push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch metrics from Firebase Cloud Messaging and push them to Databox';

    private $firebaseCloudMessagingService;
    private $databoxService;

    public function __construct(FirebaseCloudMessagingService $firebaseCloudMessagingService, DataboxService $databoxService)
    {
        parent::__construct();
        $this->firebaseCloudMessagingService = $firebaseCloudMessagingService;
        $this->databoxService = $databoxService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
