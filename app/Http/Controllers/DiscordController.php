<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    public function redirect() {
        return Socialite::driver('discord')->redirect();
    }

    public function handleCallback() {
        $discordUser = Socialite::driver('discord')->user();

        $user = User::updateOrCreate([
            'discord_id' => $discordUser->id
        ], [
            'name' => $discordUser->name,
            'email' => $discordUser->email,
            'avatar' => $discordUser->avatar,
            'discord_token' => $discordUser->token,
            'discord_refresh_token' => $discordUser->refreshToken
        ]);

        Auth::login($user, true);

        return redirect(session('url.intended', RouteServiceProvider::HOME));
    }
}
