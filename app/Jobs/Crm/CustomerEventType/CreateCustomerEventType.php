<?php

namespace CrmDemo\Jobs\Crm\CustomerEventType;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerEventType;
use CrmDemo\Jobs\Job;

/**
 * Class CreateCustomerEventType
 * @package CrmDemo\Jobs\Crm\CustomerEventType
 */
class CreateCustomerEventType extends Job implements SelfHandling {

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
	 * Создает тип события.
	 *
	 * @param CustomerEventType $type
	 * @return int
	 */
	public function handle(CustomerEventType $type)
	{
		return $type->create($this->attributes)->getKey();
	}
}