<?php

namespace CrmDemo\Domain\Repositories;

/**
 * Интерфейс репозитория пользователей.
 *
 * @package CrmDemo\Domain\Repositories
 */
interface UserRepository extends BaseRepository {

	/**
	 * Возвращает менеджеров.
	 *
	 * @return mixed
	 */
	public function getManagers();
}