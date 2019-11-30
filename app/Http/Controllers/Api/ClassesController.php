<?php

namespace App\Http\Controllers\Api;

use App\Classe as Kelas;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassCollection;
use App\Http\Resources\ClassResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Auth::user()->loadMissing('classes.students.answers.question.category', 'classes.user');

        return new ClassCollection($data->classes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pathFile = '';

        $class = Kelas::create([
            'name_class' => $request->name_class,
            'path_img_header' => htmlspecialchars($request->pathFile),
            'code_ref_class' => Str::random(10)
        ]);

        return response([
            'status' => 'success',
            'data' => $class
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $class
     * @return \Illuminate\Http\Response
     */
    public function show($class)
    {
        $class = Kelas::where('id', $class)->where('user_id', Auth::user()->id)->first();

        if ($class) {
            $class->loadMissing('students.answers.question.category');
            return response(new ClassResources($class), 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'File not Found!'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $class = Kelas::find($id);

        if ($class) {
            $class->name_class = $request->name_class;
            $class->save();

            return response([
                'status' => 'success',
                'data' => $class
            ]);
        }

        return response([
            'status' => 'failed',
            'messages' => 'File Not Found!'
        ], 404);
    }

    /**
     * @param Request $request
     * @param Kelas $class
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function join(Request $request, Kelas $class)
    {
        $studentClass = $class->with('user.teacherBiodata')->where('code_ref_class', $request->code)->first();

        if ($studentClass) {
            return response()->json([
                'status' => 'success',
                'data' => $studentClass
            ], 200);
        }

        return response([
            'status' => 'failed',
            'messages' => 'Class with ref code ' . $request->code . ' Not Found!'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Kelas::find($id);

        if ($class) {
            $class->delete();

            return response([
                'status' => 'success',
                'message' => 'delete data with id ' . $id . ' success'
            ]);
        }

        return response([
            'status' => 'failed',
            'message' => 'File Not Found!'
        ], 404);
    }
}
