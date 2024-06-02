<?php
// app/Services/GoogleAnalyticsService.php
namespace App\Services;

use Google\Client;
use Google\Service\AnalyticsData;

class GoogleAnalyticsService
{
    private $analyticsData;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(config('services.google.credentials'));
        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');
        $this->analyticsData = new AnalyticsData($client);
    }

    public function getMetrics($propertyId, $startDate, $endDate)
    {
        $request = new \Google\Service\AnalyticsData\RunReportRequest();
        $request->setDateRanges([
            new \Google\Service\AnalyticsData\DateRange(['startDate' => $startDate, 'endDate' => $endDate])
        ]);
        $request->setMetrics([
            new \Google\Service\AnalyticsData\Metric(['name' => 'activeUsers']),
            new \Google\Service\AnalyticsData\Metric(['name' => 'screenPageViews'])
        ]);
        $request->setDimensions([
            new \Google\Service\AnalyticsData\Dimension(['name' => 'pageTitle'])
        ]);

        try {
            $response = $this->analyticsData->properties->runReport('properties/' . $propertyId, $request);
            return $response->getRows();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Google Analytics API error: ' . $e->getMessage());
            return [];
        }
    }
}

