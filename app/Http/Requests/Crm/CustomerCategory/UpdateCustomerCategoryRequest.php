<?php

namespace CrmDemo\Http\Requests\Crm\CustomerCategory;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запроса на обновление категории предприятий.
 *
 * @package CrmDemo\Http\Requests\Crm\CustomerCategory
 */
class UpdateCustomerCategoryRequest extends Request {

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
		return [
			'name' => 'required|unique:customer_categories,id,' . $this->getEntityId('customer-category')
		];
	}
}