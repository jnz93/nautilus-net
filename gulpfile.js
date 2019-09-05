var gulp = require('gulp');
var sass = require('gulp-sass');

const { watch } = require('gulp');

gulp.task('compileSass', function(){
    return gulp
        .src('css/sass/parts/*.sass') // path of archives to compile
        // .pipe(cleanDir('css', {ext: '.css'})) Não está funcionando
        .pipe(sass())
        .pipe(gulp.dest('css/parts')) // path of to compile archives
});

// watch(['css/sass/parts/*.sass'], function(compileSass){
//     compileSass;
// });