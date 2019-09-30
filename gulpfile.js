var gulp = require('gulp');
var sass = require('gulp-sass');

var pathSass = 'css/sass/parts/*.sass';
var pathSass2 = 'css/sass/*.sass';
gulp.task('sass', function(){
    return gulp
        .src(pathSass)
        .pipe(sass())
        .pipe(gulp.dest('css/parts'))
});

gulp.task('watchCompile', function(){
    gulp.watch(pathSass, gulp.series('sass'));
    // gulp.watch(pathSass2, gulp.series('sass'));
});