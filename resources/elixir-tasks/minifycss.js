var elixir = require('laravel-elixir'),
    task = elixir.Task,
    gulp = require('gulp'),
    cssmin = require('gulp-cssmin'),
    _ = require('underscore');

/**
 * Задача для Elixir: сжатие стилей CSS.
 */
elixir.extend('minifycss', function(src, output, options) {
    src = src || elixir.config.cssOutput + '/*.css';
    output = output || elixir.config.cssOutput;
    options = _.extend({}, options);

    new task('minifycss', function() {
        return gulp.src(src)
            .pipe(cssmin(options))
            .pipe(gulp.dest(output));
    });
});