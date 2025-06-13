var gulp = require('gulp');
var watch = require('gulp-watch');
var uglify = require("gulp-uglify");
var cssmin = require("gulp-cssmin");
var concat = require("gulp-concat");
var stripCssComments = require('gulp-strip-css-comments');
var imagemin = require('gulp-imagemin')
var browserSync = require('browser-sync');
var reload = browserSync.reload;

/**
 * PAHT'S
 */
var paths = {

    css:
    [
        'project/css/bootstrap.css',
        'project/css/font-awesome.min.css',
        'project/css/icons.css',
        'project/css/select2.css',
        'project/css/style.css',
        'project/css/plugins.css',
        'project/css/vat.css',
        'project/css/hero-slider.css',
        'project/css/responsive.css'
    ],

    fonts:[
        'project/fonts/**/*'
    ],

    js:
    [
        'project/js/jquery-2.2.0.js',
        'project/js/smooth-scroll.js',
        'project/js/bootstrap.min.js',
        'project/js/select2.js',
        'project/js/common.js',
        'project/js/scripts.js',
        'project/js/map.js',
        'project/js/hero-slider.js'
    ],

    img:[
        'project/images/**/*'
    ]
};

gulp.task('min-css', function(){
    gulp.src(paths.css)
    .pipe(concat('styles.min.css'))
    .pipe(stripCssComments({all: true}))
    .pipe(cssmin())
    .pipe(gulp.dest('public/assets/css'));
});

gulp.task('transfer-fonts', function(){
    gulp.src(paths.fonts)
        .pipe(gulp.dest('public/assets/fonts'));
});

gulp.task('min-js', function() {
    gulp.src(paths.js)
    .pipe(concat('scripts.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('public/assets/js'));
});

gulp.task('min-image', function(){
    gulp.src(paths.img)
    //.pipe(imagemin())
    .pipe(gulp.dest('public/assets/images'));
});

gulp.task('css', function(){
    gulp.src(paths.css)
    .pipe(reload({stream:true}));
});

gulp.task('js', function(){
    gulp.src(paths.js)
    .pipe(reload({stream:true}));
});

gulp.task('browserSync', function() {
    browserSync({
        proxy: 'http://vat.dev/',
        port: 8085
    });
});

gulp.task('watcher',function(){
    gulp.watch(paths.css, ['css']);
    gulp.watch(paths.js, ['js']);
    gulp.watch(paths.css, ['min-css']);
});

gulp.task('dev', ['watcher', 'browserSync']);

gulp.task('minify', ['min-css', 'min-js']);

gulp.task('build', ['min-css', 'min-js', 'transfer-fonts', 'min-image']);