<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_queues';

    protected $fillable = [
        'name', 'alias', 'timeout', 'wrapuptime', 'weight', 'sla'
    ];

    public function persons(){
        return $this->belongsToMany('App\Person', 'fv_persons_to_queues', 'fv_queues_id', 'fv_persons_id');
    }

    public function themes(){
        return $this->hasMany('App\Theme', 'fv_queues_id', 'id');
    }
}
