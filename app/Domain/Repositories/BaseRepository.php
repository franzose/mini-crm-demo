<?php

namespace CrmDemo\Domain\Repositories;

/**
 * Интерфейс базового репозитория.
 *
 * @package CrmDemo\Domain\Repositories
 */
interface BaseRepository {

	/**
	 * Устанавливает поля, которые необходимо выбрать.
	 *
	 * @param array $columns
	 * @return $this
	 */
	public function setColumns(array $columns);

	/**
	 * Устанавливает поля для сортировки.
	 *
	 * @param array $order
	 * @return $this
	 */
	public function setOrderBy(array $order);

	/**
	 * Устанавливает лимит на выборку.
	 *
	 * @param int $limit
	 * @param int $page
	 * @return $this
	 */
	public function paginate($limit, $page = 0);

	/**
	 * Возвращает полную коллекцию записей.
	 *
	 * @return mixed
	 */
	public function getAll();

	/**
	 * Совершает поиск по идентификатору.
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function findById($id);

	/**
	 * Совершает поиск по указанным атрибутам.
	 *
	 * @param array $attributes
	 * @return mixed
	 */
	public function getByAttributes(array $attributes);

	/**
	 * Подсчитывает количество сущностей.
	 *
	 * @return int
	 */
	public function count();

	/**
	 * Подсчитывает количество сущностей в соответствии с указанными атрибутами.
	 *
	 * @param array $attributes
	 * @return int
	 */
	public function countByAttributes(array $attributes);
}