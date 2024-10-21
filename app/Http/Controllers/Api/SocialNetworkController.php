<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return SocialNetwork::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $network = SocialNetwork::query()->create([
            'social_network_id' => $request['social_network_id'],
            'user_id' => $request['user_id'],
            'username' => $request['username'],
        ]);

        return response()->json([
            'message' => 'Social network created successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json([SocialNetwork::query()->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $network = SocialNetwork::query()->findOrFail($id);
        $network->update([
            'social_network_id' => $request['social_network_id'],
            'user_id' => $request['user_id'],
            'username' => $request['username'],
        ]);

        return response()->json([
            'message' => 'Social network updated successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $network = SocialNetwork::query()->findOrFail($id);
        $network->delete();
        return response()->json([
            'message' => 'Social network deleted successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Attach a social network to a user.
     */

    public function attachSocialNetwork(Request $request, $userId): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->findOrFail($userId);
        $socialNetworkId = $request['social_network_id'];
        $username = $request['username'];

        $user->social_networks()->attach($socialNetworkId, [
            'username' => $username,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Social network attached successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Detach a social network to a user.
     */

    public function detachSocialNetwork(Request $request, $userId): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->findOrFail($userId);
        $networkId = $request['social_network_id'];
        $user->social_networks()->detach($networkId);

        return response()->json([
            'message' => 'Social network detached successfully.',
            'status' => 'success',
        ]);
    }


}
