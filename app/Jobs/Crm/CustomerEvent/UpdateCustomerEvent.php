<?php

namespace CrmDemo\Jobs\Crm;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerEvent;
use CrmDemo\Jobs\Job;

/**
 * Class UpdateCustomerEvent
 * @package CrmDemo\Jobs\Crm
 */
class UpdateCustomerEvent extends Job implements SelfHandling {

	/**
	 * Модель события.
	 *
	 * @var CustomerEvent
	 */
	private $event;

	/**
	 * @var array
	 */
	private $attributes;

	/**
	 * @param CustomerEvent $event
	 * @param array $attributes
	 */
	public function __construct(CustomerEvent $event, array $attributes)
	{
		$this->event = $event;
		$this->attributes = $attributes;
	}

	/**
	 * Обновляет событие.
	 */
	public function handle()
	{
		$this->event->fill($this->attributes)->save();
	}
}