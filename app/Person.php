<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_persons';

    protected $fillable = [
        'cl_sys_id',
        'company',
        'name',
        'email',
        'phone',
        'username',
        'password',
        'salt',
        'is_deleted',
        'date_created',
        'date_updated',
        'date_visited',
        'date_pass_changed',
        'changed_by_username',
    ];
}
