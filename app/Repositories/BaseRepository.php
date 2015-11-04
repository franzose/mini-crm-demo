<?php

namespace CrmDemo\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use CrmDemo\Domain\Repositories\BaseRepository as BaseRepositoryContract;

/**
 * Базовый репозиторий.
 *
 * @package CrmDemo\Repositories
 */
abstract class BaseRepository implements BaseRepositoryContract {

	/**
	 * Модель.
	 *
	 * @var Model
	 */
	protected $model;

	/**
	 * Таблица в БД.
	 *
	 * @var string
	 */
	protected $table;

	/**
	 * Поля, которые необходимо выбрать.
	 *
	 * @var array
	 */
	protected $columns = ['*'];

	/**
	 * Поля, по которым необходимо произвести сортировку.
	 *
	 * @var array
	 */
	protected $orderBy = [];

	/**
	 * Текущая страница.
	 *
	 * @var int
	 */
	protected $page;

	/**
	 * Количество элементов для выборки.
	 *
	 * @var int
	 */
	protected $limit;

	/**
	 * Конструктор репозитория.
	 *
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
		$this->table = $model->getTable();
	}

	/**
	 * Устанавливает поля, которые необходимо выбрать.
	 *
	 * @param array $columns
	 * @return BaseRepositoryContract
	 */
	public function setColumns(array $columns)
	{
		$this->columns = $columns;

		return $this;
	}

	/**
	 * Устанавливает поля для сортировки.
	 *
	 * @param array $order
	 * @return BaseRepositoryContract
	 */
	public function setOrderBy(array $order)
	{
		$this->orderBy = $order;

		return $this;
	}

	/**
	 * Устанавливает лимит на выборку.
	 *
	 * @param int $limit
	 * @param int $page
	 * @return BaseRepositoryContract
	 */
	public function paginate($limit, $page = 0)
	{
		$this->limit = intval($limit);
		$this->setPage($page);

		return $this;
	}

	/**
	 * Устанавливает номер страницы.
	 *
	 * @param int $page
	 */
	private function setPage($page)
	{
		$this->page = intval($page) - 1;

		if ($this->page < 0) {
			$this->page = 0;
		}
	}

	/**
	 * Возвращает полную коллекцию записей.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAll()
	{
		return $this->getQuery()->get();
	}

	/**
	 * Совершает поиск по идентификатору.
	 *
	 * @param int $id
	 * @return Model
	 */
	public function findById($id)
	{
		return $this->model->find($id, $this->columns);
	}

	/**
	 * Совершает поиск по указанным атрибутам.
	 *
	 * @param array $attributes
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getByAttributes(array $attributes)
	{
		return $this->getAttributesQuery($attributes)->get();
	}

	/**
	 * Подсчитывает количество сущностей.
	 *
	 * @return int
	 */
	public function count()
	{
		return $this->getQuery()->count();
	}

	/**
	 * Подсчитывает количество сущностей в соответствии с указанными атрибутами.
	 *
	 * @param array $attributes
	 * @return int
	 */
	public function countByAttributes(array $attributes)
	{
		return $this->getAttributesQuery($attributes)->count();
	}

	/**
	 * Создает объект Query Builder.
	 *
	 * @param Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	protected function getQuery(Builder $query = null)
	{
		$query = ($query ? $query : $this->model->newQuery());
		$query->select($this->columns);

		if (is_int($this->page) && is_int($this->limit)) {
			$query
				->skip($this->page * $this->limit)
				->take($this->limit);
		}

		foreach($this->orderBy as $order) {
			$query->orderBy($order[0], $order[1]);
		}

		return $query;
	}

	/**
	 * Возвращает запрос по атрибутам.
	 *
	 * @param array $attributes
	 * @param Builder|null $query
	 * @return Builder
	 */
	protected function getAttributesQuery(array $attributes, Builder $query = null)
	{
		$query = $this->getQuery($query);

		foreach($attributes as $attr) {
			$column = $attr[0];
			$operator = $attr[1];
			$value = (isset($attr[2]) ? $attr[2] : null);
			$boolean = (isset($attr[3]) ? $attr[3] : 'and');

			$query->where($column, $operator, $value, $boolean);
		}

		return $query;
	}
}