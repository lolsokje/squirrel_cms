<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwitchAuthService
{
    const TWITCH_BASE_AUTH_URL = 'https://id.twitch.tv/oauth2';
    const TWITCH_USERS_API_URL = 'https://api.twitch.tv/helix/users';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function fetchAccessToken(Request $request): array
    {
        $code = $request->get('code');
        $clientId = config('twitch.client_id');
        $clientSecret = config('twitch.client_secret');
        $grantType = 'authorization_code';
        $redirectUrl = route('redirect', [], true);

        $url = self::TWITCH_BASE_AUTH_URL . "/token?client_id={$clientId}&client_secret={$clientSecret}&code={$code}&grant_type={$grantType}&redirect_uri={$redirectUrl}";

        return $this->makeRequest('POST', $url);
    }

    /**
     * @param string $accessToken
     * @return array
     */
    public function fetchUserData(string $accessToken): array
    {
        $headers = [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}"
            ]
        ];

        return $this->makeRequest('GET', self::TWITCH_USERS_API_URL, $headers);
    }

    /**
     * @param array $response
     * @param UserRepositoryInterface $userRepository
     */
    public function authenticateUser(array $response, UserRepositoryInterface $userRepository): void
    {
        $data = $response['content']->data[0];

        $user = $userRepository->findOrUpsert($data);
        $user->assignRole(['editor', 'administrator']);

        Auth::login($user);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $headers
     * @return array
     */
    private function makeRequest(string $method, string $url, array $headers = []): array
    {
        try {
            $response = $this->client->request($method, $url, $headers);
            $content = $response->getBody()->getContents();
            return [
                'status' => 200,
                'content' => json_decode($content)
            ];
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $content = json_decode($response->getBody()->getContents());
            return [
                'status' => $content->status,
                'content' => $content->message
            ];
        }
    }
}
