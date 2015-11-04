<?php

namespace CrmDemo\Http\Requests\Crm\Role;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запрос на обновление роли пользователя.
 *
 * @package CrmDemo\Http\Requests\Crm\Role
 */
class UpdateRoleRequest extends Request {

	/**
	 * Определяет, авторизован ли пользователь выполнить обновление роли.
	 *
	 * @return true
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
		return ['title' => 'required'];
	}
}