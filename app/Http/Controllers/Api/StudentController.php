<?php

namespace App\Http\Controllers\Api;

use App\Classe;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'items' => Student::with('class', 'answers.question.category')->get(),
            ]
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classe $class)
    {
        $request->validate([
            'name' => 'required',
            'NISN' => 'required|min:10|numeric',
            'gender' => 'required',
            'religion' => 'required',
            'age' => 'required',
            'class_id' => 'required'
        ]);

        $student = $class->findOrFail($request->class_id)->students()->create([
            'name' => $request->name,
            'NISN' => $request->NISN,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'age' => $request->age,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student->loadMissing('class', 'answers.question.category');

        if ($student) {
            return response()->json([
                'status' => 'success',
                'data' => $student,
            ], 200);
        }
    }
}
