<?php

namespace App\Http\Controllers;

use App\Article;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\TwitchAuthService;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    const SCOPE = 'user:read:email';

    private Client $client;

    private UserRepositoryInterface $userRepository;

    private TwitchAuthService $authService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        TwitchAuthService $authService
    ) {
        $this->userRepository = $userRepository;
        $this->client = new Client();
        $this->authService = $authService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $user = Auth::user();

        return view('index', [
            'user' => $user,
            'articles' => Article::latest()->with('user')->where('status_id', '2')->paginate(10)
        ]);
    }

    /**
     * @return RedirectResponse|View
     */
    public function login()
    {
        if (!Auth::check()) {
            $clientId = config('twitch.client_id');
            $redirectUrl = route('redirect', [], true);
            $scope = self::SCOPE;
            $state = config('twitch.state');

            $authUrl = TwitchAuthService::TWITCH_BASE_AUTH_URL . "/authorize?client_id={$clientId}&redirect_uri={$redirectUrl}&response_type=code&scope={$scope}&state={$state}";

            return view('login', [
                'url' => $authUrl
            ]);
        }
        return redirect()->route('index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function redirect(Request $request): RedirectResponse
    {
        $state = $request->get('state');

        if ($state !== config('twitch.state')) {
            $this->handleRequestError('invalid state');
        }

        $response = $this->authService->fetchAccessToken($request);

        if ($response['status'] !== 200) {
            $this->handleRequestError($response['content']);
        }
        $accessToken = $response['content']->access_token;

        $response = $this->authService->fetchUserData($accessToken);

        if ($response['status'] !== 200) {
            $this->handleRequestError($response['content']);
        }

        $this->authService->authenticateUser($response, $this->userRepository);

        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();

        return back();
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function duplicateSlug(Request $request)
    {
        $duplicate = Article::withTrashed()->where('slug', $request->get('slug'))->count() !== 0;
        return $duplicate ? 'true' : 'false';
    }

    /**
     * @param $message
     */
    private function handleRequestError($message)
    {
        // TODO better error handling
        dd($message);
    }
}
