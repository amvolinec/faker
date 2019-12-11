<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function columns()
    {
        return $this->hasMany('App\Column');
    }
}
