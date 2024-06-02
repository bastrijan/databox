<?php
namespace App\Services;

use Facebook\Facebook;

class FacebookService {
    protected $fb;

    public function __construct() {
        $this->fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v12.0',
        ]);
    }

    public function getPageMetrics() {
        try {
            $response = $this->fb->get('/me?fields=followers_count,engagement,page_views', env('FACEBOOK_PAGE_ACCESS_TOKEN'));
            return $response->getDecodedBody();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}