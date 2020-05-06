<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_agents';

    protected $fillable = [
        'groups_id',
        'date_created',
        'date_updated',
        'username',
        'password',
        'name',
        'email',
        'fv_queues_id_outbound',
        'fv_queues_id_local',
        'is_password_required',
    ];

    public function queues()
    {
        return $this->belongsToMany('App\Queue', 'fv_agents_to_queues', 'fv_agents_id', 'fv_queues_id');
    }

    public function status()
    {
        return $this->hasOne('App\AgentStatus', 'fv_agents_id', 'id');
    }
}
