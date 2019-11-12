<?php

namespace App\Http\Controllers\Api;

use App\Classe as Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return response([
            'status' => 'success',
            'data' => Kelas::all()
        ]);
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
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = Kelas::find($id);

        if ($class)
            return response([
                'status' => 'success',
                'data' => $class
            ]);

        return response([
            'status' => 'failed',
            'messages' => 'File Not Found!'
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
