<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Skill::all();
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
        $skill = Skill::query()->create([
            'name'=>$request['name'],
        ]);

        return response()->json([
            'message'=>'Skill created successfully',
            'status'=>'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Skill::query()->findOrFail($id));
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
        $skill = Skill::query()->findOrFail($id);
        $skill->update([
            'name'=>$request['name'],
        ]);

        return response()->json([
            'message'=>'Skill updated successfully',
            'status'=>'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $skill = Skill::query()->findOrFail($id);
        $skill->delete();
        return response()->json([
            'message'=>'Skill deleted successfully',
            'status'=>'success'
        ]);
    }

    /**
     * Attach a skill to a user.
     */
    public function attachSkill(Request $request, $userId): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->findOrFail($userId);
        $skillId = $request['skill_id'];
        $user->skills()->attach($skillId, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Skill attached successfully.',
            'status' => 'success',
            'skill_id' => $skillId
        ]);
    }

    /**
     * Detach a skill from a user.
     */
    public function detachSkill(Request $request, $userId): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->findOrFail($userId);
        $skillId = $request['skill_id'];
        $user->skills()->detach($skillId);

        return response()->json([
            'message' => 'Skill detached successfully.',
            'status' => 'success',
        ]);
    }
}
