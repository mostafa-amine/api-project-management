<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Policies\OrganisationPolicy;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\OrganizationResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class OrganismeController extends Controller
{
    public function index()
    {
        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('viewAny', Organization::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        // get all organisations
        $orgs = Organization::all();

        return response()->json([
            'organisations' => $orgs
        ]);
    }

    public function show(Organization $organisation)
    {
        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('view', Organization::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }
        return response()->json([
            'organisation' => (new OrganizationResource($organisation))
        ]);
    }

    public function store(Request $request)
    {
        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('store', Organization::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        // validate the data
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'contactPhone' => 'required',
            'cover' => 'required|image',
            'contactEmail' => 'required|email',
            'website' => 'required|url'
        ]);

        $path = Storage::putFile('images', $request->file('cover'));

        $organisation = Organization::create([
            'name' => $request->name,
            'address' => $request->address,
            'contactPhone' => $request->contactPhone,
            'cover' => basename($path),
            'contactEmail' => $request->contactEmail,
            'website' => $request->website,
        ]);

        return response()->json([
            'organisation' => (new OrganizationResource($organisation))
        ]);
    }

    public function update(Request $request, Organization $organisation)
    {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('update', Organization::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => "You are unauthorized to do this action"
            ], 401);
        }

        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'contactPhone' => 'required',
            'cover' => '',
            'contactEmail' => 'required|email',
            'website' => 'required|url'
        ]);

        if ($request->file('cover') !== null) {
            $path = Storage::putFile('images', $request->file('cover'));
        }

        $organisation->update([
            'name' => $request->name,
            'address' => $request->address,
            'contactPhone' => $request->contactPhone,
            'cover' => isset($path) ? basename($path) : $organisation->cover,
            'contactEmail' => $request->contactEmail,
            'website' => $request->website,
        ]);


        return response()->json([
            'organisation' => (new OrganizationResource($organisation))
        ]);
    }

    public function destroy($id)
    {

        try {
            // check if the user has the ability to see all organisations
            abort_if(Gate::denies('delete', Organization::class), 401, 'Unauthorized');
        } catch (AuthorizationException $e) {
            return response()->json([
                'message' => 'You are unauthorized to do this action'
            ], 401);
        }

        try {
            $organisation = Organization::findOrFail($id);
            $organisation->delete();
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => "The organisation not found to be deleted"
            ], 404);
        }

        return response()->json([
            'message' => 'Organisation deleted'
        ]);
    }
}
