<?php

namespace CrmDemo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
	/**
	 * Возвращает идентификатор сущности из запроса.
	 *
	 * @param string $entity
	 * @return int
	 */
    protected function getEntityId($entity)
    {
	    return $this->route()->parameters()[$entity];
    }
}
