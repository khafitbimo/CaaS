<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountItem extends Model
{
    //
    protected $table = 'account_items'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'id';
    protected $fillable = [
        'account_id',
        'packages_id',
        'item_group_id',
        'item_id',
        'status_id',
        'suggested_approach',
        'notes',
        'isdisable',
    ];

    public function accountItemToAccount()
    {
        return $this->belongsTo('App\Account','account_id');   
    }

    public function accountItemToPackages()
    {
        return $this->belongsTo('App\CompliancePackage','packages_id');   
    }

    public function accountItemToItemGroup()
    {
        return $this->belongsTo('App\ComplianceItemGroup','item_group_id');   
    }

    public function accountItemToItem()
    {
        return $this->belongsTo('App\ComplianceItem','item_id');   
    }

    public function accountItemToStatus()
    {
        return $this->belongsTo('App\ItemStatus','status_id');   
    }
}
