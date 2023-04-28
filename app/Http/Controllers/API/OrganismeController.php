<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganismeController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Organisations Response'
        ]);
    }
}
