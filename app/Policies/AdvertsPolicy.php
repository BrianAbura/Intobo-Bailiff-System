<?php

namespace App\Policies;

use App\Models\Adverts;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdvertsPolicy
{

    public function update(User $user, Adverts $advert): Response
    {
        // \Log::info('Checking update permission', ['user_id' => $user->id, 'adverts_user_id' => $advert->user_id]);
        return $user->isAdmin() || $user->id === $advert->user_id
            ? Response::allow()
            : Response::deny("You do not have permission to access this resource.");
    }


    public function delete(User $user, Adverts $advert)
    {
        return $user->isAdmin() || $user->id === $advert->user_id;
    }


}
