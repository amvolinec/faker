<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{

    protected $fillable = [
        'name', 'value', 'command', 'is_function', 'options'
    ];

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
