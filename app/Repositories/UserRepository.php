<?php

namespace CrmDemo\Repositories;

use CrmDemo\Domain\Models\Role;
use CrmDemo\Domain\Models\User;
use CrmDemo\Domain\Repositories\UserRepository as UserRepositoryContract;

/**
 * Репозиторий пользователей системы.
 *
 * @package CrmDemo\Repositories
 */
class UserRepository extends BaseRepository implements UserRepositoryContract {

	/**
	 * Модель пользователя.
	 *
	 * @var User
	 */
	protected $model;

	/**
	 * Конструктор репозитория.
	 *
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		parent::__construct($user);
	}

	/**
	 * Возвращает менеджеров.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getManagers()
	{
		return $this->setColumns(['users.*'])
			->getQuery()
			->join('role_user', 'role_user.user_id', '=', $this->model->getQualifiedKeyName())
			->join('roles', 'roles.id', '=', 'role_user.role_id')
			->where('roles.name', 'manager')
			->get();
	}
}