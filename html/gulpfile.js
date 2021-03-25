const { watch,series, parallel,src, dest  } = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
sass.compiler = require('node-sass');
var removeEmptyLines = require('gulp-remove-empty-lines');

function defaultTask(cb) {
  cb();
}
function jsDefaultTask(cb){
return src(['src/js/default/jquery-3.5.1.min.js','src/js/default/bootstrap.bundle.min.js',
  'src/js/default/functions.js','src/js/default/**/*.js' 
  ])
  .pipe(concat('functions.js'))
  .pipe(dest('../assets/js'));
  cb();
}
function jsTask(cb){
return src(['src/js/apps.js'])
	.pipe(dest('../assets/js'));
	cb();
}
function scssTask(cb){
  return src("src/scss/**/*.scss")
  .pipe(sass({outputStyle: 'compact'}).on('error', sass.logError))
  .pipe(removeEmptyLines())
  .pipe(dest('../assets/css'));
  cb();
}
function watchFile(cb) {
  watch(['src/scss/**/*.scss','src/theme/**/*.scss','src/base/**/*.scss'], scssTask);
  watch('src/js/default/**/*.js', jsDefaultTask);
  watch('src/js/apps.js', jsTask);
  cb();
}
exports.default = series(defaultTask,watchFile);