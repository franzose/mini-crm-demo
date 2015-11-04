<?php

namespace CrmDemo\Jobs\Crm\CustomerStatus;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerStatus;
use CrmDemo\Jobs\Job;

class CreateCustomerStatus extends Job implements SelfHandling {

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
	 * Создает новый статус переговоров.
	 *
	 * @param CustomerStatus $status
	 * @return int
	 */
	public function handle(CustomerStatus $status)
	{
		return $status->create($this->attributes)->getKey();
	}
}