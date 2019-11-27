<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attribute that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['question'];

    /**
     * Relation One to Many with Answers Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * Relation One to One with CategoryRelations Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\CategoryQuestion', 'category_question_id');
    }
}
