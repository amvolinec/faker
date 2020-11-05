<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_call_theme';

    protected $fillable = [
        'fv_queues_id', 'name', 'deleted', 'prio'
    ];

    public function queue()
    {
        return $this->belongsTo('App\Queue', 'fv_queues_id', 'id');
    }
}
