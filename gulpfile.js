var gulp            = require('gulp'),
    sass            = require('gulp-sass'),
    sourcemaps      = require('gulp-sourcemaps'),
    autoprefixer    = require('gulp-autoprefixer'),
    cleancss        = require('gulp-clean-css'),
    rename          = require('gulp-rename'),
    concat          = require('gulp-concat'),
    uglify          = require('gulp-uglify-es').default,
    npmDist         = require('gulp-npm-dist'),
    browserSync     = require('browser-sync').create();
    gutil           = require( 'gulp-util' ),
    ftp = require( 'vinyl-ftp' );

var config = require('./config.gulp.json');

var scriptsArr = [
    config.paths.src.libs+'jquery/dist/jquery.slim.min.js',
    config.paths.src.libs+'gsap/TweenMax.js',
    config.paths.src.libs+'gsap/TimelineMax.js',
    config.paths.src.libs+'gsap/ScrollToPlugin.js',
    config.paths.src.libs+'barba.js/dist/barba.min.js',
    config.paths.src.libs+'instafeed.js/instafeed.min.js',
    config.paths.src.libs+'lazysizes/lazysizes.min.js',
    config.paths.src.libs+'scrollmagic/scrollmagic/uncompressed/ScrollMagic.js',
    config.paths.src.libs+'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js',
    config.paths.src.libs+'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js',
    config.paths.src.libs+'swiper/dist/js/swiper.min.js',
    config.paths.src.scripts+'ArticleModule.js',
    config.paths.src.scripts+'CarrouselModule.js',
    config.paths.src.scripts+'DefaultTransition.js',
    config.paths.src.scripts+'FromNavTransition.js',
    config.paths.src.scripts+'PageTransitions.js',
    config.paths.src.scripts+'ElementInView.js',
    config.paths.src.scripts+'HeaderView.js',
    config.paths.src.scripts+'HeroView.js',
    config.paths.src.scripts+'FrontPageView.js',
    config.paths.src.scripts+'PageView.js',
    config.paths.src.scripts+'SupportView.js',
    config.paths.src.scripts+'ProductView.js',
    config.paths.src.scripts+'LoaderView.js',
    config.paths.src.scripts+'main.js'
]

gulp.task('sass', function () {
    return gulp.src(config.paths.src.styles+'main.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({includePaths: ['node_modules']}).on('error', sass.logError))
        .pipe(autoprefixer({ browsers: ['last 2 versions'] }))
        .pipe(sourcemaps.write())
        .pipe(cleancss())
        .pipe(rename({basename: "styles", suffix: '.min'}))
        .pipe(gulp.dest(config.paths.dist.styles))
        .pipe(browserSync.stream())
});

gulp.task('concat-scripts', function () {
    return gulp.src(scriptsArr)
        // .pipe(sourcemaps.init())
        .pipe(concat('scripts.js'))
        // .pipe(sourcemaps.write())
        .pipe(gulp.dest(config.paths.build.scripts))
        .pipe(browserSync.stream())
});

gulp.task('uglify', function () {
    return gulp.src(scriptsArr)
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(config.paths.dist.scripts))
});

gulp.task('copy-libs', function() {
    return gulp.src(npmDist(), {base:'./node_modules'})
        .pipe(gulp.dest(config.paths.src.libs))
        .pipe(browserSync.stream())
});

gulp.task('copy-fonts', function(){
    return gulp.src(config.paths.src.fonts)
        .pipe(gulp.dest(config.paths.dist.fonts))
    }
);

gulp.task('copy-img', function(){
    return gulp.src(config.paths.src.img)
        .pipe(gulp.dest(config.paths.dist.img))
    }
);

gulp.task('watch', function() {
    browserSync.init({
        proxy: "onea.wp",
        injectChanges: true
    });
    gulp.watch(config.paths.src.styles+'**/*.scss', gulp.series('sass')).on('change', browserSync.reload);
    gulp.watch(config.paths.src.scripts+'**/*.js', gulp.series('concat-scripts')).on('change', browserSync.reload);
    gulp.watch('./**/*.php').on('change', browserSync.reload);
});

gulp.task( 'deploy', function () {

	var conn = ftp.create( {
		host:     config.ftp.host,
		user:     config.ftp.user,
		password: config.ftp.password,
		log:      gutil.log
	} );

	var globs = [
        './**/*',
        '!./{.gitattributes,.gitignore,config.gulp.json,gulpfile.js,package-lock.json,package.json,README.md,node_modules,node_modules/**/*,assets/src,assets/src/**/*}',
	];

	// using base = '.' will transfer everything to /public_html correctly
	// turn off buffering in gulp.src for best performance

	return gulp.src( globs, { base: '.', buffer: false } )
		.pipe( conn.newerOrDifferentSize( config.ftp.path ) ) // only upload newer files
		.pipe( conn.dest( config.ftp.path ) );

} );

var build = gulp.series('copy-libs','copy-fonts','copy-img','sass','concat-scripts','uglify');
gulp.task('default', build);