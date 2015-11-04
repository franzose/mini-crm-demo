<?php

namespace CrmDemo\Http\Requests\Crm\User;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запроса на создание нового пользователя.
 *
 * @package CrmDemo\Http\Requests\Crm
 */
class CreateUserRequest extends Request {

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
			'name' => 'required',
			'login' => 'required|alpha_num|unique:users,login',
			'email' => 'sometimes|email|unique:users,email',
			'password' => 'required|confirmed'
		];
	}
}