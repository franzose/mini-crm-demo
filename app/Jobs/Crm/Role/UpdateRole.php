<?php

namespace CrmDemo\Jobs\Crm\Role;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\Role;
use CrmDemo\Jobs\Job;

class UpdateRole extends Job implements SelfHandling {

	/**
	 * Модель роли пользователя.
	 *
	 * @var Role
	 */
	private $role;

	/**
	 * Название роли.
	 *
	 * @var string
	 */
	private $title;

	/**
	 * @param Role $role
	 * @param $title
	 */
	public function __construct(Role $role, $title)
	{
		$this->role = $role;
		$this->title = $title;
	}

	/**
	 * Обновляет роль.
	 *
	 */
	public function handle()
	{
		$this->role->title = $this->title;
		$this->role->save();
	}
}