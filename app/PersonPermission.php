<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonPermission extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_persons_permissions';

    protected $fillable = [
        'person_id',
        'status_see',
        'status_listen',
        'status_eval',
        'monitoring_style',
    ];
}
