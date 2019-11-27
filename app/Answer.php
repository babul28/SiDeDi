<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Answer extends Model
{
    /**
     * The attribute that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['question_id', 'student_id', 'value'];

    /**
     * Relation Many to One with Classes Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class()
    {
        return $this->belongsTo('App\Classe', 'class_id');
    }

    /**
     * Relation Many to One with Questions Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    /**
     * Relation Many to One with Students Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
