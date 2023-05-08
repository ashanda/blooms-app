<?php

namespace App\Services;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FacebookMarketingService
{
    protected $fb;

    public function __construct()
    {
        $this->fb = new Facebook([
            'app_id' => '557452959832388',
            'app_secret' => '8627ff27a8b05b624d4008b728fb3286',
            'default_graph_version' => 'v16.0',
        ]);
    }

    public function getAdAccounts($accessToken)
    {
        try {
            $this->fb->setDefaultAccessToken($accessToken);

            $response = $this->fb->get('/me/adaccounts?fields=name,id');
            $adAccounts = $response->getGraphEdge()->asArray();

            return $adAccounts;
        } catch (FacebookResponseException $e) {
            // Handle API response errors
            return null;
        } catch (FacebookSDKException $e) {
            // Handle SDK errors
            return null;
        }
    }
}
