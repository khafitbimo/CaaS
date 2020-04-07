<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    protected $table = 'item_status'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'status_id';
    protected $fillable = [
        'status_name',
        'status_description',
        'status_disable',
    ];

    public function itemStatusToAccountItem()
    {
        return $this->hasMany('App\AccountItem','status_id');
    }

    public function itemStatusToAccountItemGroup()
    {
        return $this->hasMany('App\AccountItemGroup','status_id');
    }

    public function itemStatusToAccountPackage()
    {
        return $this->hasMany('App\AccountPackage','status_id');
    }
}
