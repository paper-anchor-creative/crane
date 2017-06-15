/*! Based on gulpfile.js from Sip by CodeableHQ | GPLv2 | github.com/codeablehq/Sip */

var gulp           = require( 'gulp' ),
    minifycss      = require( 'gulp-minify-css' ),
    watch          = require( 'gulp-watch' ),
    uglify         = require( 'gulp-uglify' ),
    sass           = require( 'gulp-sass' ),
    sourcemaps     = require( 'gulp-sourcemaps' ),
    autoprefixer   = require( 'gulp-autoprefixer' ),
    plumber        = require( 'gulp-plumber' ),
    todo           = require( 'gulp-todo' ),
    browserSync    = require( 'browser-sync' ),
    jshint         = require( 'gulp-jshint' ),
    stylish        = require( 'jshint-stylish' ),
    reload         = browserSync.reload;

// We need to set up an error handler (which gulp-plumber calls).
// Otherwise, Gulp will exit if an error occurs, which is what we don't want.
var onError = function( err ) {
  console.log( 'An error occured:', err );
  this.emit( 'end' );
}

// Our development server that serves all the assets and reloads the browser
// when any of them change (hence the watch calls in it)
gulp.task( 'server', function() {
  browserSync.init({
    // change 'playground' to whatever your local Nginx/Apache vhost is set
    // most commonly 'http://localhost/' or 'http://127.0.0.1/'
    // See http://www.browsersync.io/docs/options/ for more information
    proxy: 'http://localhost/crane/'
  });

  // Reload the browser if any .php file changes within this directory
  watch( './**/*.php', reload);

  // Recompile sass into CSS whenever we update any of the source files
  watch( './build/scss/**/*.scss', function() {
    gulp.start( 'scss' );
    gulp.start( 'todo' );
  });

  // Watch our JavaScript files and report any errors. May ruin your day.
  watch( './build/js/**/*.js', function() {
    // gulp.start( 'jshint' );
  });
});


// Processes SASS and reloads browser.
gulp.task( 'scss', function() {
  return gulp.src( './build/scss/style.scss' )
    .pipe(sourcemaps.init())
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass({
      outputStyle: 'compressed',
    }))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('./'))
    .pipe( gulp.dest( 'dist' ) )
    .pipe( reload( { stream: true } ) );
} );


// Jshint outputs any kind of javascript problems you might have
// Only checks javascript files inside /js directory
gulp.task( 'jshint', function() {
  return gulp.src( './js/**/*.js' )
    .pipe( jshint( '.jshintrc' ) )
    .pipe( jshint.reporter( stylish ) )
    .pipe( jshint.reporter( 'fail' ) );
});

gulp.task('todo', function() {
    gulp.src('./build/scss/**/*.scss')
        .pipe(todo())
        .pipe(gulp.dest('dist'));
        // -> Will output a TODO.md with your todos
});

// The default task. When developting just run 'gulp' and this is what will be ran.
// Note the second parameter, those are dependency tasks which need to be done
// before the main function (third parameter) is called.
gulp.task( 'default', [ 'scss', 'todo', 'server' ], function() {
  console.log('done');
} );
