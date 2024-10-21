<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Project::all();
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
        $project = Project::query()->create([
            'user_id' => auth()->id(),
            'name' => $request['name'],
            'description' => $request['description'],
            'source_link' => $request['source_link'],
            'demo_link' => $request['demo_link'],
        ]);

        return response()->json([
            'message' => 'Project created successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        $project = Project::query()->findOrFail($id);
        return response()->json($project);
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
        $project = Project::query()->findOrFail($id);
        $project->update([
            'user_id' => auth()->id(),
            'name' => $request['name'],
            'description' => $request['description'],
            'source_link' => $request['source_link'],
            'demo_link' => $request['demo_link'],
        ]);

        return response()->json([
            'message' => 'Project updated successfully',
            'status' => 'success',

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $project = Project::query()->findOrFail($id);
        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully',
            'status' => 'success',

        ]);
    }
}
