<?php

namespace CrmDemo\Services\Pagination;

use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use CrmDemo\Contracts\Services\Pagination\Paginator as PaginatorContract;

/**
 * Сервис пагинации.
 *
 * @package CrmDemo\Services\Pagination
 */
class Paginator implements PaginatorContract {

	/**
	 * Шаблон для вывода пагинации.
	 *
	 * @var Presenter
	 */
	private $presenter;

	/**
	 * Конструктор пагинатора.
	 *
	 * @param Presenter|null $presenter
	 */
	public function __construct(Presenter $presenter = null)
	{
		$this->presenter = $presenter;
	}

	/**
	 * Производит пагинацию.
	 *
	 * @param Collection $collection
	 * @param int $total
	 * @param int $perpage
	 * @param string $path
	 * @return LengthAwarePaginator
	 */
	public function paginate(Collection $collection, $total, $perpage, $path = null)
	{
		return new LengthAwarePaginator(
			$collection,
			intval($total),
			intval($perpage),
			null,
			compact('path')
		);
	}
}