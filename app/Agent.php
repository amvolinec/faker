<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_agents';
}
