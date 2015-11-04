<?php

namespace CrmDemo\Jobs\Crm\Role;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\Role;
use CrmDemo\Jobs\Job;

class CreateRole extends Job implements SelfHandling {

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
	 * Создает новую роль.
	 *
	 * @param Role $role
	 * @return int
	 */
	public function handle(Role $role)
	{
		return $role->create($this->attributes)->getKey();
	}
}