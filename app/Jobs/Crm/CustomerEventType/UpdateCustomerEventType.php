<?php

namespace CrmDemo\Jobs\Crm\CustomerEventType;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerEventType;
use CrmDemo\Jobs\Job;

/**
 * Class UpdateCustomerEventType
 * @package CrmDemo\Jobs\Crm\CustomerEventType
 */
class UpdateCustomerEventType extends Job implements SelfHandling {

	/**
	 * @var CustomerEventType
	 */
	private $type;

	/**
	 * @var array
	 */
	private $attributes;

	/**
	 * @param CustomerEventType $type
	 * @param array $attributes
	 */
	public function __construct(CustomerEventType $type, array $attributes)
	{
		$this->type = $type;
		$this->attributes = $attributes;
	}

	/**
	 * Обновляет тип событий.
	 */
	public function handle()
	{
		$this->type->fill($this->attributes)->save();
	}
}