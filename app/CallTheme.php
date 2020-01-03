<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallTheme extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_call_theme';
}
