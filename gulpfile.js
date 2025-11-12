const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();

const isProduction = process.env.NODE_ENV === 'production';

const paths = {
  styles: {
    src: 'assets/css/main.scss',
    watch: ['assets/css/main.scss', 'assets/scss/**/*.scss'],
    dest: 'assets/css',
  },
  php: '**/*.php',
  js: 'assets/js/**/*.js',
};

function compileStyles() {
  const postcssPlugins = [autoprefixer()];

  if (isProduction) {
    postcssPlugins.push(cssnano());
  }

  let stream = src(paths.styles.src);

  if (!isProduction) {
    stream = stream.pipe(sourcemaps.init());
  }

  stream = stream.pipe(
    sass({
      outputStyle: isProduction ? 'compressed' : 'expanded',
    }).on('error', sass.logError)
  );

  stream = stream.pipe(postcss(postcssPlugins));

  if (!isProduction) {
    stream = stream.pipe(sourcemaps.write('.'));
  }

  stream = stream.pipe(dest(paths.styles.dest));

  return stream.pipe(browserSync.stream({ match: '**/*.css' }));
}

function serve(done) {
  browserSync.init({
    proxy: 'http://localhost/care4kids',
    notify: false,
    open: false,
  });
  done();
}

function reload(done) {
  browserSync.reload();
  done();
}

function watchFiles() {
  watch(paths.styles.watch, compileStyles);
  watch([paths.php, paths.js]).on('change', reload);
}

const build = series(compileStyles);
const dev = series(build, serve, watchFiles);

exports.styles = compileStyles;
exports.build = build;
exports.default = dev;
exports.watch = dev;
