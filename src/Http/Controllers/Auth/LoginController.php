<?php

namespace Ndg0\LaravelSocialiteAuth\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return $this->redirectToProvider(config('lsa.default_provider'));
    }

    public function redirectToProvider($provider)
    {
        $driver = Socialite::driver($provider);
        return $driver->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        $user = \App\Models\User::firstOrCreate(
            ['email' => $providerUser->getEmail()],
            ['name' => $providerUser->getName(), 'email_verified_at' => date('Y-m-d H:i:s')]
        );
        Auth::login($user, true);

        return redirect()->intended();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(Route::has('home') ? route('home') : '/');
    }
}
