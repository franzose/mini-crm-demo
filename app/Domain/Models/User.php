<?php

namespace CrmDemo\Domain\Models;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Модель пользователя в системе.
 *
 * @package CrmDemo\Domain\Models
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * Заполняемые атрибуты.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'login',
        'email',
        'phone',
        'password'
    ];

    /**
     * Атрибуты, скрываемые из JSON.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * @var array
     */
    protected $with = ['roles'];

    /**
     * Заказчики, за которых ответственен данный менеджер.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * Роли пользователя в системе.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Проверяет роль пользователя.
     *
     * @param string $role
     * @return bool
     */
    public function is($role)
    {
        foreach($this->roles as $available) {
            if ($available->name == $role) {
                return true;
            }
        }

        return false;
    }

    /**
     * Устанавливает хешированный пароль.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
