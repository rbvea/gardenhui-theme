var gulp = require('gulp')
var $ = require('gulp-load-plugins')()
var scss = require('postcss-scss')
var atImport = require('postcss-import')
var rucksack = require('rucksack-css')
var simplevars = require('postcss-simple-vars')
var ms = require('postcss-modular-scale')
var lost = require('lost')
var cssnano = require('cssnano')
var fonts = require('postcss-font-magician')
const mixins = require('postcss-mixins')
const path = require('path')

var bs = require('browser-sync')

var webpack = require('webpack-stream')
var webpackConfig = require('./webpack.config.js')
const fractal = require('@frctl/fractal').create();

var env = (process.env.npm_lifecycle_event === 'fractal:build') ? 'dev' : 'local';

/* Set the title of the project */
fractal.set('project.title', 'GardenHui Library')
fractal.components.set('default.preview', '@preview');
fractal.web.set('static.path', __dirname);
fractal.web.set('static.mount', `//${env}-gardenhui.pantheonsite.io/wp-content/themes/garden-hui-theme`);

const nunj = require('@frctl/nunjucks')({
  paths: [__dirname],
  filters: {
    date() {
      return '2016';
    },
    parse_display_name(name) {
      if(!name) {
        return ''
      }
      return name.replace(/\./g, ' ')
    }
  },
  globals: {
    function: function() {
      // do nothing
    },
    TimberImage: function(url) {
      return {
        src: function() {
          return url
        }
      }
    },
    stylesheet: `<link rel="stylesheet"`+
                `href="http://${env}-gardenhui.pantheonsite.io` +
                `/wp-content/themes/garden-hui-theme/style.css">`,
    site: {
      theme: {
        uri: `http://${env}-gardenhui.pantheonsite.io/wp-content/themes/garden-hui-theme`
      }
    }
  },
})
fractal.components.engine(nunj);

/* Tell Fractal where the components will live */
fractal.components.set('path', __dirname + '/components')
fractal.components.set('ext', '.twig')
fractal.web.set('builder.dest', 'docs')

/* Tell Fractal where the documentation pages will live */
fractal.docs.set('path', __dirname + '/docs')

var PATHS = {
  sass: [
    'scss/style.scss',
    'components/**/*.scss'
  ],
  templates: [
    'components/**/*.twig'
  ],
  scripts: [
    'components/**/script.js'
  ]
}

gulp.task('sass', function () {

  const defaults = require('./scss/config/common.js');
  const plugins = [
    atImport({
      from: 'scss'
    }),
    mixins,
    simplevars({ variables: defaults }),
    rucksack({ autoprefixer: true }),
    ms
  ]

  var postPlugins = [
    lost,
    fonts,
    cssnano
  ]

  gulp
    .src(PATHS.sass)
    .pipe($.plumber())
    .pipe($.postcss(plugins, {syntax: scss}))
    .pipe($.sass())
    .pipe($.postcss(postPlugins))
    .pipe($.concat('style.css'))
    .pipe(gulp.dest('.'))
    .pipe(bs.stream({match: '**/*.css'}))
})

gulp.task('html', function() {

  var plugins = [
    cssmod({
     generateScopedName: '[hash:base64:5]'
    })
  ]

  gulp.src(PATHS.html)
    .pipe($.plumber())
    .pipe($.posthtml(plugins))
    .pipe($.htmlExtract({
      sel: 'style'
    }))
    .pipe()
    .pipe(gulp.dest(function(path) {
      return 'test'
    }));
})

gulp.task('js', function () {
  gulp.src(['components/**/*.js'])
      .pipe(webpack(webpackConfig))
      .pipe($.concat('bundle.js'))
      .pipe(gulp.dest('./js'))
})

gulp.task('svg', function() {
  var svgs = gulp.src('./icons/*.svg')
    .pipe($.svgmin(function (file) {
      var prefix = path.basename(file.relative, path.extname(file.relative));
        return {
          plugins: [{
            cleanupIDs: {
              prefix: prefix + '-',
              minify: true
            }
          }]
        }
    }))
    .pipe($.svgstore())

    function fileContents(filePath, file) {
      return file.contents.toString();
    }

    return gulp
      .src('./templates/base.twig')
      .pipe($.inject(svgs, {transform: fileContents}))
      .pipe(gulp.dest('./templates'))
});

const logger = fractal.cli.console;

gulp.task('watch', ['sass', 'js'], function () {

  gulp.watch(PATHS.sass, ['sass'])

  gulp.watch(PATHS.scripts, ['js'])

  const lifecycle = process.env.npm_lifecycle_event;

  if(lifecycle === 'fractal') {

    const server = fractal.web.server({
         sync: true
     });

    server.on('error', err => logger.error(err.message));
    return server.start().then(() => {
      logger.success(`Fractal server is now running at ${server.url}`);
    })

  } else {
    bs.init({
      proxy: 'http://local-gardenhui.pantheonsite.io'
    })
  }

})

gulp.task('default', ['watch'])
