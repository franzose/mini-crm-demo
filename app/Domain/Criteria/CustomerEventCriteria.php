<?php

namespace CrmDemo\Domain\Criteria;

/**
 * Класс критериев выборки событий.
 *
 * @package CrmDemo\Domain\Criteria
 */
class CustomerEventCriteria {

	/**
	 * Начальная дата выборки.
	 *
	 * @var string
	 */
	private $start_date;

	/**
	 * Конечная дата выборки.
	 *
	 * @var string
	 */
	private $end_date;

	/**
	 * Поисковый запрос.
	 *
	 * @var string
	 */
	private $query;

	/**
	 * Типы событий.
	 *
	 * @var array
	 */
	private $types;

	/**
	 * Ответственные менеджеры.
	 *
	 * @var array
	 */
	private $managers;

	/**
	 * Заказчики.
	 *
	 * @var array
	 */
	private $customers;

	/**
	 * Категории.
	 *
	 * @var array
	 */
	private $categories;

	/**
	 * Статусы переговоров.
	 *
	 * @var array
	 */
	private $statuses;

	public function __construct() {}

	/**
	 * Возвращает начальную дату выборки.
	 *
	 * @return string
	 */
	public function getStartDate()
	{
		return $this->start_date;
	}

	/**
	 * Устанавливает начальную дату выборки.
	 *
	 * @param string $date
	 * @return $this
	 */
	public function setStartDate($date)
	{
		$this->start_date = $date;

		return $this;
	}

	/**
	 * Возвращает конечную дату выборки.
	 *
	 * @return string
	 */
	public function getEndDate()
	{
		return $this->end_date;
	}

	/**
	 * @param string $date
	 * @return $this
	 */
	public function setEndDate($date)
	{
		$this->start_date = $date;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getQuery()
	{
		return $this->query;
	}

	/**
	 * @param string $query
	 * @return $this
	 */
	public function setQuery($query)
	{
		$this->query = $query;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getTypes()
	{
		return $this->types;
	}

	/**
	 * @param array $types
	 * @return $this
	 */
	public function setTypes(array $types = [])
	{
		$this->types = $types;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getManagers()
	{
		return $this->managers;
	}

	/**
	 * @param array $managers
	 * @return $this
	 */
	public function setManagers(array $managers = [])
	{
		$this->managers = $managers;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getCustomers()
	{
		return $this->customers;
	}

	/**
	 * @param array $customers
	 * @return $this
	 */
	public function setCustomers(array $customers = [])
	{
		$this->customers = $customers;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * @param array $categories
	 * @return $this
	 */
	public function setCategories(array $categories = [])
	{
		$this->categories = $categories;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getStatuses()
	{
		return $this->statuses;
	}

	/**
	 * @param array $statuses
	 * @return $this
	 */
	public function setStatuses(array $statuses = [])
	{
		$this->statuses = $statuses;

		return $this;
	}
}