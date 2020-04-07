<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountPackage extends Model
{
    //
    protected $table = 'account_packages'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_id',
        'packages_id',
        'status_id',
        'isdisable',
    ];

    public function accountPackagesToAccount()
    {
        return $this->belongsTo('App\Account','account_id');   
    }

    public function accountPackagesToPackages()
    {
        return $this->belongsTo('App\CompliancePackage','packages_id');   
    }

    public function accountPackagesToStatus()
    {
        return $this->belongsTo('App\ItemStatus','status_id');   
    }
}
