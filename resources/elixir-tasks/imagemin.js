var elixir = require('laravel-elixir'),
    gulp = require('gulp'),
    changed = require('gulp-changed'),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant'),
    notify = require('gulp-notify'),
    _ = require('underscore'),
    utilities = require('laravel-elixir/ingredients/commands/Utilities');

/**
 * Задача для Elixir: минификация изображений
 */
elixir.extend('imagemin', function(src, output, options) {

    var config = this,
        baseDir = config.assetsDir + 'img',
        defaultOutputDir = 'public/img';

    options = _.extend({
        progressive: true,
        svgoPlugins: [{removeViewBox: false}],
        use: [pngquant()]
    }, options);

    gulp.task('imagemin', function() {
        return gulp.src(src)
            .pipe(changed(output || defaultOutputDir))
            .pipe(imagemin(options))
            .pipe(gulp.dest(output || defaultOutputDir))
            .on('error', notify.onError({
                title: 'ImageMin Failed!',
                message: 'Failed to optimise images.',
                icon: __dirname + '/../laravel-elixir/icons/fail.png'
            }));
    });

    this.registerWatcher('imagemin', [
        baseDir + '/**/*.png',
        baseDir + '/**/*.gif',
        baseDir + '/**/*.svg',
        baseDir + '/**/*.jpg',
        baseDir + '/**/*.jpeg'
    ]);

    return this.queueTask('imagemin');

});