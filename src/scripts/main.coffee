require.config {
  shim: {
    jquery: {
      exports: "$"
    },
    backbone: {
      deps: ['underscore', 'jquery'],
      exports: "Backbone"
    },
    underscore: {
      deps: ['jquery'],
      exports: "_"
    }
  },

  paths: {
    hm: 'vendor/hm',
    esprima: 'vendor/esprima',
    jquery: 'vendor/jquery.min',

    text: 'lib/requirejs-text/text',

    underscore: 'lib/underscore/underscore-min',
    backbone: 'lib/backbone/backbone-min'
  }
}

require ['app'], (app) ->
  console.log(app);
