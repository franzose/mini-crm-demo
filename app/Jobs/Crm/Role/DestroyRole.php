<?php

namespace CrmDemo\Jobs\Crm\Role;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\Role;
use CrmDemo\Jobs\Job;

/**
 * Class DestroyRole
 * @package CrmDemo\Jobs\Crm\Role
 */
class DestroyRole extends Job implements SelfHandling {

	/**
	 * Модель роли.
	 *
	 * @var Role
	 */
	private $role;

	/**
	 * @param Role $role
	 */
	public function __construct(Role $role)
	{
		$this->role = $role;
	}

	/**
	 * Удаляет роль.
	 *
	 * @throws \Exception
	 */
	public function handle()
	{
		$this->role->delete();
	}
}