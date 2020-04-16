<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roles','account_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getWithUserRoles()
    {
        return DB::table('Users')
                    ->select(
                        'Users.id as id',
                        'Users.name as name',
                        'Users.email as email',
                        'Users.password as password',
                        'Users.roles as roles',
                        'user_roles.roles_name as roles_name')
                    ->leftjoin('user_roles','Users.roles','=','user_roles.id')
                    ->orderBy('Users.id', 'asc')
                    ->get();

    }

    public function user_role()
    {
        // return $this->belongsTo('App\MstUserRoles','id');
        return DB::table('Users')
                    ->select(
                        'Users.id as id',
                        'Users.name as name',
                        'Users.email as email',
                        'Users.password as password',
                        'Users.roles as roles',
                        'user_roles.roles_name as roles_name')
                    ->leftjoin('user_roles','Users.roles','=','user_roles.id')
                    ->orderBy('Users.id', 'asc')
                    ->get();
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
        {

            if (is_array($roles)) {
                foreach ($roles as $role) {
                    if ($this->hasRole($role)) {
                        return true;
                    }
                }
            } else {
                if ($this->hasRole($roles)) {
                    return true;
                }
            }
            return false;
        }

    public function hasRole($role)
    {
        if ($this->user_role()->where('roles_name', $role)->first())
        {
            return true;
        }

        return false;
    }

    public function userToUserRoles()
    {
        return $this->belongsTo('App\UserRoles','roles');
    }

    public function userToAccounts()
    {
        return $this->belongsTo('App\Account','account_id');
    }
}
