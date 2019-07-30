var gulp = require('gulp');
var sass = require('gulp-sass');
var cleanDir = require('gulp-clean-dir');
var wpPot = require('gulp-wp-pot');

gulp.task('compileSass', function(){
    return gulp
        .src('css/sass/parts/*.sass') // path of archives to compile
        // .pipe(cleanDir('css', {ext: '.css'})) Não está funcionando
        .pipe(sass())
        .pipe(gulp.dest('css/parts')) // path of to compile archives
})
 
gulp.task('wpPot', function () {
    return gulp.src('/*.php')
        .pipe(wpPot( {
            domain: 'domain',
            package: 'Example project'
        } ))
        .pipe(gulp.dest('file.pot'));
});