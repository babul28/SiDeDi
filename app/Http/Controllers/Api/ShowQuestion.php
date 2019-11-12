<?php

namespace App\Http\Controllers\Api;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowQuestion extends Controller
{
    public function __invoke()
    {
        return response([
            'status' => 'success',
            'data' => Question::all()
        ]);
    }
}
