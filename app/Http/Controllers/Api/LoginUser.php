<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUser extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function __invoke(Request $request)
    {
        /**
         * Validation Request user
         *
         * @var String email
         * @var String password
         */
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        /**
         * Checking Authentication of User
         *
         * @return App\Http\Resources\UserResource
         */
        if (Auth::once($request->only(['email', 'password']))) {
            $currentUser = Auth::user();

            return (new UserResource($currentUser))->additional([
                'meta' => [
                    'api_token' => $currentUser->api_token,
                ],
            ]);
        }

        /**
         * If Authentication Checking is Invalid
         *
         * @return \Illuminate\Http\Response
         */
        return response([
            'data' => [
                'type' => 'Your credentials not match!'
            ],
        ], 203);
    }
}
