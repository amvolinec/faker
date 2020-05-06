<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_persons';

    protected $fillable = [
        'username',
        'password',
        'salt',
        'name',
        'email',
        'phone',
        'company',
        'see_status',
        'date_pass_changed',
        'date_created',
        'date_updated',
        'date_visited',
        'changed_by_username',
        'is_deleted',
    ];

    public function permission() {
        return $this->hasOne('App\PersonPermission');
    }

    public function roles() {
        return $this->hasOne('App\AssignedRole', 'entity_id', 'id');
    }

    public function agent()
    {
        return $this->hasOne('App\Agent');
    }
}
