<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_agents';

    protected $fillable = [
        'person_id',
        'username',
        'password',
        'context',
        'is_password_required',
        'is_deleted',
        'listen_status',
    ];

    public function person()
    {
        return $this->belongsTo('App\Person', 'person_id', 'id');
    }

//    public function queues()
//    {
//        return $this->belongsToMany('App\Queue', 'fv_agents_to_queues', 'fv_agents_id', 'fv_queues_id');
//    }
//
//    public function status()
//    {
//        return $this->hasOne('App\AgentStatus', 'fv_agents_id', 'id');
//    }
}
