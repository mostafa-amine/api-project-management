<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Phase;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('viewAny', Project::class), 401, 'Unauthorized');

        $projects = Project::query()->with('organisation', 'user')->get();

        return response()->json([
            'projects' => ProjectResource::collection($projects)
        ]);
    }

    public function show(Project $id)
    {
        abort_if(Gate::denies('view', Project::class), 401, 'Unauthorized');
    }

    public function store()
    {
        abort_if(Gate::denies('create', Project::class), 401, 'Unauthorized');
    }

    public function update()
    {
        abort_if(Gate::denies('update', Project::class), 401, 'Unauthorized');
    }

    public function destroy()
    {
        abort_if(Gate::denies('delete', Project::class), 401, 'Unauthorized');
    }

    public function showPhases(Request $request)
    {
        $phases = Phase::all();
        dd($phases);
    }

    public function showPhase()
    {
    }
}
