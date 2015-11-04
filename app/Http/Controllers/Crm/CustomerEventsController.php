<?php

namespace CrmDemo\Http\Controllers\Crm;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use CrmDemo\Domain\Criteria\CustomerEventCriteria;
use CrmDemo\Domain\Repositories\CustomerCategoryRepository;
use CrmDemo\Domain\Repositories\CustomerEventRepository;
use CrmDemo\Domain\Repositories\CustomerEventTypeRepository;
use CrmDemo\Domain\Repositories\CustomerRepository;
use CrmDemo\Domain\Repositories\CustomerStatusRepository;
use CrmDemo\Domain\Repositories\UserRepository;
use CrmDemo\Http\Controllers\Controller;
use CrmDemo\Http\Requests\Crm\CustomerEvent\CreateUpdateCustomerEventRequest;
use CrmDemo\Http\Requests\Crm\DestroyEntityRequest;
use CrmDemo\Jobs\Crm\CreateCustomerEvent;
use CrmDemo\Jobs\Crm\DestroyCustomerEvent;
use CrmDemo\Jobs\Crm\UpdateCustomerEvent;

/**
 * Контроллер событий, связанных с заказчиками.
 *
 * @package CrmDemo\Http\Controllers
 */
class CustomerEventsController extends Controller {

	/**
	 * Репозиторий категорий.
	 *
	 * @var CustomerCategoryRepository
	 */
	private $categories;

	/**
	 * Репозиторий событий.
	 *
	 * @var CustomerEventRepository
	 */
	private $events;

	/**
	 * Репозиторий типов событий.
	 *
	 * @var CustomerEventTypeRepository
	 */
	private $types;

	/**
	 * Репозиторий статусов.
	 *
	 * @var CustomerStatusRepository
	 */
	private $statuses;

	/**
	 * Репозиторий заказчиков.
	 *
	 * @var CustomerRepository
	 */
	private $customers;

	/**
	 * Репозиторий конфигурации.
	 *
	 * @var Repository
	 */
	private $config;

	/**
	 * @param CustomerCategoryRepository $categories
	 * @param CustomerEventRepository $events
	 * @param CustomerEventTypeRepository $types
	 * @param CustomerStatusRepository $statuses
	 * @param CustomerRepository $customers
	 * @param UserRepository $users
	 * @param Repository $config
	 */
	public function __construct(
		CustomerCategoryRepository $categories,
		CustomerEventRepository $events,
		CustomerEventTypeRepository $types,
		CustomerStatusRepository $statuses,
		CustomerRepository $customers,
		UserRepository $users,
		Repository $config
	)
	{
		$this->categories = $categories;
		$this->events = $events;
		$this->types = $types;
		$this->statuses = $statuses;
		$this->customers = $customers;
		$this->users = $users;
		$this->config = $config;
	}

	/**
	 * Выводит страницу со списком событий.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		list($events, $pagination) = $this->paginate($this->events);

		$data = [
			'events'     => $events,
			'pagination' => $pagination,
			'categories' => $this->categories->getAll(),
			'customers'  => $this->customers->getAll(),
			'managers'   => $this->users->getManagers(),
			'statuses'   => $this->statuses->getAll(),
			'types'      => $this->types->getAll(),
			'tabs'       => $this->config->get('crm.customer-event.tabs')
		];

		return view('crm.customer-events.index', $data);
	}

	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function filter(Request $request)
	{
		$this->events->setCriteria($this->getFilterCriteria($request));

		list($events, $pagination) = $this->paginate($this->events);

		$events = $this->getFilterResult($events);

		return json_response(compact('events', 'pagination'));
	}

	/**
	 * @param Collection $events
	 * @return string
	 */
	private function getFilterResult(Collection $events)
	{
		$result = '';

		if ($events->count()) {
			$view = view('crm.partials.customer-events.event-row');

			foreach($events as $event) {
				$result .= $view->with('event', $event)->render();
			}
		}
		else {
			$result = view('crm.partials.customer-events.empty-row')->render();
		}

		return $result;
	}

	/**
	 * Возвращает критерии выборки событий.
	 *
	 * @param Request $request
	 * @return CustomerEventCriteria
	 */
	private function getFilterCriteria(Request $request)
	{
		return (new CustomerEventCriteria)
			->setStartDate($request->get('start_date'))
			->setEndDate($request->get('end_date'))
			->setQuery($request->get('query'))
			->setTypes((array)$request->get('types', []))
			->setManagers((array)$request->get('managers', []))
			->setCustomers((array)$request->get('customers', []))
			->setCategories((array)$request->get('categories', []))
			->setStatuses((array)$request->get('statuses', []));
	}

	/**
	 * Выводит страницу создания нового события.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$data = array_merge(['event' => null], $this->getEventRelations());

		return view('crm.customer-events.create', $data);
	}

	/**
	 * Создает новое событие.
	 *
	 * @param CreateUpdateCustomerEventRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CreateUpdateCustomerEventRequest $request)
	{
		$id = $this->dispatch(new CreateCustomerEvent($this->getValidAttributes($request->all())));

		return redirect()
			->route('crm.customer-event.index')
			->withSuccess(trans('flash.customer-event.success.create'))
			->withNewUserId($id);
	}

	/**
	 * Выводит страницу редактирования события.
	 *
	 * @param int $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id)
	{
		$event = $this->events->findById($id);
		$data = array_merge(compact('event'), $this->getEventRelations());

		return view('crm.customer-events.edit', $data);
	}

	/**
	 * Обновляет событие.
	 *
	 * @param CreateUpdateCustomerEventRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(CreateUpdateCustomerEventRequest $request, $id)
	{
		$event = $this->events->findById($id);
		$attributes = $this->getValidAttributes($request->all(), 'update');

		$this->dispatch(new UpdateCustomerEvent($event, $attributes));

		return redirect()
			->back()
			->withSuccess(trans('flash.customer-event.success.update'));
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
		$this->dispatch(new DestroyCustomerEvent($this->events->findById($id)));

		return redirect()
			->route('crm.customer-event.index')
			->withSuccess(trans('flash.customer-event.success.destroy'));
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
		$user = $this->getUser();

		if ( ! $user->can('edit-users')) {
			$attributes['manager_id'] = $user->getKey();
		}

		return array_only($attributes, [
			'type_id',
			'manager_id',
			'customer_id',
			'event_date',
			'event_time',
			'description'
		]);
	}

	/**
	 * @return array
	 */
	private function getEventRelations()
	{
		$managers = [];

		if ($this->getUser()->can('edit-users')) {
			$managers = $this->users->getManagers()->lists('name', 'id')->toArray();
		}

		return [
			'types' => $this->types->getAll()->lists('name', 'id')->toArray(),
			'customers' => $this->customers->getAll()->lists('name', 'id')->toArray(),
			'managers' => $managers
		];
	}
}