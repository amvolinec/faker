<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'original_name', 'name', 'path', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
