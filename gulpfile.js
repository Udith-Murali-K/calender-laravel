var gulp = require('gulp');
var shell = require('gulp-shell');
var symlink = require('gulp-sym');
var merge = require('merge-stream');


gulp.task('publish-nodemodules', function(){
 var symlinkOperation = gulp.src(['node_modules'])
     .pipe(symlink('public/node_modules', {force:true}));

 return merge(symlinkOperation);

});
