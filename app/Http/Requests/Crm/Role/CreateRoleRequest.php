<?php

namespace CrmDemo\Http\Requests\Crm\Role;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запроса на создание роли.
 *
 * @package CrmDemo\Http\Requests\Crm\Role
 */
class CreateRoleRequest extends Request {

	/**
	 * @return bool
	 */
	public function authorize()
	{
		return $this->user()->can('edit-users');
	}

	/**
	 * Возвращает правила валидации.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|alpha',
			'title' => 'required'
		];
	}
}