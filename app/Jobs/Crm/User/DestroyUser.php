<?php

namespace CrmDemo\Jobs\Crm\User;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\User;
use CrmDemo\Jobs\Job;

class DestroyUser extends Job implements SelfHandling {

	/**
	 * Модель пользователя.
	 *
	 * @var User
	 */
	private $user;

	/**
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Удаляет пользователя из системы.
	 *
	 * @throws \Exception
	 */
	public function handle()
	{
		$this->user->delete();
	}
}