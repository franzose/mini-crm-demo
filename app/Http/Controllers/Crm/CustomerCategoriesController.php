<?php

namespace CrmDemo\Http\Controllers\Crm;

use CrmDemo\Domain\Repositories\CustomerCategoryRepository;
use CrmDemo\Http\Controllers\Controller;
use CrmDemo\Http\Requests\Crm\CustomerCategory\CreateCustomerCategoryRequest;
use CrmDemo\Http\Requests\Crm\CustomerCategory\UpdateCustomerCategoryRequest;
use CrmDemo\Http\Requests\Crm\DestroyEntityRequest;
use CrmDemo\Jobs\Crm\CustomerCategory\CreateCustomerCategory;
use CrmDemo\Jobs\Crm\CustomerCategory\DestroyCustomerCategory;
use CrmDemo\Jobs\Crm\CustomerCategory\UpdateCustomerCategory;

/**
 * Контроллер категорий заказчиков.
 *
 * @package CrmDemo\Http\Controllers
 */
class CustomerCategoriesController extends Controller {

	/**
	 * Репозиторий категорий.
	 *
	 * @var CustomerCategoryRepository
	 */
	private $categories;

	/**
	 * @param CustomerCategoryRepository $categories
	 */
	public function __construct(CustomerCategoryRepository $categories)
	{
		$this->categories = $categories;
	}

	/**
	 * Выводит страницу со списком категорий.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$categories = $this->categories->getAll();

		return view('crm.customer-categories.index', compact('categories'));
	}

	/**
	 * Создает новую категорию.
	 *
	 * @param CreateCustomerCategoryRequest $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function store(CreateCustomerCategoryRequest $request)
	{
		$id = $this->dispatch(new CreateCustomerCategory($this->getValidAttributes($request->all())));

		return json_response([
			'success' => trans('flash.customer-category.success.create'),
			'route' => route('crm.customer-category.update', compact('id'))
		]);
	}

	/**
	 * Обновляет категорию.
	 *
	 * @param UpdateCustomerCategoryRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update(UpdateCustomerCategoryRequest $request, $id)
	{
		$category = $this->categories->findById($id);
		$attributes = $this->getValidAttributes($request->all());

		$this->dispatch(new UpdateCustomerCategory($category, $attributes));

		return json_response(['success' => trans('flash.customer-category.success.update')]);
	}

	/**
	 * Удаляет категорию.
	 *
	 * @param DestroyEntityRequest $request
	 * @param int $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function destroy(DestroyEntityRequest $request, $id)
	{
		$this->dispatch(new DestroyCustomerCategory($this->categories->findById($id)));

		return json_response(['success' => trans('flash.customer-category.success.destroy')]);
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
		return array_only($attributes, ['name']);
	}
}