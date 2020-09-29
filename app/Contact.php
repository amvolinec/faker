<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_addressbook_contact';

    protected $fillable = [
        'phone',
        'person',
        'email',
        'address',
        'comments',
        'fv_addressbook_category_id',
        'fv_addressbook_company_id',
        'blacklisted',
        'queue_id',
        'created',
        'updated',
        'edited_person_id',
    ];

    public function persons(){
        return $this->BelongsTo('App\Company', 'fv_addressbook_company_id', 'id');
    }
}
