<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param string $id
     * @return JsonResponse
     */
    public function getById (string $id): JsonResponse
    {
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store (Request $request): JsonResponse
    {
        return response()->json(
            User::create(
                $request->validate([
                    'name' => ['required', 'nullable', 'string', 'max:150'],
                    'password' => ['required', 'string', 'min:4', 'max:100'],
                    'email' => ['required', 'email', 'unique:App\Models\User', 'max:100']
                ])
            )
        );
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function deleteById (string $id): JsonResponse
    {
        User::where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateById (string $id, Request $request): JsonResponse
    {
        $user = User::where('id', $id);

        $updateArray = $request->validate([
            'name' => ['nullable', 'string', 'max:150'],
            'password' => ['string', 'min:4', 'max:100'],
            'email' => ['email', 'unique:App\Models\User', 'max:100']
        ]);

        $user->update($updateArray);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
