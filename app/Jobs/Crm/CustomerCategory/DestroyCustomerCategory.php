<?php

namespace CrmDemo\Jobs\Crm\CustomerCategory;


use Illuminate\Contracts\Bus\SelfHandling;
use CrmDemo\Domain\Models\CustomerCategory;
use CrmDemo\Jobs\Job;

class DestroyCustomerCategory extends Job implements SelfHandling {

	/**
	 * Модель категории.
	 *
	 * @var CustomerCategory
	 */
	private $category;

	/**
	 * @param CustomerCategory $category
	 */
	public function __construct(CustomerCategory $category)
	{
		$this->category = $category;
	}

	/**
	 * Удаляет категорию.
	 *
	 * @throws \Exception
	 */
	public function handle()
	{
		$this->category->delete();
	}
}