module.exports = function( grunt ) {
  'use strict';
  //
  // Grunt configuration:
  //
  // https://github.com/cowboy/grunt/blob/master/docs/getting_started.md
  //
  grunt.initConfig({

    // Project configuration
    // ---------------------

    // specify an alternate install location for Bower
    bower: {
      dir: 'public/assets/js/lib'
    },

    // Coffee to JS compilation
    coffee: {
      compile: {
        files: {
          'public/assets/js/*.js': 'src/scripts/**/*.coffee'
        },
        options: {
          basePath: 'src/scripts'
        }
      }
    },

    // compile .scss/.sass to .css using Compass
    compass: {
      dist: {
        // http://compass-style.org/help/tutorials/configuration-reference/#configuration-properties
        options: {
          css_dir: 'public/assets/css',
          sass_dir: 'src/styles',
          images_dir: 'public/assets/images',
          javascripts_dir: 'public/assets/js',
          force: true,
          require: [
            'zurb-foundation'
          ]
        }
      }
    },

    // generate publiclication cache manifest
    manifest:{
      dest: ''
    },

    // headless testing through PhantomJS
    mocha: {
      all: ['test/**/*.html']
    },

    // default watch configuration
    watch: {
      coffee: {
        files: 'src/scripts/**/*.coffee',
        tasks: 'coffee reload'
      },
      compass: {
        files: [
          'src/styles/**/*.{scss,sass}'
        ],
        tasks: 'compass reload'
      },
      reload: {
        files: [
          'templates/**/*.html',
          'app/**/*.php',
          'app/views/**/*.html',
          '*.php',
          'public/*.html',
          'public/assets/css/**/*.css',
          'public/assets/js/**/*.js',
          'public/assets/images/**/*'
        ],
        tasks: 'reload'
      }
    },

    // default lint configuration, change this to match your setup:
    // https://github.com/cowboy/grunt/blob/master/docs/task_lint.md#lint-built-in-task
    lint: {
      files: [
        'Gruntfile.js',
        'public/assets/js/**/*.js',
        'spec/**/*.js'
      ]
    },

    // specifying JSHint options and globals
    // https://github.com/cowboy/grunt/blob/master/docs/task_lint.md#specifying-jshint-options-and-globals
    jshint: {
      options: {
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        boss: true,
        eqnull: true,
        browser: true
      },
      globals: {
        jQuery: true
      }
    },

    // Build configuration
    // -------------------

    // the staging directory used during the process
    staging: 'temp',
    // final build output
    output: 'dist',

    mkdirs: {
      staging: 'public/'
    },

    // Below, all paths are relative to the staging directory, which is a copy
    // of the public/ directory. Any .gitignore, .ignore and .buildignore file
    // that might publicear in the public/ tree are used to ignore these values
    // during the copy process.

    // concat css/**/*.css files, inline @import, output a single minified css
    css: {
      'assets/css/main.css': ['assets/css/**/*.css']
    },

    // renames JS/CSS to prepend a hash of their contents for easier
    // versioning
    rev: {
      js: 'assets/js/**/*.js',
      css: 'assets/css/**/*.css',
      img: 'assets/images/**'
    },

    // usemin handler should point to the file containing
    // the usemin blocks to be parsed
    'usemin-handler': {
      html: 'index.html'
    },

    // update references in HTML/CSS to revved files
    usemin: {
      html: ['**/*.html'],
      css: ['**/*.css']
    },

    // HTML minification
    html: {
      files: ['**/*.html']
    },

    // Optimizes JPGs and PNGs (with jpegtran & optipng)
    img: {
      dist: '<config:rev.img>'
    },

    // rjs configuration. You don't necessarily need to specify the typical
    // `path` configuration, the rjs task will parse these values from your
    // main module, using http://requirejs.org/docs/optimization.html#mainConfigFile
    //
    // name / out / mainConfig file should be used. You can let it blank if
    // you're using usemin-handler to parse rjs config from markup (default
    // setup)
    rjs: {
      // no minification, is done by the min task
      optimize: 'none',
      baseUrl: './scripts',
      wrap: true,
      name: 'main'
    },

    // While Yeoman handles concat/min when using
    // usemin blocks, you can still use them manually
    concat: {
      dist: ''
    },

    min: {
      dist: ''
    },

    server: {
      port: 35729
    }
  });

  // Alias the `test` task to run the `mocha` task instead
  grunt.registerTask('test', 'server:phantom mocha');

};
