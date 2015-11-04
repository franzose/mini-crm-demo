<?php

namespace CrmDemo\Http\Requests\Crm;

use CrmDemo\Http\Requests\Request;

/**
 * Валидатор на удаление сущности.
 *
 * @package CrmDemo\Http\Requests\Crm
 */
class DestroyEntityRequest extends Request {

	/**
	 * Позволяет удаление сущности пользователям с соответствующими правами.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return $this->user()->can('edit-entities');
	}

	public function rules()
	{
		return [];
	}
}