<?php

namespace CrmDemo\Jobs\Crm\CustomerEventType;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerEventType;
use CrmDemo\Jobs\Job;

/**
 * Class DestroyCustomerEventType
 * @package CrmDemo\Jobs\Crm\CustomerEventType
 */
class DestroyCustomerEventType extends Job implements SelfHandling {

	/**
	 * Модель типа событий.
	 *
	 * @var CustomerEventType
	 */
	private $type;

	/**
	 * @param CustomerEventType $type
	 */
	public function __construct(CustomerEventType $type)
	{
		$this->type = $type;
	}

	/**
	 * Удаляет тип событий.
	 *
	 * @throws \Exception
	 */
	public function handle()
	{
		$this->type->delete();
	}
}