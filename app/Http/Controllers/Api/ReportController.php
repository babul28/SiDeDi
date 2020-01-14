<?php

namespace App\Http\Controllers\Api;

use App\Classe;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassWithReportCollection;
use App\Http\Resources\ClassWithReportResources;
use App\Http\Resources\StudentWithReportCollection;
use App\Report;
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
        return new ClassWithReportCollection(Classe::where('id', Auth::user()->id)->with(
            'students.answers.question.category',
            'user.teacherBiodata',
            'students.report'
        )->get());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param Report $report
     * @return void
     */
    public function show(Classe $class)
    {
        $class->loadMissing('students.answers.question.category', 'user.teacherBiodata', 'students.report');

        // filter data based on summary then grouping
        $filtered = $class->students->groupBy('report.summary');

        return (new ClassWithReportResources($class))->additional([
            'meta' => [
                'kecenderunganPositif' => [
                    'students' => $filtered->has('kecenderungan positif') ? new StudentWithReportCollection($filtered['kecenderungan positif']) : [],
                ],
                'kecenderunganNegatif' => [
                    'students' => $filtered->has('kecenderungan negatif') ? new StudentWithReportCollection($filtered['kecenderungan negatif']) : [],
                ]
            ],
        ]);
    }
}
