<?php

namespace CrmDemo\Providers;

use Illuminate\Support\ServiceProvider;
use CrmDemo\Contracts\Services\Pagination\Paginator as PaginatorContract;
use CrmDemo\Domain\Models\Customer;
use CrmDemo\Domain\Models\CustomerCategory;
use CrmDemo\Domain\Models\CustomerEvent;
use CrmDemo\Domain\Models\CustomerEventType;
use CrmDemo\Domain\Models\CustomerStatus;
use CrmDemo\Domain\Models\Role;
use CrmDemo\Domain\Models\User;
use CrmDemo\Domain\Repositories\CustomerCategoryRepository as CustomerCategoryRepositoryContract;
use CrmDemo\Domain\Repositories\CustomerEventRepository as CustomerEventRepositoryContract;
use CrmDemo\Domain\Repositories\CustomerEventTypeRepository as CustomerEventTypeRepositoryContract;
use CrmDemo\Domain\Repositories\CustomerRepository as CustomerRepositoryContract;
use CrmDemo\Domain\Repositories\CustomerStatusRepository as CustomerStatusRepositoryContract;
use CrmDemo\Domain\Repositories\RoleRepository as RoleRepositoryContract;
use CrmDemo\Domain\Repositories\UserRepository as UserRepositoryContract;
use CrmDemo\Repositories\CustomerCategoryRepository;
use CrmDemo\Repositories\CustomerRepository;
use CrmDemo\Repositories\CustomerStatusRepository;
use CrmDemo\Repositories\CustomerEventRepository;
use CrmDemo\Repositories\CustomerEventTypeRepository;
use CrmDemo\Repositories\RoleRepository;
use CrmDemo\Repositories\UserRepository;
use CrmDemo\Services\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindRepositories();
        $this->bindServices();
    }

    /**
     * Привязывает реализации репозиториев.
     */
    private function bindRepositories()
    {
        $this->app->bind(CustomerCategoryRepositoryContract::class, function() {
            return new CustomerCategoryRepository(new CustomerCategory);
        });

        $this->app->bind(CustomerRepositoryContract::class, function() {
            return new CustomerRepository(new Customer);
        });

        $this->app->bind(CustomerStatusRepositoryContract::class, function() {
            return new CustomerStatusRepository(new CustomerStatus);
        });

        $this->app->bind(CustomerEventRepositoryContract::class, function() {
            return new CustomerEventRepository(new CustomerEvent);
        });

        $this->app->bind(CustomerEventTypeRepositoryContract::class, function() {
            return new CustomerEventTypeRepository(new CustomerEventType);
        });

        $this->app->bind(RoleRepositoryContract::class, function() {
            return new RoleRepository(new Role);
        });

        $this->app->bind(UserRepositoryContract::class, function() {
            return new UserRepository(new User);
        });
    }

    private function bindServices()
    {
        $this->app->bind(PaginatorContract::class, Paginator::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
