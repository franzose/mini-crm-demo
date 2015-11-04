<?php

namespace CrmDemo\Http\Controllers;

use App;
use Auth;
use Config;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use CrmDemo\Contracts\Services\Pagination\Paginator;
use CrmDemo\Domain\Repositories\BaseRepository;
use CrmDemo\Services\Pagination\UiKitPresenter;
use Request;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string
     */
    protected $resource;

    /**
     * Возвращает модель залогиненного пользователя.
     *
     * @return \CrmDemo\Domain\Models\User
     */
    protected function getUser()
    {
        return Auth::user();
    }

    /**
     * Возвращает идентификатор залогиненного пользователя.
     *
     * @return int
     */
    protected function getUserId()
    {
        return $this->getUser()->getKey();
    }

    /**
     * @param Collection $collection
     * @param int $total
     * @param int $limit
     * @return string
     */
    protected function getPagination(Collection $collection, $total, $limit)
    {
        /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */
        $paginator = App::make(Paginator::class)->paginate($collection, $total, $limit, $this->getResourceName());

		return $paginator->render(new UiKitPresenter($paginator));
    }

    /**
     * Возвращает количество пользователей на страницу.
     *
     * @param string $resource
     * @return int
     */
    protected function getItemsPerPage($resource)
    {
        $default = Config::get('crm.global.items-per-page');

        return Config::get("crm.{$resource}.limit", $default);
    }

    /**
     * Возвращает текущую страницу.
     *
     * @return int
     */
    protected function getCurrentPage()
    {
        return $this->getRequest()->get('page');
    }

    /**
     * Возвращает текущий адрес.
     *
     * @return string
     */
    protected function getCurrentUri()
    {
        return $this->getRouter()->getCurrentRoute()->getUri();
    }

    /**
     * Производит пагинацию.
     *
     * @param BaseRepository $repository
     * @param int $limit
     * @param int $count
     * @return array
     */
    protected function paginate(BaseRepository $repository, $limit = null, $count = null)
    {
        $limit = ($limit ?: $this->getItemsPerPage($this->getResourceName()));
        $items = $repository->paginate($limit, $this->getCurrentPage())->getAll();
        $pagination = $this->getPagination($items, ($count ?: $repository->count()), $limit);

        return [$items, $pagination];
    }

    /**
     * Возвращает название ресурса.
     *
     * @return string
     */
    private function getResourceName()
    {
        return ($this->resource ?: get_current_resource());
    }

    /**
     * Возвращает текущий запрос.
     *
     * @return \Illuminate\Http\Request
     */
    protected function getRequest()
    {
        return $this->getRouter()->getCurrentRequest();
    }

    /**
     * Возвращает отфильтрованный массив атрибутов.
     *
     * @param array $attributes
     * @param string $type
     * @return array
     */
    abstract protected function getValidAttributes(array $attributes, $type = 'store');
}
