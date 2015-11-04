<?php

namespace CrmDemo\Jobs\Crm\Customer;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\Customer;
use CrmDemo\Jobs\Job;

/**
 * Class UpdateCustomer
 * @package CrmDemo\Jobs\Crm\Customer
 */
class UpdateCustomer extends Job implements SelfHandling {

	/**
	 * Модель заказчика.
	 *
	 * @var Customer
	 */
	private $customer;

	/**
	 * @var array
	 */
	private $attributes;

	/**
	 * @param Customer $customer
	 * @param array $attributes
	 */
	public function __construct(Customer $customer, array $attributes)
	{
		$this->customer = $customer;
		$this->attributes = $attributes;
	}

	/**
	 * Обновляет данные заказчика.
	 */
	public function handle()
	{
		$this->customer->fill($this->attributes)->save();
	}
}