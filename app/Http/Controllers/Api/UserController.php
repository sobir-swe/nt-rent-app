<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0"
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get list of users",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of users"
     *     )
     * )
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string|in:male,female',
            'password' => 'required|string|min:8',
            'position' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'password' => Hash::make($request['password']),
            'position' => $request['position'],
            'phone' => $request['phone'],
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'status' => 'success',
            'token' => $user->createToken($user->name)->plainTextToken,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(User::query()->findOrFail($id));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'gender' => 'required|string|in:male,female',
            'password' => 'nullable|string|min:8',
            'position' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::query()->findOrFail($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'password' => $request['password'] ? Hash::make($request['password']) : $user->password,
            'position' => $request['position'],
            'phone' => $request['phone'],
        ]);

        return response()->json([
            'message' => 'User updated successfully',
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully',
            'status' => 'success',
        ]);
    }
}
