<?php

namespace CrmDemo\Http\Requests\Crm\CustomerEvent;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запроса на создание/обновление нового события.
 *
 * @package CrmDemo\Http\Requests\Crm\CustomerEvent
 */
class CreateUpdateCustomerEventRequest extends Request {

	/**
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Правила валидации.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'type_id' => 'required|integer',
			'customer_id' => 'required|integer',
			'event_date' => 'required|date_format:d.m.Y',
			'event_time' => 'required|date_format:H:i',
			'description' => 'required'
		];
	}
}