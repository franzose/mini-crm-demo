<?php

namespace CrmDemo\Jobs\Crm\User;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\User;
use CrmDemo\Jobs\Job;

/**
 * Задача создания нового сотрудника.
 *
 * @package CrmDemo\Jobs\Crm
 */
class CreateUser extends Job implements SelfHandling {

	/**
	 * @var array
	 */
	private $attributes;

	/**
	 * @param array $attributes
	 */
	public function __construct(array $attributes)
	{
		$this->attributes = $attributes;
	}

	/**
	 * Создает нового сотрудника.
	 *
	 * @param User $user
	 * @return int
	 */
	public function handle(User $user)
	{
		$roles = array_pull($this->attributes, 'roles');
		$user = $user->create($this->attributes);
		$user->roles()->sync($roles);

		return $user->getKey();
	}
}