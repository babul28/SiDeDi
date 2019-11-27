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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'NIP', 'gender', 'religion', 'institution'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
