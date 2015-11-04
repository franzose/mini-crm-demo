<?php

namespace CrmDemo\Http\Requests\Crm\User;

use CrmDemo\Http\Requests\Request;

class UpdateUserRequest extends Request
{

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
        $user_id = $this->getEntityId('user');

        return [
            'name' => 'required',
            'login' => 'required|alpha_num|unique:users,login,' . $user_id,
            'email' => 'sometimes|email|unique:users,email,' . $user_id,
            'password' => 'sometimes|confirmed'
        ];
    }
}
