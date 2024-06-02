<?php

namespace App\Http\Controllers;

use App\Services\FacebookService;
use Illuminate\Http\Request;

class FacebookMetricsController extends Controller {
    protected $facebookService;

    public function __construct(FacebookService $facebookService) {
        $this->facebookService = $facebookService;
    }

    public function showMetrics() {
        $metrics = $this->facebookService->getPageMetrics();
        return response()->json($metrics);
    }
}
