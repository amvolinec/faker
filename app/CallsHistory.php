<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallsHistory extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_calls_history';

    public function getCallerIdAttribute($value)
    {
        return preg_replace( '/[^0-9]/', '', $value );
    }

    public function getCalledIdAttribute($value)
    {
        return preg_replace( '/[^0-9]/', '', $value );
    }
}
