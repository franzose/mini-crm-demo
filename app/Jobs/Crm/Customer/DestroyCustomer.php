<?php

namespace CrmDemo\Jobs\Crm\Customer;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\Customer;
use CrmDemo\Jobs\Job;

/**
 * Class DestroyCustomer
 * @package CrmDemo\Jobs\Crm\Customer
 */
class DestroyCustomer extends Job implements SelfHandling {

	/**
	 * Модель заказчика.
	 *
	 * @var Customer
	 */
	private $customer;

	/**
	 * @param Customer $customer
	 */
	public function __construct(Customer $customer)
	{
		$this->customer = $customer;
	}

	/**
	 * Удаляет заказчика.
	 *
	 * @throws \Exception
	 */
	public function handle()
	{
		$this->customer->delete();
	}
}