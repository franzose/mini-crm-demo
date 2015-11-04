<?php

namespace CrmDemo\Jobs\Crm\Customer;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\Customer;
use CrmDemo\Jobs\Job;

/**
 * Class CreateCustomer
 * @package CrmDemo\Jobs\Crm\Customer
 */
class CreateCustomer extends Job implements SelfHandling {

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
	 * Создает нового заказчика.
	 *
	 * @param Customer $customer
	 * @return int
	 */
	public function handle(Customer $customer)
	{
		return $customer->create($this->attributes)->getKey();
	}
}