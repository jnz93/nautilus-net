var gulp = require('gulp');
var sass = require('gulp-sass');

var pathSass = 'css/sass/parts/*.sass';
gulp.task('sass', function(){
    return gulp
        .src(pathSass)
        .pipe(sass())
        .pipe(gulp.dest('css/parts'))
});

gulp.task('watchCompile', function(){
    gulp.watch(pathSass, gulp.series('sass'));
});