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
}
