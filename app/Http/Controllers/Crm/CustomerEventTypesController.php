<?php

namespace CrmDemo\Http\Controllers\Crm;

use CrmDemo\Domain\Repositories\CustomerEventTypeRepository;
use CrmDemo\Http\Controllers\Controller;
use CrmDemo\Http\Requests\Crm\CustomerEventType\CreateCustomerEventTypeRequest;
use CrmDemo\Http\Requests\Crm\CustomerEventType\UpdateCustomerEventTypeRequest;
use CrmDemo\Http\Requests\Crm\DestroyEntityRequest;
use CrmDemo\Jobs\Crm\CustomerEventType\CreateCustomerEventType;
use CrmDemo\Jobs\Crm\CustomerEventType\DestroyCustomerEventType;
use CrmDemo\Jobs\Crm\CustomerEventType\UpdateCustomerEventType;

class CustomerEventTypesController extends Controller {

	/**
	 * Репозиторий типов событий.
	 *
	 * @var CustomerEventTypeRepository
	 */
	private $types;

	/**
	 * @param CustomerEventTypeRepository $types
	 */
	public function __construct(CustomerEventTypeRepository $types)
	{
		$this->types = $types;
	}

	/**
	 * Выводит страницу со списком типов.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$types = $this->types->getAll();

		return view('crm.customer-event-types.index', compact('types'));
	}

	/**
	 * Создает новый тип событий.
	 *
	 * @param CreateCustomerEventTypeRequest $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function store(CreateCustomerEventTypeRequest $request)
	{
		$id = $this->dispatch(new CreateCustomerEventType($this->getValidAttributes($request->all())));

		return json_response([
			'success' => trans('flash.customer-event-type.success.create'),
			'route' => route('crm.customer-event-type.update', compact('id'))
		]);
	}

	/**
	 * Обновляет тип событий.
	 *
	 * @param UpdateCustomerEventTypeRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update(UpdateCustomerEventTypeRequest $request, $id)
	{
		$type = $this->types->findById($id);

		$this->dispatch(new UpdateCustomerEventType($type, $this->getValidAttributes($request->all(), 'update')));

		return json_response(['success' => trans('flash.customer-event-type.success.update')]);
	}

	/**
	 * Удаляет тип событий.
	 *
	 * @param DestroyEntityRequest $request
	 * @param int $id
	 * @return mixed
	 */
	public function destroy(DestroyEntityRequest $request, $id)
	{
		$this->dispatch(new DestroyCustomerEventType($this->types->findById($id)));

		return json_response(['success' => trans('flash.customer-event-type.success.destroy')]);
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
		return array_only($attributes, []);
	}
}