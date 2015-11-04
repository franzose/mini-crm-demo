<?php

namespace CrmDemo\Jobs\Crm;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerEvent;
use CrmDemo\Jobs\Job;

/**
 * Class CreateCustomerEvent
 * @package CrmDemo\Jobs\Crm
 */
class CreateCustomerEvent extends Job implements SelfHandling {

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
	 * Создает новое событие.
	 *
	 * @param CustomerEvent $event
	 * @return int
	 */
	public function handle(CustomerEvent $event)
	{
		return $event->create($this->attributes)->getKey();
	}
}