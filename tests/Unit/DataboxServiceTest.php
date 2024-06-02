<?php
// tests/Unit/DataboxServiceTest.php
namespace Tests\Unit;

use Tests\TestCase;
use App\Services\DataboxService;

class DataboxServiceTest extends TestCase
{
    public function testPushData()
    {
        $service = new DataboxService();
        $data = [
            'sessions' => 100,
            'pageviews' => 200,
        ];

        $success = $service->pushData($data);

        $this->assertTrue($success);
    }
}
