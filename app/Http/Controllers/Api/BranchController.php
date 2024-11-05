<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Branch::all();
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
        $branch = Branch::query()->create([
            'name' => $request['name'],
            'address' => $request['address'],
        ]);

        return response()->json([
            'message' => 'Created successfully',
            'status' => 'success',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Branch::query()->findOrFail($id);
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
        $branch = Branch::query()->findOrFail($id);
        $branch->update([
            'name' => $request['name'],
            'address' => $request['address'],
        ]);

        return response()->json([
            'message' => 'Updated successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $branch = Branch::query()->findOrFail($id);
        $branch->delete();
        return response()->json([
            'message' => 'Deleted successfully',
            'status' => 'success',
        ]);
    }
}
