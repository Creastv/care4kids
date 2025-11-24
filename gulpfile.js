const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();

const isProduction = process.env.NODE_ENV === 'production';

const paths = {
  styles: {
    src: 'assets/css/main.scss',
    watch: ['assets/css/main.scss', 'assets/scss/**/*.scss'],
    dest: 'assets/css',
  },
  adminStyles: {
    src: 'assets/css/admin.scss',
    watch: ['assets/css/admin.scss', 'assets/scss/**/*.scss'],
    dest: 'assets/css',
  },
  blocks: {
    src: 'blocks/*/*.scss',
    watch: 'blocks/**/*.scss',
    dest: 'blocks',
  },
  php: '**/*.php',
  js: 'assets/js/**/*.js',
};

function compileStyles(srcPath, destPath) {
  srcPath = srcPath || paths.styles.src;
  destPath = destPath || paths.styles.dest;
  
  const postcssPlugins = [autoprefixer()];

  if (isProduction) {
    postcssPlugins.push(cssnano());
  }

  let stream = src(srcPath);

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

  stream = stream.pipe(dest(destPath));

  return stream.pipe(browserSync.stream({ match: '**/*.css' }));
}

function compileMainStyles() {
  return compileStyles(paths.styles.src, paths.styles.dest);
}

function compileAdminStyles() {
  return compileStyles(paths.adminStyles.src, paths.adminStyles.dest);
}

function compileBlocks() {
  const postcssPlugins = [autoprefixer()];

  return src(paths.blocks.src, { base: 'blocks' })
    .pipe(
      sass({
        outputStyle: 'expanded',
      }).on('error', sass.logError)
    )
    .pipe(postcss(postcssPlugins))
    .pipe(rename({ extname: '.css' }))
    .pipe(dest(paths.blocks.dest))
    .pipe(postcss([...postcssPlugins, cssnano()]))
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest(paths.blocks.dest))
    .pipe(browserSync.stream({ match: '**/*.css' }));
}

function serve(done) {
  browserSync.init({
    proxy: 'http://localhost/care4kids',
    notify: false,
    open: false,
  });
  done();
}

function watchFiles() {
  watch(paths.styles.watch, compileMainStyles);
  watch(paths.adminStyles.watch, compileAdminStyles);
  watch(paths.blocks.watch, compileBlocks);
  watch([paths.php, paths.js]).on('change', browserSync.reload);
}

const build = series(compileMainStyles, compileAdminStyles, compileBlocks);
const dev = series(build, serve, watchFiles);

exports.styles = compileMainStyles;
exports.adminStyles = compileAdminStyles;
exports.blocks = compileBlocks;
exports.build = build;
exports.default = dev;
exports.watch = dev;
