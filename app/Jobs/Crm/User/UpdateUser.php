<?php

namespace CrmDemo\Jobs\Crm\User;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\User;
use CrmDemo\Jobs\Job;

class UpdateUser extends Job implements SelfHandling {

	/**
	 * @var User
	 */
	private $user;

	/**
	 * @var array
	 */
	private $attributes;

	/**
	 * @param User $user
	 * @param array $attributes
	 */
	public function __construct(User $user, array $attributes)
	{
		$this->user = $user;
		$this->attributes = $attributes;
	}

	/**
	 * Обновляет данные сотрудника.
	 *
	 */
	public function handle()
	{
		$roles = array_pull($this->attributes, 'roles');

		$this->user->update($this->attributes);
		$this->user->roles()->sync($roles);
	}
}