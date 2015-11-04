<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('page-title') • Промторгстрой CRM</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
</head>
<body class="page">
    <div class="uk-container uk-container-center uk-margin-bottom">
        <nav class="nav uk-navbar uk-margin-top uk-margin-large-bottom">
            <ul class="uk-navbar-nav uk-hidden-small">
                @include('crm.partials.layouts.master.navbar-items', ['items' => $crm_primary_menu->roots()])
            </ul>
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav uk-hidden-small">
                    <li>
                        <a href="{{ route('auth.logout.do') }}">
                            <i class="uk-icon-sign-out"></i>
                            Выйти
                        </a>
                    </li>
                </ul>
            </div>
            <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
            <div class="uk-navbar-brand uk-navbar-center uk-visible-small">CRM</div>
        </nav>
        <section class="@yield('content-class') content">
            <h1 class="content__title">
                @yield('content-title')
                <span class="content__title-addon">
                    @yield('content-title-addon')
                </span>
            </h1>
            @yield('content')
        </section>
    </div>
    <!--<footer class="footer uk-container uk-container-center">
        <p>
            © 2015 ООО Провайдер.
            CRM разработал <a href="http://janiwanow.com">Ян Иванов</a>.
            По всем вопросам пишите на <a href="mailto:iwanow.jan@gmail.com">iwanow.jan@gmail.com</a>.
        </p>
    </footer>-->
    <script src="{{ asset('/assets/js/app.js') }}"></script>
</body>
</html>