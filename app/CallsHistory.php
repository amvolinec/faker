<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallsHistory extends Model
{
    public $timestamps = false;
	protected $connection = 'mysql2';
    protected $table = 'fv_calls_history';
}
