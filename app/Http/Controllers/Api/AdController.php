<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Ad::all());
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'branch_id' => 'required|integer|exists:branches,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'price' => 'required|numeric',
            'rooms' => 'required|integer',
        ]);

        $ad = Ad::query()->create($request->all());

        return response()->json([
            'message' => 'Ad created successfully.',
            'status' => 'success',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        $ad = Ad::query()->findOrFail($id);
        return response()->json($ad);
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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'branch_id' => 'required|integer|exists:branches,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'price' => 'required|numeric',
            'rooms' => 'required|integer',
        ]);

        $ad = Ad::query()->findOrFail($id);
        $ad->update($request->all());

        return response()->json([
            'message' => 'Ad updated successfully.',
            'status' => 'success',
            'ad' => $ad,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $ad = Ad::query()->findOrFail($id);
        $ad->delete();
        return response()->json([
            'message' => 'Ad deleted successfully.',
            'status' => 'success',
        ]);
    }
}
