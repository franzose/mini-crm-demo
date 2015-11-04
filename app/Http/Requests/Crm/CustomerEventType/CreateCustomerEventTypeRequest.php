<?php

namespace CrmDemo\Http\Requests\Crm\CustomerEventType;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запроса на создание типа событий.
 *
 * @package CrmDemo\Http\Requests\Crm\CustomerEventType
 */
class CreateCustomerEventTypeRequest extends Request {

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
		return ['name' => 'required|unique:customer_eventtypes'];
	}
}