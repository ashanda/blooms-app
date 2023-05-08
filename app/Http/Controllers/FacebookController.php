<?php

namespace App\Http\Controllers;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Carbon\Carbon;
class FacebookController extends Controller
{ 
    
    protected $fb;
   
    public function __construct()
    {
        $this->fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v16.0',
        ]);
    }

    public function index()
    
    {
        
        try {
            $accessToken = env('YOUR_ACCESS_TOKEN');
    
            $response = $this->fb->get('/me/adaccounts', $accessToken);
            $adAccounts = $response->getGraphEdge()->asArray();
    
            $adsData = [];

            foreach ($adAccounts as $account) {
                $adAccountID = $account['id'];

                $adsResponse = $this->fb->get("/{$adAccountID}/ads", $accessToken);
                $ads = $adsResponse->getGraphEdge()->asArray();

                foreach ($ads as $ad) {
                    $adID = $ad['id'];

                    $insightsResponse = $this->fb->get("/{$adID}/ads?fields=ad_id,ad_name,reach,impressions,spend,clicks&action_attribution_windows=['1d_click','7d_click']", $accessToken);
                    $insights = $insightsResponse->getGraphEdge()->asArray();
                    dd($insights );
                    foreach ($insights as $insight) {
                        $adData = [
                            'ad_id' => $insight['ad_id'],
                            'ad_name' => $insight['ad_name'],
                            'reach' => $insight['reach'],
                            'impressions' => $insight['impressions'],
                            'spend' => $insight['spend'],
                            'clicks' => $insight['clicks'],
                            'date_stop' => $insight['date_stop'],
                        ];

                        $adsData[] = $adData;

                    }
                }
            }
       
            return response()->json($adsData);

        } catch (FacebookResponseException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (FacebookSDKException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
}
}