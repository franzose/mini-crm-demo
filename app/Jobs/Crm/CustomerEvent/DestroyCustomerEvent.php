<?php
/**
 * Created by PhpStorm.
 * User: Yan
 * Date: 27.10.15
 * Time: 15:57
 */

namespace CrmDemo\Jobs\Crm;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerEvent;
use CrmDemo\Jobs\Job;

/**
 * Class DestroyCustomerEvent
 * @package CrmDemo\Jobs\Crm
 */
class DestroyCustomerEvent extends Job implements SelfHandling {

	/**
	 * Модель события.
	 *
	 * @var CustomerEvent
	 */
	private $event;

	/**
	 * @param CustomerEvent $event
	 */
	public function __construct(CustomerEvent $event)
	{
		$this->event = $event;
	}

	/**
	 * Удаляет событие.
	 *
	 * @throws \Exception
	 */
	public function handle()
	{
		$this->event->delete();
	}
}