<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Language::all();
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
        $language = Language::query()->create([
            'name' => $request['name'],
            'level' => $request['level'],
        ]);

        return response()->json([
            'message' => 'Language created successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Language::query()->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $language = Language::query()->findOrFail($id);
        $language->update([
            'name' => $request['name'],
            'level' => $request['level'],
        ]);

        return response()->json([
            'message' => 'Language updated successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $language = Language::query()->findOrFail($id);
        $language->delete();
        return response()->json([
            'message' => 'Language deleted successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Attach a language to a user.
     */
    public function attachLanguage(Request $request, $userId): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->findOrFail($userId);
        $languageId = $request['language_id'];
        $user->languages()->attach($languageId, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Language attached successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Detach a language from a user.
     */
    public function detachLanguage(Request $request, $userId): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->findOrFail($userId);
        $languageId = $request['language_id'];
        $user->languages()->detach($languageId);

        return response()->json([
            'message' => 'Language detached successfully.',
            'status' => 'success',
        ]);
    }
}
