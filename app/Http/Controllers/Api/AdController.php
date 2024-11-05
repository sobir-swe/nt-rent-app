<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Ad::all();
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
        $ad = Ad::query()->create([
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' => $request['user_id'],
            'branch_id' => $request['branch_id'],
            'status_id' => $request['status_id'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'price' => $request['price'],
            'rooms' => $request['rooms'],
        ]);

        return response()->json([
            'message' => 'Ad created successfully.',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Ad::query()->findOrFail($id);
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
        $ad = Ad::query()->findOrFail($id);
        $ad->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' => $request['user_id'],
            'branch_id' => $request['branch_id'],
            'status_id' => $request['status_id'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'price' => $request['price'],
            'rooms' => $request['rooms'],
        ]);

        return response()->json([
            'message' => 'Ad created successfully.',
            'status' => 'success',
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
            'message' => 'Ad created successfully.',
            'status' => 'success',
        ]);
    }
}
