<?php

namespace App\Services\Authentication\External;

use App\Exceptions\ApiException;
use App\Models\SocialProfile;
use App\Models\User;
use Laravel\Socialite\Contracts\User as FacebookUser;

class FacebookAuthService implements FacebookAuthServiceInterface
{
    public function getToken(FacebookUser $socialUser, string $socialProviderName): string
    {
        if (!$this->isSocialProviderConfigured($socialProviderName)) {
            throw new ApiException();
        }

        $user = $this->createSocialUser($socialUser, $socialProviderName);

        return $user->createToken($user->email)->plainTextToken;
    }

    private function createSocialUser(FacebookUser $socialUser, string $socialProviderName): User
    {
        $socialProfile = SocialProfile::query()->where("provider_id", $socialUser->getId())->first();

        if ($socialProfile !== null) {
            $user = $socialProfile->user;
        } else {
            $user = User::query()->where("email", $socialUser->getEmail())->first();
            if ($user === null) {
                $user = new User();
                $user->email = $socialUser->getEmail();
                $user->save();
            }
            SocialProfile::query()->create([
            "user_id" => $user->id,
            "provider_id" => $socialUser->getId(),
            "provider_name" => $socialProviderName
            ]);
        }

        return $user;
    }

    private function isSocialProviderConfigured(string $socialProviderName): bool
    {
        $facebookConfig = config("services");

        if (!array_key_exists($socialProviderName, $facebookConfig) || $facebookConfig[$socialProviderName] === null) {
            return false;
        }

        return true;
    }
}
