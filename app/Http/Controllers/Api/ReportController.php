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
     * String for Conclusion based on category Question
     *
     * @var array
     */
    private $getConclusions = [
        'ekslusif' => [
            1 => 'Rata-rata siswa kelas anda bisa bersikap terbuka dengan kelompok lain, tidak membatasi pergaulan diri, dan memiliki kepedulian dengan sesama meski berbeda agama',
            2 => 'Rata-rata siswa kelas anda kurang sedikit bisa terbuka dengan kelompok lain, terkadang membatasi pergaulan diri, dan di waktu tertentu acuh terhadap kelompok yang berbeda agama',
            3 => 'Rata-rata siswa kelas anda sangat tertutup terhadap keberadaan kelompok lain, perlu untuk membuka diri terhadap pergaulan di luar kelompok anda'
        ],
        'intoleran' => [
            1 => 'Rata-rata siswa kelas anda sulit untuk berprasangka buruk terhadap kelompok lain,  mudah menerima keberadaan kelompok yang tidak seagama, sehingga mampu memperlakukan kelompok lain dengan sangat baik',
            2 => 'Rata-rata siswa kelas anda terkadang sulit menerima keberadaan kelompok lain sehingga dapat memunculkan prasangka yang tidak baik',
            3 => 'Rata-rata siswa kelas anda sangat sulit untuk menerima keberadaan kelompok lain, perlu untuk bisa membuka diri atas keberagamaan lingkungan di mana anda hidup'
        ],
        'ekstream' => [
            1 => 'Rata-rata siswa kelas anda berpandangan bahwa ideologi negara adalah keyakinan yang perlu dibela, karena anda meyakini bahwa tidak ada pertentangan antara ideologi negara dengan ajaran agama',
            2 => 'Rata-rata siswa kelas anda sedikit memiliki anggapan bahwa di bagian tertentu ideologi negara bertentangan dengan ajaran agama yang anda percayai',
            3 => 'Rata-rata siswa kelas anda berpandangan bahwa ideologi negara sangat bertentangan dengan ajaran agama yang anda yakini sehingga perlu untuk direvisi'
        ],
        'kekerasan' => [
            1 => 'Rata-rata siswa kelas anda tidak menyetujui bahwa satu-satunya cara untuk membela agama adalah dengan cara melakukan Kekerasan fisik',
            2 => 'Rata-rata siswa kelas anda terkadang bisa berbuat kasar apabila agama yang kelompok anda percayai diganggu oleh kelompok lain',
            3 => 'Rata-rata siswa kelas anda beranggapan bahwa penggunaan kekerasan dalam menegakkan agama adalah kewajiban'
        ],
    ];

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

        // Get conclusions from the average attitude of students
        $studentsCount = $class->students->count();

        // if the class has students, then data will be displayed. if not, an empty array will be returned
        $roundAvgEkslusif = round($class->students->avg('report.eksklusif'));
        $roundAvgIntoleran = round($class->students->avg('report.intoleran'));
        $roundAvgEkstream = round($class->students->avg('report.ekstream'));
        $roundAvgKekerasan = round($class->students->avg('report.kekerasan'));

        $averageClassReport = [
            'ekslusif' => $studentsCount == 0 ? '' : $this->getConclusions['ekslusif'][$roundAvgEkslusif],
            'intoleran' => $studentsCount == 0 ? '' : $this->getConclusions['intoleran'][$roundAvgIntoleran],
            'ekstream' => $studentsCount == 0 ? '' : $this->getConclusions['ekstream'][$roundAvgEkstream],
            'kekerasan' => $studentsCount == 0 ? '' : $this->getConclusions['kekerasan'][$roundAvgKekerasan],
            'valEkslusif' => $studentsCount == 0 ? '' : $roundAvgEkslusif,
            'valIntoleran' => $studentsCount == 0 ? '' : $roundAvgIntoleran,
            'valEkstream' => $studentsCount == 0 ? '' : $roundAvgEkstream,
            'valKekerasan' => $studentsCount == 0 ? '' : $roundAvgKekerasan,
        ];

        return (new ClassWithReportResources($class))->additional([
            'meta' => [
                'kecenderunganPositif' => [
                    'students' => $filtered->has('kecenderungan positif') ? new StudentWithReportCollection($filtered['kecenderungan positif']) : [],
                    'students_count' => $filtered->has('kecenderungan positif') ? $filtered['kecenderungan positif']->count() : 0,
                ],
                'kecenderunganNegatif' => [
                    'students' => $filtered->has('kecenderungan negatif') ? new StudentWithReportCollection($filtered['kecenderungan negatif']) : [],
                    'students_count' => $filtered->has('kecenderungan negatif') ? $filtered['kecenderungan negatif']->count() : 0,
                ],
                'averageClassReport' => $averageClassReport,
            ],
        ]);
    }
}
