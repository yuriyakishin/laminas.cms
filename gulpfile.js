// Load plugins
var gulp = require('gulp'),
    clean = require('gulp-clean'),
    notify = require('gulp-notify');

// Copy modules data
gulp.task('copy-data', function () {

    gulp.src([
        'app/lib/*',
        'app/lib/**/*',
        'app/lib/***/**/*',
        'app/lib/****/***/**/*',
        'app/lib/*****/****/***/**/*',
    ], {"base": "./app/lib"})
        .pipe(gulp.dest('public/dist'));

    return gulp.src([
        'app/lib/',
        'app/code/**/*/web/',
        'app/code/***/**/web/*',
        'app/code/****/***/web/**/*',
        'app/code/*****/****/web/***/**/*',
        'app/code/******/*****/web/****/***/**/*'
    ], {"base": "./app/code"})
        .pipe(gulp.dest('public/dist/modules'));
});
