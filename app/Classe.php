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
}
