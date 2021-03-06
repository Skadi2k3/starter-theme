// generated on 2018-12-28 using generator-webapp 3.0.1
const gulp = require('gulp');
const gulpLoadPlugins = require('gulp-load-plugins');
const browserSync = require('browser-sync').create();
const del = require('del');
const wiredep = require('wiredep').stream;
const runSequence = require('run-sequence');
const browserify = require('browserify');
const babelify = require('babelify');
const buffer = require('vinyl-buffer');
const source = require('vinyl-source-stream');

const $ = gulpLoadPlugins();
const reload = browserSync.reload;

let dev = true;
let buildDir = 'static';
let sourceDir = 'source';
let templatesDir = 'templates';


/*
 *
 *		STYLES
 *
 */
function styles({
	build = false
} = {}) {
	return gulp.src(sourceDir + '/styles/*.scss')
		.pipe($.plumber())
		.pipe($.sourcemaps.init())
		.pipe($.sass.sync({
			outputStyle: 'expanded',
			precision: 10,
			includePaths: ['.']
		}).on('error', $.sass.logError))
		.pipe($.autoprefixer({
			browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']
		}))
		.pipe($.if(build, $.cssnano({
			safe: true,
			autoprefixer: false
		})))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest(buildDir + '/styles'))
		.pipe($.if(!build, reload({
			stream: true
		})));
};
gulp.task('styles', () => styles());
gulp.task('styles:build', () => styles({
	build: true
}));


/*
 *
 *		SCRIPTS
 *
 */
function scripts({
	build = false
} = {}) {
	const b = browserify({
		entries: sourceDir + '/scripts/site.js',
		transform: babelify,
		debug: true
	});

	return b.bundle()
		.pipe(source('site.js'))
		.pipe($.plumber())
		.pipe(buffer())
		.pipe($.sourcemaps.init({
			loadMaps: true
		}))
		.pipe($.if(build, $.uglify({
			compress: {
				drop_console: true
			}
		})))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest(buildDir + '/scripts'))
		.pipe($.if(!build, reload({
			stream: true
		})))
};
gulp.task('scripts', () => scripts());
gulp.task('scripts:build', () => scripts({
	build: true
}));


/*
 *
 *    LINTING
 *
 */
function lint(files) {
	return gulp.src(files)
		.pipe($.eslint({
			fix: true
		}))
		.pipe(reload({
			stream: true,
			once: true
		}))
		.pipe($.eslint.format())
		.pipe($.if(!browserSync.active, $.eslint.failAfterError()));
}

gulp.task('lint', () => {
	return lint(sourceDir + '/scripts/**/*.js')
		.pipe(gulp.dest(sourceDir + '/scripts'));
});

gulp.task('images', () => {
	return gulp.src(sourceDir + '/images/**/*')
		.pipe($.cache($.imagemin()))
		.pipe(gulp.dest(buildDir + '/images'));
});

// concat bower and own font files and copy it to the buildDir
gulp.task('fonts', () => {
	return gulp.src(require('main-bower-files')('**/*.{eot,svg,ttf,woff,woff2}', function (err) {})
			.concat(sourceDir + '/fonts/**/*'))
		.pipe(gulp.dest(buildDir + '/fonts'));
});

gulp.task('extras', () => {
	return gulp.src([
		sourceDir + '/*'
	], {
		dot: true
	}).pipe(gulp.dest(buildDir));
});

gulp.task('clean', del.bind(null, [buildDir]));

gulp.task('serve', () => {
	runSequence(['wiredep', 'fonts', 'extras', 'images'], ['styles', 'scripts', 'fonts'], () => {
		browserSync.init({
			proxy: 'wp-test1.loc',
			notify: false,
			port: 9000,
			serveStatic: [{
				route: '/bower_components',
				dir: 'bower_components'
			}]
		});

		gulp.watch([
			sourceDir + '/*.html',
			buildDir + '/images/**/*',
			sourceDir + '/fonts/**/*',
			templatesDir + '/**/*.twig',
			'*.php',
			'inc/**/*.php'
		]).on('change', reload);

		gulp.watch(sourceDir + '/styles/**/*.scss', ['styles']);
		gulp.watch(sourceDir + '/scripts/**/*.js', ['scripts']);
		gulp.watch(sourceDir + '/fonts/**/*', ['fonts']);
		gulp.watch(sourceDir + '/images/**/*', ['images']);
		gulp.watch('bower.json', ['wiredep', 'fonts']);
	});
});

// inject bower components
gulp.task('wiredep', () => {
	gulp.src(sourceDir + '/styles/*.scss')
		.pipe($.filter(file => file.stat && file.stat.size))
		.pipe(wiredep({
			ignorePath: /^(\.\.\/)+/
		}))
		.pipe(gulp.dest(sourceDir + '/styles'));

	gulp.src('templates/*.twig')
		.pipe(wiredep({
			exclude: ['bootstrap'],
			ignorePath: /^(\.\.\/)*\.\./
		}))
		.pipe(gulp.dest('templates'));
});

gulp.task('static:size', () => {
	return gulp.src(buildDir + '/**/*').pipe($.size({
		title: 'Static Files',
		gzip: true
	}));
})

gulp.task('build', () => {
	return new Promise(resolve => {
		runSequence(['lint'], ['styles:build', 'scripts:build', 'images', 'fonts', 'extras'], ['static:size'], resolve);
	});
});

gulp.task('default', () => {
	return new Promise(resolve => {
		dev = false;
		runSequence(['clean', 'wiredep'], 'build', resolve);
	});
});
