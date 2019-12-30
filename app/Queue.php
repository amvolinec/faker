<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_queues';
}
