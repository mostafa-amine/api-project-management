<?php

namespace App\Policies;

class UserPolicy
{
    public function showAny()
    {
        return auth()->user()->hasRole(['admin', 'directeur']) ? true : false;
    }

    public function show()
    {
        return auth()->user()->hasRole(['admin']) ? true : false;
    }
}
