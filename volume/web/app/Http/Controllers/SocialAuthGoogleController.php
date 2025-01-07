<?php
namespace App\Http\Controllers;

use App\Services\SocialGoogleAccountService;
use Socialite;

class SocialAuthGoogleController extends Controller
{
    /**
     * Create a redirect method to google api.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
/**
 * Return a callback method from google api.
 *
 * @return callback URL from google
 */
    public function callback(SocialGoogleAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());
        auth()->login($user);
        return redirect()->route('index');
    }
}
