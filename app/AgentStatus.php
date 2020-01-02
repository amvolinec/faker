<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentStatus extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_agents_status';

    protected $fillable = [
        'fv_agents_id',
        'date_updated',
        'fv_pauses_id',
    ];
}
