<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    /**
     * The attribute that are mass assignable     
     *
     * @var array
     */
    protected $fillable = ['id_class', 'id_question', 'value'];
}
