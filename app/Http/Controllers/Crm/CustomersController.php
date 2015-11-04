<?php

namespace CrmDemo\Http\Controllers\Crm;

use Illuminate\Http\Request;
use CrmDemo\Domain\Repositories\CustomerCategoryRepository;
use CrmDemo\Domain\Repositories\CustomerRepository;
use CrmDemo\Domain\Repositories\CustomerStatusRepository;
use CrmDemo\Domain\Repositories\UserRepository;
use CrmDemo\Http\Controllers\Controller;
use CrmDemo\Http\Requests\Crm\Customer\CreateUpdateCustomerRequest;
use CrmDemo\Http\Requests\Crm\DestroyEntityRequest;
use CrmDemo\Jobs\Crm\Customer\CreateCustomer;
use CrmDemo\Jobs\Crm\Customer\DestroyCustomer;
use CrmDemo\Jobs\Crm\Customer\UpdateCustomer;

/**
 * Контроллер заказчиков.
 *
 * @package CrmDemo\Http\Controllers
 */
class CustomersController extends Controller {

	/**
	 * Репозиторий заказчиков.
	 *
	 * @var CustomerRepository
	 */
	private $customers;

	/**
	 * Репозиторий категорий.
	 *
	 * @var CustomerCategoryRepository
	 */
	private $categories;

	/**
	 * Репозиторий статусов.
	 *
	 * @var CustomerStatusRepository
	 */
	private $statuses;

	/**
	 * Репозиторий пользователей системы.
	 *
	 * @var UserRepository
	 */
	private $users;

	/**
	 * @param CustomerRepository $customers
	 * @param CustomerCategoryRepository $categories
	 * @param CustomerStatusRepository $statuses
	 * @param UserRepository $users
	 */
	public function __construct(
		CustomerRepository $customers,
		CustomerCategoryRepository $categories,
		CustomerStatusRepository $statuses,
		UserRepository $users
	)
	{
		$this->customers = $customers;
		$this->categories = $categories;
		$this->statuses = $statuses;
		$this->users = $users;
	}

	/**
	 * Выводит страницу со списком заказчиков.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		list($customers, $pagination) = $this->paginate($this->customers);

		return view('crm.customers.index', compact('customers', 'pagination'));
	}

	/**
	 * Выводит страницу создания нового заказчика.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$data = array_merge(['customer' => null], $this->getCustomerRelations());

		return view('crm.customers.create', $data);
	}

	/**
	 * Создает нового заказчика.
	 *
	 * @param CreateUpdateCustomerRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CreateUpdateCustomerRequest $request)
	{
		$id = $this->dispatch(new CreateCustomer($this->getValidAttributes($request->all())));

		return redirect()
			->route('crm.customer.index')
			->withSuccess(trans('flash.customer.success.create'))
			->withNewCustomerId($id);
	}

	/**
	 * Выводит страницу редактирования заказчика.
	 *
	 * @param int $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id)
	{
		$customer = $this->customers->findById($id);
		$data = array_merge(compact('customer'), $this->getCustomerRelations());

		return view('crm.customers.edit', $data);
	}

	/**
	 * Обновляет информацию о заказчике.
	 *
	 * @param CreateUpdateCustomerRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(CreateUpdateCustomerRequest $request, $id)
	{
		$customer = $this->customers->findById($id);
		$attributes = $this->getValidAttributes($request->all(), 'update');

		$this->dispatch(new UpdateCustomer($customer, $attributes));

		return redirect()
			->back()
			->withSuccess(trans('flash.customer.success.update'));
	}

	/**
	 * Удаляет заказчика из системы.
	 *
	 * @param DestroyEntityRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function destroy(DestroyEntityRequest $request, $id)
	{
		$this->dispatch(new DestroyCustomer($this->customers->findById($id)));

		return redirect()
			->route('crm.customer.index')
			->withSuccess(trans('flash.customer.success.destroy'));
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
		return array_only($attributes, [
			'category_id',
			'status_id',
			'manager_id',
			'name',
			'legal_name',
			'address',
			'contact_person',
			'person_position',
			'phone'
		]);
	}

	/**
	 * Возвращает дополнительные данные к заказчику.
	 *
	 * @return array
	 */
	private function getCustomerRelations()
	{
		return [
			'categories' => $this->categories->getAll()->lists('name', 'id')->toArray(),
			'managers' => $this->users->getManagers()->lists('name', 'id')->toArray(),
			'statuses' => $this->statuses->getAll()->lists('name', 'id')->toArray()
		];
	}
}