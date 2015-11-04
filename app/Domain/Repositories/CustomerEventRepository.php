<?php

namespace CrmDemo\Domain\Repositories;
use CrmDemo\Domain\Criteria\CustomerEventCriteria;

/**
 * Интерфейс репозитория событий, связанных с заказчиками.
 *
 * @package CrmDemo\Domain\Repositories
 */
interface CustomerEventRepository extends BaseRepository {

	/**
	 * Устанавливает критерии выборки.
	 *
	 * @param CustomerEventCriteria $criteria
	 * @return $this
	 */
	public function setCriteria(CustomerEventCriteria $criteria);
}