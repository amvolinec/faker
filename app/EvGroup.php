<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvGroup extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'matrix_id'];

    protected $connection = 'mysql2';
    protected $table = 'fv_ev_group';

    public function matrix(){
        return $this->belongsTo('App\Matrix', 'matrix_id');
    }
}
