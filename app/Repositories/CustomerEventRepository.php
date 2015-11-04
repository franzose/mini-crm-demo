<?php

namespace CrmDemo\Repositories;

use Illuminate\Database\Eloquent\Builder;
use CrmDemo\Domain\Criteria\CustomerEventCriteria;
use CrmDemo\Domain\Models\CustomerEvent;
use CrmDemo\Domain\Repositories\CustomerEventRepository as CustomerEventRepositoryContract;

/**
 * Репозиторий событий, связанных с заказчиками.
 *
 * @package CrmDemo\Repositories
 */
class CustomerEventRepository extends BaseRepository implements CustomerEventRepositoryContract {

	/**
	 * @var CustomerEvent
	 */
	protected $model;

	/**
	 * Поля, по которым необходимо произвести сортировку.
	 *
	 * @var array
	 */
	protected $orderBy = [
		['event_date', 'desc'],
		['event_time', 'desc']
	];

	/**
	 * Критерии выборки событий.
	 *
	 * @var CustomerEventCriteria
	 */
	private $criteria;

	/**
	 * @var array
	 */
	private $filters = [
		'date',
		'search',
		'types',
		'managers',
		'customers',
		'categories',
		'statuses'
	];

	/**
	 * @param CustomerEvent $model
	 */
	public function __construct(CustomerEvent $model)
	{
		parent::__construct($model);

		$this->columns = [$this->table . '.*'];
	}

	/**
	 * @param CustomerEventCriteria $criteria
	 * @return $this
	 */
	public function setCriteria(CustomerEventCriteria $criteria)
	{
		$this->criteria = $criteria;

		return $this;
	}

	/**
	 * Создает объект Query Builder.
	 *
	 * @param Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	protected function getQuery(Builder $query = null)
	{
		$query = parent::getQuery($query);

		if ( ! is_null($this->criteria)) {
			$query = $this->applyFilters($query, $this->filters);
		}

		return $query;
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	private function applyDateFilter(Builder $query)
	{
		$start_date = $this->criteria->getStartDate();
		$end_date = $this->criteria->getEndDate();
		$column = $this->table . '.event_date';

		if ($start_date && $end_date) {
			$query->whereBetween($column, [$start_date, $end_date]);
		}
		else if ($start_date) {
			$query->where($column, '>=', $start_date);
		}
		else if ($end_date) {
			$query->where($column, '<=', $end_date);
		}

		return $query;
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	private function applySearchFilter(Builder $query)
	{
		if ($search = $this->criteria->getQuery()) {
			$query->where($this->table . '.description', 'LIKE', "%{$search}%");
		}

		return $query;
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	private function applyTypesFilter(Builder $query)
	{
		$column = $this->table . '.type_id';

		$query->leftJoin('customer_eventtypes', $column, '=', 'customer_eventtypes.id')
		      ->whereIn($column, $this->criteria->getTypes());

		return $query;
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	private function applyManagersFilter(Builder $query)
	{
		$column = $this->table . '.manager_id';

		$query->leftJoin('users', $column, '=', 'users.id')
			->whereIn($column, $this->criteria->getManagers());

		return $query;
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	private function applyCustomersFilter(Builder $query)
	{
		$column = $this->table . '.customer_id';

		$query->leftJoin('customers', $column, '=', 'customers.id')
		      ->whereIn($column, $this->criteria->getCustomers());

		return $query;
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	private function applyCategoriesFilter(Builder $query)
	{
		if ( ! $this->customersJoined($query)) {
			$query->leftJoin('customers', $this->table . '.customer_id', '=', 'customers.id');
		}

		$query->leftJoin('customer_categories', 'customers.category_id', '=', 'customer_categories.id')
		      ->whereIn('customers.category_id', $this->criteria->getCategories());

		return $query;
	}

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	private function applyStatusesFilter(Builder $query)
	{
		if ( ! $this->customersJoined($query)) {
			$query->leftJoin('customers', $this->table . '.customer_id', '=', 'customers.id');
		}

		$query->leftJoin('customer_statuses', 'customers.status_id', '=', 'customer_statuses.id')
			->whereIn('customers.status_id', $this->criteria->getStatuses());

		return $query;
	}

	/**
	 * @param Builder $query
	 * @param array $filters
	 * @return Builder
	 */
	private function applyFilters(Builder $query, array $filters)
	{
		foreach($filters as $filter) {
			$method = 'apply' . ucfirst($filter) . 'Filter';
			$query = $this->{$method}($query);
		}

		return $query;
	}

	/**
	 * @param Builder $query
	 * @return bool
	 */
	private function customersJoined(Builder $query)
	{
		$tables = $this->getJoinedTables($query);

		return array_has(array_combine($tables, $tables), 'customers');
	}

	/**
	 * @param Builder $query
	 * @return array
	 */
	private function getJoinedTables(Builder $query)
	{
		$joins = $query->getQuery()->joins;

		if ( ! is_array($joins)) {
			return [];
		}

		return array_map(function($clause) {
			return $clause->table;
		}, $joins);
	}
}