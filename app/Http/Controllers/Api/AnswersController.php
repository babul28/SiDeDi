<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Classe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use App\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;

class AnswersController extends Controller
{
    /**
     * String for Conclusion based on category Question
     *
     * @var array
     */
    private $getConclusions = [
        'Eksklusif' => [
            1 => 'Anda bisa bersikap terbuka dengan kelompok lain, tidak membatasi pergaulan diri, dan memiliki kepedulian dengan sesama meski berbeda agama',
            2 => 'Anda kurang sedikit bisa terbuka dengan kelompok lain, terkadang membatasi pergaulan diri, dan di waktu tertentu acuh terhadap kelompok yang berbeda agama',
            3 => 'Anda sangat tertutup terhadap keberadaan kelompok lain, perlu untuk membuka diri terhadap pergaulan di luar kelompok anda'
        ],
        'Intoleran' => [
            1 => 'Anda sulit untuk berprasangka buruk terhadap kelompok lain,  mudah menerima keberadaan kelompok yang tidak seagama, sehingga mampu memperlakukan kelompok lain dengan sangat baik',
            2 => 'Anda terkadang sulit menerima keberadaan kelompok lain sehingga dapat memunculkan prasangka yang tidak baik',
            3 => 'Anda sangat sulit untuk menerima keberadaan kelompok lain, perlu untuk bisa membuka diri atas keberagamaan lingkungan di mana anda hidup'
        ],
        'Ekstream' => [
            1 => 'Anda berpandangan bahwa ideologi negara adalah keyakinan yang perlu dibela, karena anda meyakini bahwa tidak ada pertentangan antara ideologi negara dengan ajaran agama',
            2 => 'Anda sedikit memiliki anggapan bahwa di bagian tertentu ideologi negara bertentangan dengan ajaran agama yang anda percayai',
            3 => 'Anda berpandangan bahwa ideologi negara sangat bertentangan dengan ajaran agama yang anda yakini sehingga perlu untuk direvisi'
        ],
        'Kekerasan' => [
            1 => 'Anda tidak menyetujui bahwa satu-satunya cara untuk membela agama adalah dengan cara melakukan jihad fisik',
            2 => 'Anda terkadang bisa berbuat kasar apabila agama yang anda percayai diganggu oleh kelompok lain',
            3 => 'Jihad fisik ke medan perang adalah hal yang tidak bisa ditawar kembali'
        ],
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'status' => 'success',
            'data' => Classe::with('students.answers.question.category')->has('students')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        $request->validate([
            'student_id' => 'required',
            'answers' => 'required',
        ]);

        $dataAnswer = [];

        foreach ($request->answers as $item) {
            $dataAnswer[] = [
                'student_id' => $request->student_id,
                'question_id' => $item['question_id'],
                'value' => $item['value'],
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ];
        }

        /**
         * insert bulk answer with one query
         * time to execute is less than 100 ms
         */
        Answer::insert($dataAnswer);

        /**
         * insert bulk answer with relationship
         * but time to create is grather than 1 sec
         *
         * because inserting data one by one
         */
        // $student->find($request->student_id)->answers()->createMany($request->answer);

        $student = Student::with('class')->findOrFail($request->student_id);

        return response([
            'status' => 'success',
            'data' => [
                'student' => $student,
                'report' => $this->report($request)
            ],
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Student::with('answers.question.category', 'class')->findOrFail($id);

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
     * @param Request $request
     * @return array
     */
    private function report(Request $request)
    {
        $conclusion = $this->getConclusion($request);

        Report::create([
            'student_id' => $request['student_id'],
            'eksklusif'   => $conclusion['Eksklusif'],
            'intoleran'  => $conclusion['Intoleran'],
            'ekstream'    => $conclusion['Ekstream'],
            'kekerasan'  => $conclusion['Kekerasan'],
        ]);

        return [
            'Eksklusif' => $this->getConclusions['Eksklusif'][$conclusion['Eksklusif']],
            'Intoleran' => $this->getConclusions['Intoleran'][$conclusion['Intoleran']],
            'Ekstream' => $this->getConclusions['Ekstream'][$conclusion['Ekstream']],
            'Kekerasan' => $this->getConclusions['Kekerasan'][$conclusion['Kekerasan']],
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getConclusion(Request $request)
    {
        $answer = collect($request->answers);

        $EksklusifAnswer = ($this->filterAnswer($answer, 1) >= 3) ? 3 : ($this->filterAnswer($answer, 1) >= 2 && $this->filterAnswer($answer, 1)  < 3 ? 2 : 1);
        $IntoleranAnswer = ($this->filterAnswer($answer, 2) >= 3) ? 3 : ($this->filterAnswer($answer, 2) >= 2 && $this->filterAnswer($answer, 2)  < 3 ? 2 : 1);
        $EkstreamAnswer = ($this->filterAnswer($answer, 3) >= 3) ? 3 : ($this->filterAnswer($answer, 3) >= 2 && $this->filterAnswer($answer, 3)  < 3 ? 2 : 1);
        $KekerasanAnswer = ($this->filterAnswer($answer, 4) >= 3) ? 3 : ($this->filterAnswer($answer, 4) >= 2 && $this->filterAnswer($answer, 4)  < 3 ? 2 : 1);

        return [
            'Eksklusif' => $EksklusifAnswer,
            'Intoleran' => $IntoleranAnswer,
            'Ekstream' => $EkstreamAnswer,
            'Kekerasan' => $KekerasanAnswer,
        ];
    }

    /**
     * @param Collection $collection
     * @param int $type
     * @return mixed
     */
    private function filterAnswer(Collection $collection, $type = 1)
    {
        return $collection->filter(function ($item, $key) use ($type) {
            switch ($type) {
                case '1':
                    return $item['question_id'] >= 1 && $item['question_id'] <= 12;
                    break;
                case '2':
                    return $item['question_id'] > 12 && $item['question_id'] <= 24;
                    break;
                case '3':
                    return $item['question_id'] > 24 && $item['question_id'] <= 36;
                    break;
                default:
                    return $item['question_id'] > 36 && $item['question_id'] <= 44;
                    break;
            }
        })->avg('value');
    }
}
