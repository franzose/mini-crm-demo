var elixir = require('laravel-elixir'),
    task = elixir.Task,
    gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    _ = require('underscore');

/**
 * Задача для Elixir: сжатие JavaScript сценариев.
 */
elixir.extend('uglify', function(src, output, options) {
    src = src || elixir.config.jsOutput + '/*.js';
    output = output || elixir.config.jsOutput;
    options = _.extend({}, options);

    new task('uglify', function() {
        return gulp.src(src)
            .pipe(uglify(options))
            .pipe(gulp.dest(output));
    });
});