<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoogleAnalyticsService;
use App\Services\DataboxService;
use Illuminate\Support\Facades\Log;

class MetricsGoogleAnalytics extends Command
{
    protected $signature = 'metrics:ga-fetch-and-push';
    protected $description = 'Fetch metrics from Google Analytics 4 and push them to Databox';

    private $googleAnalyticsService;
    private $databoxService;

    public function __construct(GoogleAnalyticsService $googleAnalyticsService, DataboxService $databoxService)
    {
        parent::__construct();
        $this->googleAnalyticsService = $googleAnalyticsService;
        $this->databoxService = $databoxService;
    }

    public function handle()
    {
        $propertyId = '443846971'; // Replace with your actual GA4 property ID
        $startDate = '2023-05-01'; // Example date, can be dynamic
        $endDate = 'today';

        $metrics = $this->googleAnalyticsService->getMetrics($propertyId, $startDate, $endDate);

        // Log::info('metrics: ' . print_r($metrics, true));

        foreach ($metrics as $metric) {
            $data = [
                ['activeUsers', $metric['metricValues'][0]['value']],
                ['screenPageViews', $metric['metricValues'][1]['value']],
            ];
            // Log::info('metrics: ' . print_r($data, true));

            // $success = $this->databoxService->pushData($data);
            $c = new  \Databox\Client(config('services.databox.api_key'));
            $success =  $c->insertAll($data);

            $this->logData('GoogleAnalytics4', $data, $success);
        }
    }

    private function logData($provider, $data, $success)
    {
        Log::info('Metrics Sent', [
            'provider' => $provider,
            'time' => now(),
            'metrics' => $data,
            'number_of_metrics' => count($data),
            'success' => $success,
            'error_message' => $success ? null : 'Failed to push data',
        ]);
    }
}
