<?php

namespace CrmDemo\Http\Controllers\Crm;

use Illuminate\Http\Request;
use CrmDemo\Http\Controllers\Controller;
use CrmDemo\Http\Requests\Crm\User\UpdateProfileRequest;
use CrmDemo\Jobs\Crm\User\UpdateUserProfile;

/**
 * Контроллер профиля пользователя.
 *
 * @package CrmDemo\Http\Controllers\Crm
 */
class ProfileController extends Controller {

	/**
	 * Выводит страницу редактирования профиля.
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View
	 */
	public function edit(Request $request)
	{
		return view('crm.profile.edit', [
			'user' => $request->user()
		]);
	}

	/**
	 * Обновляет профиль пользователя.
	 *
	 * @param UpdateProfileRequest $request Валидатор
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update(UpdateProfileRequest $request)
	{
		$this->dispatch(new UpdateUserProfile($this->getValidAttributes($request->all())));

		return json_response(['success' => trans('flash.profile.success.update')]);
	}

	/**
	 * @param array $attributes
	 * @param string $type
	 * @return array
	 */
	protected function getValidAttributes(array $attributes, $type = 'store')
	{
		$attributes = array_only($attributes, [
			'name',
			'login',
			'email',
			'phone',
			'password'
		]);

		foreach(['email', 'password'] as $attr) {
			if (empty($attributes[$attr]) || is_null($attributes[$attr])) {
				array_forget($attributes, $attr);
			}
		}

		return $attributes;
	}

}