<?php

namespace CrmDemo\Http\Requests\Crm\User;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор запроса на обновление профиля пользователя.
 *
 * @package CrmDemo\Http\Requests\Crm
 */
class UpdateProfileRequest extends Request {

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
		$user_id = $this->user()->getKey();

		return [
			'name' => 'required',
			'login' => 'required|alpha_num|unique:users,login,' . $user_id,
			'email' => 'sometimes|email|unique:users,email,' . $user_id,
			'password' => 'sometimes|confirmed'
		];
	}
}