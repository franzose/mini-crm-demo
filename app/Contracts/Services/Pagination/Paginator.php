<?php

namespace CrmDemo\Contracts\Services\Pagination;

use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Support\Collection;

/**
 * Интерфейс сервиса пагинации.
 *
 * @package CrmDemo\Contracts\Services\Pagination
 */
interface Paginator {

	/**
	 * Производит пагинацию.
	 *
	 * @param Collection $collection
	 * @param int $total
	 * @param int $perpage
	 * @param string $path
	 * @return \Illuminate\Pagination\LengthAwarePaginator
	 */
	public function paginate(Collection $collection, $total, $perpage, $path = null);
}