<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{

    public function table()
    {
        return $this->belongsTo('App\Table', 'table_id');
    }
}
