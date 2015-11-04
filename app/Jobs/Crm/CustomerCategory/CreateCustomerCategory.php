<?php

namespace CrmDemo\Jobs\Crm\CustomerCategory;

use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerCategory;
use CrmDemo\Jobs\Job;

/**
 * Class CreateCustomerCategory
 * @package CrmDemo\Jobs\Crm\CustomerCategory
 */
class CreateCustomerCategory extends Job implements SelfHandling {

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
	 * Создает новую категорию.
	 *
	 * @param CustomerCategory $category
	 * @return int
	 */
	public function handle(CustomerCategory $category)
	{
		return $category->create($this->attributes)->getKey();
	}
}