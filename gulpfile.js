const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cssnano = require('gulp-cssnano');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();
const reload = browserSync.reload;

paths = {
	sass: './src/sass/**/*.scss',
	sassDest: './public/css',
	js: './src/js/**/*.js',
	jsDest: './public/js',
	public: './public',
	bootstrapCSS: './node_modules/bootstrap/dist/css/bootstrap.min.css',
	bootstrapJS: './node_modules/bootstrap/dist/js/bootstrap.min.js',
};

function buildStyles(done) {
	src(paths.bootstrapCSS).pipe(dest(paths.sassDest));
	src(paths.sass)
		.pipe(sass().on('error', sass.logError))
		.pipe(cssnano())
		.pipe(rename({ suffix: '.min' }))
		.pipe(dest(paths.sassDest));
	done();
}

function javascriptCompiler(done) {
	src(paths.bootstrapJS).pipe(dest(paths.jsDest))
	src(paths.js)
		.pipe(
			babel({
				presets: ['@babel/env'],
			})
		)
		.pipe(uglify())
		.pipe(rename({ suffix: '.min' }))
		.pipe(dest(paths.jsDest));
	done();
}

function startBrowserSync(done) {
	browserSync.init({
		proxy: 'localhost/todolist-php-project/public',
		port: 3000,
	});
	done();
}

function watchForChanges(done) {
	watch('./public/**/*.php').on('change', reload);
	watch([paths.sass, paths.js], parallel(buildStyles, javascriptCompiler)).on('change', reload);

	done();
}

const mainFunctions = parallel(buildStyles, javascriptCompiler);
exports.default = series(mainFunctions, startBrowserSync, watchForChanges);
