<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function showAny()
    {
        return auth()->user()->name == 'mostafa' ? true : false;
    }
}
