<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;

    protected $fillable = ['criteria_id', 'name', 'description', 'weight'];

    protected $connection = 'mysql2';
    protected $table = 'fv_ev_options';

    public function criteria(){
        return $this->belongsTo('App\Criteria', 'criteria_id');
    }
}
