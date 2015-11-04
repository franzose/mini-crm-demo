<?php

namespace CrmDemo\Http\Controllers\Crm;

use Illuminate\Contracts\Auth\Access\Gate;
use CrmDemo\Domain\Repositories\CustomerCategoryRepository;
use CrmDemo\Domain\Repositories\CustomerEventRepository;
use CrmDemo\Domain\Repositories\CustomerRepository;
use CrmDemo\Domain\Repositories\CustomerStatusRepository;
use CrmDemo\Domain\Repositories\UserRepository;
use CrmDemo\Http\Controllers\Controller;

/**
 * Контроллер главной страницы CRM.
 *
 * @package CrmDemo\Http\Controllers\Crm
 */
class IndexController extends Controller {

	/**
	 * @var CustomerCategoryRepository
	 */
	private $categories;

	/**
	 * @var CustomerEventRepository
	 */
	private $events;

	/**
	 * @var CustomerStatusRepository
	 */
	private $statuses;

	/**
	 * @var CustomerRepository
	 */
	private $customers;

	/**
	 * @var UserRepository
	 */
	private $users;

	/**
	 * @param CustomerCategoryRepository $categories
	 * @param CustomerStatusRepository $statuses
	 * @param CustomerEventRepository $events
	 * @param CustomerRepository $customers
	 * @param UserRepository $users
	 * @param Gate $gate
	 */
	public function __construct(
		CustomerCategoryRepository $categories,
		CustomerStatusRepository $statuses,
		CustomerEventRepository $events,
		CustomerRepository $customers,
		UserRepository $users,
		Gate $gate
	)
	{
		$this->categories = $categories;
		$this->statuses = $statuses;
		$this->events = $events;
		$this->customers = $customers;
		$this->users = $users;
		$this->gate = $gate;
	}

	/**
	 * Выводит главную страницу CRM.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$default = ['' => ''];
		$categories = $this->categories
			->getAll()
			->lists('name', 'id')
			->toArray();

		$events = $this->events->getAll(); // TODO: LATEST!
		$statuses = $this->statuses
			->getAll()
			->lists('name', 'id')
			->toArray();

		$customers = $this->customers
			->getAll()
			->lists('name', 'id')
			->toArray();

		return view('crm.index', [
			'categories' => array_merge($default, $categories),
			'customers' => array_merge($default, $customers),
			'events' => $events,
			'statuses' => array_merge($default, $statuses),
			'managers' => array_merge($default, $this->getManagers())
		]);
	}

	/**
	 * Возвращает менеджеров.
	 *
	 * @return array
	 */
	private function getManagers()
	{
		$managers = [];

		if ($this->gate->check('filter-managers')) {
			$managers = $this->users
				->getManagers()
				->lists('name', 'id')
				->toArray();
		}

		return $managers;
	}

	/**
	 * @param array $attributes
	 * @param string $type
	 * @return array
	 */
	protected function getValidAttributes(array $attributes, $type = 'store')
	{
		return [];
	}
}