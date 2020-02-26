<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const TWITCH_BASE_API = 'https://id.twitch.tv/oauth2';
    const SCOPE = 'user:read:email';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index()
    {
        $clientId = config('twitch.client_id');
        $redirectUrl = route('redirect', [], true);
        $scope = self::SCOPE;
        $state = config('twitch.state');

        $authUrl = self::TWITCH_BASE_API . "/authorize?client_id={$clientId}&redirect_uri={$redirectUrl}&response_type=code&scope={$scope}&state={$state}";

        return view('welcome', [
            'authUrl' => $authUrl
        ]);
    }

    public function redirect(Request $request)
    {
        $state = $request->get('state');

        if ($state !== config('twitch.state')) {
            dd('invalid request');
        }

        $code = $request->get('code');
        $clientId = config('twitch.client_id');
        $clientSecret = config('twitch.client_secret');
        $grantType = 'authorization_code';
        $redirectUrl = route('redirect', [], true);

        $url = self::TWITCH_BASE_API . "/token?client_id={$clientId}&client_secret={$clientSecret}&code={$code}&grant_type={$grantType}&redirect_uri={$redirectUrl}";

        $response = $this->client->post($url);

        if ($response->getStatusCode() === 200) {
            $content = json_decode($response->getBody()->getContents());
            $accesstoken = $content->access_token;

            $response = $this->client->get('https://api.twitch.tv/helix/users', [
                'headers' => [
                    'Authorization' => "Bearer {$accesstoken}"
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $content = json_decode($response->getBody()->getContents());

                dd($content);
            }
        }

        dd($response->getBody()->getContents());
    }
}
