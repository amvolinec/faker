<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{

    public function table()
    {
        return $this->belongsTo('App\Table', 'table_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
    ];
}
