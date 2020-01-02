<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_agents_groups';
}
