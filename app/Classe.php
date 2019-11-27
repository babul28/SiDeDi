<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{

    /**
     * The attribute that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name_class', 'path_img_header', 'code_ref_class'];

    /**
     * Relation One to Many with Answers Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Answer', 'class_id');
    }

    /**
     * Relation Many to One with Users Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Relation One to Many with Reports Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\Report', 'class_id');
    }

    /**
     * Relation One to Many with Student Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Student', 'class_id');
    }
}
