<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $table = 'accounts'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'account_id';
    protected $fillable = [
        'account_code',
        'account_name',
        'account_description',
        'account_email',
        'account_address',
        'account_phone',
    ];

    public function accountToPackage()
    {
        return $this->hasMany('App\AccountPackage','account_id');
    }

    public function accountToItemGroup()
    {
        return $this->hasMany('App\AccountItemGroup','account_id');
    }

    public function accountToItem()
    {
        return $this->hasMany('App\AccountItem','account_id');
    }

}
