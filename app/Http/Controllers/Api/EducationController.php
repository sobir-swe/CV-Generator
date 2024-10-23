<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Education::all();
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
        $experience = Education::query()->create([
            'user_id' => auth()->id(),
            'name' => $request['name'],
            'description' => $request['description'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
        ]);

        return response()->json([
            'message' => 'Education created successfully',
            'status' => 'success',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Education::query()->findOrFail($id));
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
        $experience = Education::query()->findOrFail($id);
        $experience->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
        ]);

        return response()->json([
            'message' => 'Education updated successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $experience = Education::query()->findOrFail($id);
        $experience->delete();
        return response()->json([
            'message' => 'Education deleted successfully',
            'status' => 'success',
        ]);
    }
}
