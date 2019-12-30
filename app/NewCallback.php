<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewCallback extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_new_callbacks';

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/\D/', '', $value);
    }
}
