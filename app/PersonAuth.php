<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonAuth extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_person_auths';
}
