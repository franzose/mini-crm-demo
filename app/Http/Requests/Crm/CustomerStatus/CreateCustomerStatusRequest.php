<?php

namespace CrmDemo\Http\Requests\Crm\CustomerStatus;

use CrmDemo\Http\Requests\Request;

/**
 * Class CreateUpdateCustomerStatus
 * @package CrmDemo\Http\Requests\Crm\CustomerStatus
 */
class CreateCustomerStatusRequest extends Request {

	/**
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Возвращает правила валидации.
	 *
	 * @return array
	 */
	public function rules()
	{
		return ['name' => 'required|unique:customer_statuses'];
	}
}