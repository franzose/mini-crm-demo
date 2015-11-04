var elixir = require('laravel-elixir'),
    task = elixir.Task,
    gulp = require('gulp');

/**
 * Задача для Elixir: копирование файлов.
 */
elixir.extend('copyfiles', function(src, output) {
    new task('copyfiles', function() {
        return gulp.src(src).pipe(gulp.dest(output));
    }).watch('imagemin', src);
});