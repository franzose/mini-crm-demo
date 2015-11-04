<?php

namespace CrmDemo\Http\Controllers\Crm;

use Illuminate\Http\Request;
use CrmDemo\Domain\Repositories\RoleRepository;
use CrmDemo\Domain\Repositories\UserRepository;
use CrmDemo\Http\Controllers\Controller;
use CrmDemo\Http\Requests\Crm\DestroyEntityRequest;
use CrmDemo\Http\Requests\Crm\User\CreateUserRequest;
use CrmDemo\Http\Requests\Crm\User\UpdateUserRequest;
use CrmDemo\Jobs\Crm\User\CreateUser;
use CrmDemo\Jobs\Crm\User\DestroyUser;
use CrmDemo\Jobs\Crm\User\UpdateUser;

/**
 * Контроллер пользователей.
 *
 * @package CrmDemo\Http\Controllers
 */
class UsersController extends Controller {

	/**
	 * Репозиторий пользователей.
	 *
	 * @var UserRepository
	 */
	private $users;

	/**
	 * Репозиторий ролей.
	 *
	 * @var RoleRepository
	 */
	private $roles;

	/**
	 * @param UserRepository $users
	 * @param RoleRepository $roles
	 */
	public function __construct(UserRepository $users, RoleRepository $roles)
	{
		$this->users = $users;
		$this->roles = $roles;
	}

	/**
	 * Выводит список сотрудников.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		list($users, $pagination) = $this->paginate($this->users);

		return view('crm.users.index', compact('users', 'pagination'));
	}

	/**
	 * Выводит страницу создания нового пользователя.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return view('crm.users.create', [
			'user' => null,
			'roles' => $this->roles->getAll()
		]);
	}

	/**
	 * Создает нового сотрудника.
	 *
	 * @param CreateUserRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CreateUserRequest $request)
	{
		$id = $this->dispatch(new CreateUser($this->getValidAttributes($request->all())));

		return redirect()
		    ->route('crm.user.index')
			->withSuccess(trans('flash.user.success.create'))
			->withNewUserId($id);
	}

	/**
	 * Выводит страницу редактирования сотрудника.
	 *
	 * @param int $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id)
	{
		$user = $this->users->findById($id);
		$roles = $this->roles->getAll();

		return view('crm.users.edit', compact('user', 'roles'));
	}

	/**
	 * Обновляет информацию о сотруднике.
	 *
	 * @param UpdateUserRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update(UpdateUserRequest $request, $id)
	{
		$user = $this->users->findById($id);
		$attrs = $this->getValidAttributes($request->all(), 'update');

		$this->dispatch(new UpdateUser($user, $attrs));

		return redirect()
			->back()
			->withSuccess(trans('flash.user.success.update'));
	}

	/**
	 * Удаляет пользователя из системы.
	 *
	 * @param DestroyEntityRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function destroy(DestroyEntityRequest $request, $id)
	{
		$this->dispatch(new DestroyUser($this->users->findById($id)));

		return redirect()
			->route('crm.user.index')
			->withSuccess(trans('flash.user.success.destroy'));
	}

	/**
	 * Возвращает атрибуты сотрудника.
	 *
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
			'password',
			'roles'
		]);

		if (empty($attributes['email'])) {
			array_forget($attributes, 'email');
		}

		if ($type == 'update' && empty($attributes['password'])) {
			array_forget($attributes, 'password');
		}

		return $attributes;
	}
}