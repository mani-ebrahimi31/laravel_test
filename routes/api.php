<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user/{id}', function (string $id){
    $user = User::where('id', $id)->first();
    return response()->json($user);
});

Route::post('/user', function (Request $request){
    return response()->json(
        User::create(
            $request->validate([
                'name' => ['required', 'nullable', 'string', 'max:150'],
                'password' => ['required', 'string', 'min:4', 'max:100'],
                'email' => ['required', 'email', 'unique:App\Models\User', 'max:100']
            ])
        )
    );
});

Route::delete('/user/{id}', function (string $id){
    User::where('id', $id)->delete();

    return response()->json([
        'status' => 'success',
    ]);
});

Route::put('/user/{id}', function (Request $request, string $id){
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
});
