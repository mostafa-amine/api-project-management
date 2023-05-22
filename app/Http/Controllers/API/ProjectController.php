<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        return "Hello";
    }

    public function show(Project $id)
    {
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
