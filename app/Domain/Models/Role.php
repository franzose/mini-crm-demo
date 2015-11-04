<?php

namespace CrmDemo\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель роли пользователя в системе.
 *
 * @package CrmDemo\Domain\Models
 */
class Role extends Model {

	/**
	 * Таблица без колонок дат.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Заполняемые атрибуты.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'title'];

	/**
	 * Пользователи с данной ролью.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function users()
	{
		return $this->belongsToMany(User::class);
	}

	/**
	 * Администраторы.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function administrators()
	{
		//return $this->users()->where('role.name', 'Администратор');
	}

	/**
	 * Менеджеры.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function managers()
	{
		//return $this->users()->where('role.name', 'Менеджер');
	}
}