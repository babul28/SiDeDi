<?php

namespace App\Http\Controllers\Api;

use App\Classe;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassCollection;
use App\Http\Resources\ClassWithReportCollection;
use App\Http\Resources\ReportCollection;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json([
        //     'status' => 'success',
        //     'data' => [
        //         'items' => Report::with('student.class', 'student.answers.question.category')->get(),
        //     ]
        // ], 200);

        return new ClassWithReportCollection(Classe::where('id', Auth::user()->id)->with('students.answers.question.category', 'user.teacherBiodata', 'students.report')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param Report $report
     * @return void
     */
    public function show(Report $report)
    {
        // Load missing relationship from model binding
        $report->loadMissing('student.class', 'student.answers.question.category');

        if ($report) {
            return response()->json([
                'status' => 'success',
                'data' => $report,
            ], 200);
        }
    }
}
