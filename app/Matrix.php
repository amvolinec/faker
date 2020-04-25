<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matrix extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'disabled', 'created', 'updated'];

    protected $connection = 'mysql2';
    protected $table = 'fv_ev_matrix';
}
