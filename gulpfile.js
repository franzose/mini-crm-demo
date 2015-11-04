var elixir = require('laravel-elixir');

require('./resources/elixir-tasks/uglify');
require('./resources/elixir-tasks/minifycss');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var nodePath = '../../node_modules',
    assetsPath = 'resources/assets',
    publicPath = '../docs/assets',
    folders = {
        validation: nodePath + '/jquery-validation/dist',
        uikit: {
            js: nodePath + '/uikit/src/js'
        },
        raw: {
            css: assetsPath + '/css',
            less: assetsPath + '/less',
            img: assetsPath + '/img',
            sprite: assetsPath + '/sprite',
            js: assetsPath + '/js',
            fonts: assetsPath + '/fonts',
            uikit: nodePath + '/uikit/src'
        },
        web: {
            css: publicPath + '/css',
            img: publicPath + '/img',
            js: publicPath + '/js',
            fonts: publicPath + '/fonts'
        }
    },
    paths = {
        jquery: nodePath + '/jquery/dist/jquery.min.js',
        validation: folders.validation + '/jquery.validate.js',
        validationRU: folders.validation + '/localization/messages_ru.min.js'
    },
    files = {
        css: folders.web.css + '/app.css',
        js: folders.web.js + '/app.js'
    };

elixir(function(mix) {
    var scripts = [
        paths.jquery,
        paths.validation,
        paths.validationRU,
        folders.uikit.js + '/core/core.js',
        folders.uikit.js + '/core/dropdown.js',
        folders.uikit.js + '/core/alert.js',
        folders.uikit.js + '/core/switcher.js',
        folders.uikit.js + '/core/tab.js',
        folders.uikit.js + '/core/modal.js',
        folders.uikit.js + '/components/notify.js',
        folders.uikit.js + '/components/form-select.js',
        folders.uikit.js + '/components/datepicker.js',
        folders.uikit.js + '/components/autocomplete.js',
        folders.uikit.js + '/components/timepicker.js',
        'js/*.js'
    ];

    mix.less('app.less', folders.web.css)
        .minifycss(files.css, folders.web.css)
        .scripts(scripts, files.js, assetsPath)
        .uglify(files.js, folders.web.js);
});
