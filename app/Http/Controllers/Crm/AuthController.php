<?php

namespace CrmDemo\Http\Controllers\Crm;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use CrmDemo\Http\Controllers\Controller;

/**
 * Контроллер аутентификации.
 *
 * @package CrmDemo\Http\Controllers\Crm
 */
class AuthController extends Controller {

	/**
	 * Сервис авторизации.
	 *
	 * @var Guard
	 */
	private $auth;

	/**
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Выводит страницу входа в систему.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getLogin()
	{
		return view('crm.auth.login');
	}

	/**
	 * Пытается залогинить пользователя.
	 *
	 * @param Request $request
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function postLogin(Request $request)
	{
		$credentials = $this->getValidAttributes($request->all());

		if ($this->auth->attempt($credentials, $request->get('remember'))) {
			return redirect()->route('crm.customer-event.index');
		}

		return back()->withErrors(['login' => trans('auth.failed')]);
	}

	/**
	 * Разлогинивает пользователя.
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function logout()
	{
		$this->auth->logout();

		return redirect('/');
	}

	/**
	 * @param array $attributes
	 * @param string $type
	 * @return array
	 */
	protected function getValidAttributes(array $attributes, $type = 'store')
	{
		return array_only($attributes, ['login', 'password']);
	}
}