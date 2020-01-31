<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request['password']);
            $user->save();

            return (new UserResource($user))->additional([
                'meta' => [
                    'api_token' => $user->api_token,
                ],
            ]);
        }

        return response()->json([
            'data' => [
                'status' => 'email may not registered!',
            ]
        ], 404);
    }
}
