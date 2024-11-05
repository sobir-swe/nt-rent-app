<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdImage;
use Illuminate\Http\Request;

class AdImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return AdImage::all();
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
        $image = AdImage::query()->create([
            'ad_id' => $request['ad_id'],
            'name' => $request['name']
        ]);

        return response()->json([
            'message' => 'Image Added Successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return AdImage::query()->findOrFail($id);
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
        $image = AdImage::query()->findOrFail($id);
        $image->update([
            'ad_id' => $request['ad_id'],
            'name' => $request['name']
        ]);

        return response()->json([
            'message' => 'Image Updated Successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $image = AdImage::query()->findOrFail($id);
        $image->delete();
        return response()->json([
            'message' => 'Image Deleted Successfully',
            'status' => 'success',
        ]);
    }
}
