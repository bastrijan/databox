<?php
// tests/Unit/GoogleAnalyticsServiceTest.php
namespace Tests\Unit;

use Tests\TestCase;
use App\Services\GoogleAnalyticsService;

class GoogleAnalyticsServiceTest extends TestCase
{
    public function testGetMetrics()
    {
        $service = new GoogleAnalyticsService();
        
        $propertyId = '443846971'; // Replace with your actual GA4 property ID
        $startDate = '2023-05-01'; // Example date, can be dynamic
        $endDate = 'today';

        $metrics = $service->getMetrics($propertyId, $startDate, $endDate);
        $this->assertNotEmpty($metrics);
    }
}
