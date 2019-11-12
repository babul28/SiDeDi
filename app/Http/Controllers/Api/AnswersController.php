<?php

namespace App\Http\Controllers\Api;

use App\Answers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswersController extends Controller
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
            'data' => Answers::all()
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
        $answer = Answers::create([
            'id_class' => $request->id_class,
            'id_question' => $request->id_question,
            'value' => $request->value
        ]);

        return response([
            'status' => 'success',
            'data' => $answer
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
        $answer = Answers::find($id);

        if ($answer)
            return response([
                'status' => 'success',
                'data' => $answer
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
        $answer = Answers::find($id);

        if ($answer) {
            $answer->name_class = $request->name_class;
            $answer->save();

            return response([
                'status' => 'success',
                'data' => $answer
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
        $answer = Answers::find($id);

        if ($answer) {
            $answer->delete();

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
