<?php

namespace CrmDemo\Jobs\Crm\CustomerStatus;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerStatus;
use CrmDemo\Jobs\Job;

class DestroyCustomerStatus extends Job implements SelfHandling {

	/**
	 * Модель статуса переговоров.
	 *
	 * @var CustomerStatus
	 */
	private $status;

	/**
	 * @param CustomerStatus $status
	 */
	public function __construct(CustomerStatus $status)
	{
		$this->status = $status;
	}

	/**
	 * Удаляет статус переговоров.
	 *
	 * @throws \Exception
	 */
	public function handle()
	{
		$this->status->delete();
	}
}