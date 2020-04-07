<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompliancePackage extends Model
{
    //
    protected $table = 'compliance_packages'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'packages_id';
    protected $fillable = [
        'packages_name',
        'packages_description',
        'packages_disable',
    ];

    public function packageToItemGroup()
    {
        return $this->hasMany('App\ComplianceItemGroup','packages_id');
    }

    public function packageToAccountItem()
    {
        return $this->hasMany('App\AccountItem','packages_id');
    }

    public function packageToAccountItemGroup()
    {
        return $this->hasMany('App\AccountItemGroup','packages_id');
    }

    public function packageToAccountPackage()
    {
        return $this->hasMany('App\AccountPackage','packages_id');
    }
}
