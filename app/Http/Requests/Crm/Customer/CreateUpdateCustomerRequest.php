<?php

namespace CrmDemo\Http\Requests\Crm\Customer;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запроса на создание/обновление нового заказчика.
 *
 * @package CrmDemo\Http\Requests\Crm\Customer
 */
class CreateUpdateCustomerRequest extends Request {

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
			'category_id' => 'required|integer',
			'manager_id' => 'required|integer',
			'name' => 'required',
			'legal_name' => 'required'
		];
	}
}