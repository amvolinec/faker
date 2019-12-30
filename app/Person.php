<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_persons';
}
