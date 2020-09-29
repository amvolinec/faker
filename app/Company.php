<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'fv_addressbook_company';

    protected $fillable = [
        'name',
        'comments',
        'vip',
        'address',
        'code',
        'vat_code',
        'debt',
        'email',
        'activity',
        'employees',
        'contract_no',
        'contract_end_date',
        'created',
        'updated',
    ];

    public function persons(){
        return $this->HasMany('App\Contact', 'fv_addressbook_company_id', 'id');
    }
}
