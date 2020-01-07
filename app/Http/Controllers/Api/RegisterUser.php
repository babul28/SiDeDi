<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Validation\Rule;

class RegisterUser extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'NIP' => 'required|numeric',
            'gender' => [
                'required',
                Rule::in(['laki-laki', 'perempuan'])
            ],
            'religion' => ['required', Rule::in(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'])],
            'institution' => 'required',
        ]);

        $user =  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(80),
        ]);

        $user->teacherBiodata()->create([
            'NIP' => $request->NIP,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'institution' => $request->institution,
        ]);

        $user->loadMissing('teacherBiodata');

        /**
         * return UserResource with Meta data
         *
         * @meta api_token
         */
        return (new UserResource($user))->additional([
            'meta' => [
                'api_token' => $user->api_token,
            ],
        ]);
    }
}
