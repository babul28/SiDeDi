<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->loadMissing('TeacherBiodata');
        return new ProfileResources($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email',
            'NIP' => 'required|numeric',
            'gender' => [
                'required',
                Rule::in(['laki-laki', 'perempuan'])
            ],
            'religion' => ['required', Rule::in(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'])],
            'institution' => 'required',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->TeacherBiodata()->update([
            'NIP' => $request->NIP,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'institution' => $request->institution,
        ]);

        return new ProfileResources($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request)
    {
        $request->validate([
            'image_profile' => 'required|image|max:2048',
        ]);

        $pathFile = Storage::disk('public')->putFile('images', $request->file('image_profile'));
        $pathFile = Storage::disk('public')->url($pathFile);

        $user = Auth::user();
        $user->TeacherBiodata()->update([
            'image_profile' => htmlspecialchars($pathFile),
        ]);

        return new ProfileResources($user);
    }
}
