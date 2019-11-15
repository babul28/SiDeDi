<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherBiodata extends Model
{
    /**
     * Define Custom Name of Table
     *
     * @var string
     */
    protected $table = 'teacher_biodata';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
