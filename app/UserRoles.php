<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    //
    protected $table = 'user_roles'; //untuk mendeklarasikan ulang nama table dari mysql
    protected $primaryKey = 'id';
    protected $fillable = [
        'roles_name',
        'roles_description',
        'roles_disable',
    ];


}
