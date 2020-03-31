<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplianceItemGroup extends Model
{
    //
    protected $table = 'compliance_item_groups'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'item_group_id';
    protected $fillable = [
        'packages_id',
        'item_group_name',
        'item_group_description',
        'item_group_disable'
    ];

    public function itemGroupToItem()
    {
        return $this->hasMany('App\ComplianceItem','item_group_id');   
    }

    public function itemGroupToPackage()
    {
        return $this->belongsTo('App\CompliancePackage','packages_id');   
    }
}
