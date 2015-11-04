<?php

namespace CrmDemo\Jobs\Crm\CustomerStatus;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerStatus;
use CrmDemo\Jobs\Job;

class UpdateCustomerStatus extends Job implements SelfHandling {

	/**
	 * Модель статуса переговоров.
	 *
	 * @var CustomerStatus
	 */
	private $status;

	/**
	 * @param CustomerStatus $status
	 * @param array $attributes
	 */
	public function __construct(CustomerStatus $status, array $attributes)
	{
		$this->status = $status;
		$this->attributes = $attributes;
	}

	/**
	 * Обновляет статус переговоров.
	 */
	public function handle()
	{
		$this->status->fill($this->attributes)->save();
	}
}