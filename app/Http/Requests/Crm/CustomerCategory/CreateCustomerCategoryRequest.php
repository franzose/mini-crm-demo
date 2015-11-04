<?php

namespace CrmDemo\Http\Requests\Crm\CustomerCategory;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запроса на создание категории предприятий.
 *
 * @package CrmDemo\Http\Requests\Crm\CustomerCategory
 */
class CreateCustomerCategoryRequest extends Request {

	/**
	 * @return bool
	 */
	public function authorize()
	{
		return $this->user()->can('edit-entities');
	}

	/**
	 * Возвращает правила валидации.
	 *
	 * @return array
	 */
	public function rules()
	{
		return ['name' => 'required|unique:customer_categories'];
	}
}