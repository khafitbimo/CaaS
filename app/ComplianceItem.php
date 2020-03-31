<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplianceItem extends Model
{
    //
    protected $table = 'compliance_items'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'item_id';
    protected $fillable = [
        'item_group_id',
        'status_id',
        'item_name',
        'item_description',
        'item_disable',
    ];

    public function itemToItemGroup()
    {
        return $this->belongsTo('App\ComplianceItemGroup','item_group_id');   
    }
}
