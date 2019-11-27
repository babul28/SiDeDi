<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
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
                'items' => Report::with('student.class', 'student.answers.question.category')->get(),
            ]
        ], 200);
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
