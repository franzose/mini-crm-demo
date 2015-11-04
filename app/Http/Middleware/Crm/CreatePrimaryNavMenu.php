<?php

namespace CrmDemo\Http\Middleware\Crm;

use Closure;
use Lavary\Menu\Builder;
use Menu;

class CreatePrimaryNavMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::make('crm_primary_menu', function(Builder $menu) use($request) {
            $user = $request->user();

            $events = $menu->add('События', ['route' => 'crm.customer-event.index'])->prepend('<i class="uk-icon-coffee"></i>');
            $events->add('Все события', ['route' => 'crm.customer-event.index'])->prepend('<i class="uk-icon-list"></i>');
            $events->add('Новое событие', ['route' => 'crm.customer-event.create'])
                ->prepend('<i class="uk-icon-plus"></i>')
                ->divide(['class' => 'uk-nav-divider']);

            $events->add('Типы событий', ['route' => 'crm.customer-event-type.index'])
                   ->prepend('<i class="uk-icon-tags"></i>');

            $events->add('Статусы переговоров', ['route' => 'crm.customer-status.index'])
                   ->prepend('<i class="uk-icon-hand-peace-o"></i>');

            $menu->add('Ваш профиль', ['route' => 'crm.profile.edit'])->prepend('<i class="uk-icon-user"></i>');

            if ($user->can('edit-users')) {
                /** @var \Lavary\Menu\Item $managers */
                $managers = $menu->add('Сотрудники', ['route' => 'crm.user.index'])
                    ->prepend('<i class="uk-icon-users"></i>');

                $managers->add('Все сотрудники', ['route' => 'crm.user.index'])
                    ->prepend('<i class="uk-icon-list"></i>');

                $managers->add('Новый сотрудник', ['route' => 'crm.user.create'])
                     ->prepend('<i class="uk-icon-plus"></i>')
                     ->divide(['class' => 'uk-nav-divider']);

                $managers->add('Все роли', ['route' => 'crm.role.index'])
                    ->prepend('<i class="uk-icon-list"></i>');
            }

            /** @var \Lavary\Menu\Item $customers */
            $customers = $menu->add('Заказчики', ['route' => 'crm.customer.index'])
                ->prepend('<i class="uk-icon-suitcase"></i>');

            $customers->add('Все заказчики', ['route' => 'crm.customer.index'])
                ->prepend('<i class="uk-icon-list"></i>');

            $customers->add('Новый заказчик', ['route' => 'crm.customer.create'])
                ->prepend('<i class="uk-icon-plus"></i>')
                ->divide(['class' => 'uk-nav-divider']);

            $customers->add('Категории предприятий', ['route' => 'crm.customer-category.index'])
                ->prepend('<i class="uk-icon-tags"></i>');
        });

        return $next($request);
    }
}
