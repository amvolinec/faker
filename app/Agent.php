<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_agents';

    public function queues()
    {
        return $this->belongsToMany('App\Queue', 'fv_agents_to_queues', 'fv_agents_id', 'fv_queues_id');
    }
}
