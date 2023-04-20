<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function showAny()
    {
        return auth()->user()->hasRole(['admin']) ? true : false;
    }

    public function show()
    {
        return auth()->user()->hasRole('admin') ? true : false;
    }
}
