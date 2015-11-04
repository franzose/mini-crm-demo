<?php

namespace CrmDemo\Http\Controllers\Crm;

use Illuminate\Contracts\Config\Repository;
use CrmDemo\Domain\Repositories\CustomerStatusRepository;
use CrmDemo\Http\Controllers\Controller;
use CrmDemo\Http\Requests\Crm\CustomerStatus\CreateCustomerStatusRequest;
use CrmDemo\Http\Requests\Crm\CustomerStatus\UpdateCustomerStatusRequest;
use CrmDemo\Http\Requests\Crm\DestroyEntityRequest;
use CrmDemo\Jobs\Crm\CustomerStatus\CreateCustomerStatus;
use CrmDemo\Jobs\Crm\CustomerStatus\DestroyCustomerStatus;
use CrmDemo\Jobs\Crm\CustomerStatus\UpdateCustomerStatus;

class CustomerStatusesController extends Controller {

	/**
	 * Репозиторий статусов.
	 *
	 * @var CustomerStatusRepository
	 */
	private $statuses;

	/**
	 * Репозиторий конфигурации.
	 *
	 * @var Repository
	 */
	private $config;

	/**
	 * @param CustomerStatusRepository $statuses
	 * @param Repository $config
	 */
	public function __construct(CustomerStatusRepository $statuses, Repository $config)
	{
		$this->statuses = $statuses;
		$this->config = $config;
	}

	/**
	 * Выводит страницу со статусами переговоров.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$statuses = $this->statuses->getAll();
		$colors = $this->config->get('crm.customer-status.colors');

		return view('crm.customer-statuses.index', compact('statuses', 'colors'));
	}

	/**
	 * Создает новый статус переговоров.
	 *
	 * @param CreateCustomerStatusRequest $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function store(CreateCustomerStatusRequest $request)
	{
		$id = $this->dispatch(new CreateCustomerStatus($this->getValidAttributes($request->all())));

		return json_response([
			'success' => trans('flash.customer-status.success.create'),
			'route' => route('crm.customer-status.update', compact('id'))
		]);
	}

	/**
	 * Обновляет статус переговоров.
	 *
	 * @param UpdateCustomerStatusRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update(UpdateCustomerStatusRequest $request, $id)
	{
		$status = $this->statuses->findById($id);

		$this->dispatch(new UpdateCustomerStatus($status, $this->getValidAttributes($request->all(), 'update')));

		return json_response(['success' => trans('flash.customer-status.success.update')]);
	}

	/**
	 * Удаляет статус переговоров.
	 *
	 * @param DestroyEntityRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function destroy(DestroyEntityRequest $request, $id)
	{
		$this->dispatch(new DestroyCustomerStatus($this->statuses->findById($id)));

		return json_response(['success' => trans('flash.customer-status.success.destroy')]);
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
		return array_only($attributes, ['name', 'color']);
	}
}