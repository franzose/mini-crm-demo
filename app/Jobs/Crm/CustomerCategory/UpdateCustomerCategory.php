<?php

namespace CrmDemo\Jobs\Crm\CustomerCategory;


use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerCategory;
use CrmDemo\Jobs\Job;

/**
 * Class UpdateCustomerCategory
 * @package CrmDemo\Jobs\Crm\CustomerCategory
 */
class UpdateCustomerCategory extends Job implements SelfHandling {

	/**
	 * Модель категории.
	 *
	 * @var CustomerCategory
	 */
	private $category;

	/**
	 * @var array
	 */
	private $attributes;

	/**
	 * @param CustomerCategory $category
	 * @param array $attributes
	 */
	public function __construct(CustomerCategory $category, array $attributes)
	{
		$this->category = $category;
		$this->attributes = $attributes;
	}

	/**
	 * Обновляет категорию.
	 */
	public function handle()
	{
		$this->category->fill($this->attributes)->save();
	}
}