<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedRole extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'acl_assigned_roles';

    protected $fillable = [ 'role_id', 'entity_id', 'entity_type', 'scope'];

}
