<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountItemGroup extends Model
{
    //
    protected $table = 'account_item_groups'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_id',
        'packages_id',
        'item_group_id',
        'status_id',
        'isdisable',
    ];

    public function accountItemGroupToAccount()
    {
        return $this->belongsTo('App\Account','account_id');   
    }

    public function accountItemGroupToPackages()
    {
        return $this->belongsTo('App\CompliancePackage','packages_id');   
    }

    public function accountItemGroupToItemGroup()
    {
        return $this->belongsTo('App\ComplianceItemGroup','item_group_id');   
    }

    public function accountItemgGroupToStatus()
    {
        return $this->belongsTo('App\ItemStatus','status_id');   
    }

    
}
