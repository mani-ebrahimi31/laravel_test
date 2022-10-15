<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login (Request $request): JsonResponse
    {
        $loginData = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        $admin = Admin::where('name', $loginData['name'])->first();

        if (! empty($admin) && Hash::check($loginData['password'], $admin->password))
        {
            return response()->json([
                'token' => $admin->createToken('auth_token')->plainTextToken
            ]);
        }

        return response()->json([
            'code' => 2,
            'message' => 'login data is wrong'
        ], 403);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAdminByRequest(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
