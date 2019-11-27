<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attribute that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['student_id', 'eksklusif', 'intoleran', 'ekstream', 'kekerasan'];

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
     * Relation One to One with Students Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
