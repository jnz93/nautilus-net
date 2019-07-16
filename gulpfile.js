var gulp = require('gulp');
var sass = require('gulp-sass');
var cleanDir = require('gulp-clean-dir');

gulp.task('compileSass', function(){
    return gulp
        .src('css/sass/*.sass') // path of archives to compile
        // .pipe(cleanDir('css', {ext: '.css'})) Não está funcionando
        .pipe(sass())
        .pipe(gulp.dest('css')) // path of to compile archives
})