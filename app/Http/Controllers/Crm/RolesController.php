<?php

namespace CrmDemo\Http\Controllers\Crm;

use CrmDemo\Domain\Repositories\RoleRepository;
use CrmDemo\Http\Controllers\Controller;
use CrmDemo\Http\Requests\Crm\DestroyEntityRequest;
use CrmDemo\Http\Requests\Crm\Role\CreateRoleRequest;
use CrmDemo\Http\Requests\Crm\Role\UpdateRoleRequest;
use CrmDemo\Jobs\Crm\Role\CreateRole;
use CrmDemo\Jobs\Crm\Role\DestroyRole;
use CrmDemo\Jobs\Crm\Role\UpdateRole;

/**
 * Контроллер ролей пользователей системы.
 *
 * @package CrmDemo\Http\Controllers
 */
class RolesController extends Controller {

	/**
	 * Репозиторий ролей.
	 *
	 * @var RoleRepository
	 */
	private $roles;

	/**
	 * @param RoleRepository $roles
	 */
	public function __construct(RoleRepository $roles)
	{
		$this->roles = $roles;
	}

	/**
	 * Выводит страницу со списком доступных ролей.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$roles = $this->roles->getAll();

		return view('crm.roles.index', compact('roles'));
	}

	/**
	 * Создает новую роль.
	 *
	 * @param CreateRoleRequest $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function store(CreateRoleRequest $request)
	{
		$id = $this->dispatch(new CreateRole($this->getValidAttributes($request->all())));

		return json_response([
			'success' => trans('flash.role.success.create'),
			'route' => route('crm.role.update', compact('id'))
		]);
	}

	/**
	 * Обновляет роль.
	 *
	 * @param UpdateRoleRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update(UpdateRoleRequest $request, $id)
	{
		$role = $this->roles->findById($id);

		$this->dispatch(new UpdateRole($role, $this->getValidAttributes($request->all(), 'update')));

		return json_response(['success' => trans('flash.role.success.update')]);
	}

	/**
	 * Удаляет роль.
	 *
	 * @param DestroyEntityRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function destroy(DestroyEntityRequest $request, $id)
	{
		$this->dispatch(new DestroyRole($this->roles->findById($id)));

		return json_response(['success' => trans('flash.role.success.destroy')]);
	}

	/**
	 * Возвращает отфильтрованный массив атрибутов.
	 *
	 * @param array $attributes
	 * @param string $type
	 * @return array
	 */
	protected function getValidAttributes(array $attributes, $type = 'store')
	{
		if ($type == 'update'){
			return array_only($attributes, ['title']);
		}

		return array_only($attributes, ['name', 'title']);
	}
}