<?php

namespace CrmDemo\Jobs\Crm\User;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use CrmDemo\Jobs\Job;

/**
 * Задача обновления пользовательского профиля.
 *
 * @package CrmDemo\Jobs\Crm
 */
class UpdateUserProfile extends Job implements SelfHandling {

	/**
	 * @param array $attributes
	 */
	public function __construct(array $attributes)
	{
		$this->attributes = $attributes;
	}

	public function handle(Request $request)
	{
		$request->user()
			->fill($this->attributes)
			->save();
	}
}