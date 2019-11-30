<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionCollection;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowQuestion extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke()
    {
        return new QuestionCollection(Question::inRandomOrder()->get());
    }
}
