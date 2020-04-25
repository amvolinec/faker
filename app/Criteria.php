<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    public $timestamps = false;

    protected $fillable = ['matrix_id', 'group_id', 'name', 'weight'];

    protected $connection = 'mysql2';
    protected $table = 'fv_ev_criteria';

    public function matrix(){
        return $this->belongsTo('App\Matrix', 'matrix_id');
    }

    public function group(){
        return $this->belongsTo('App\EvGroup', 'group_id');
    }
}
