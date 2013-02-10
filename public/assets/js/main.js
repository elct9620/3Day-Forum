(function() {

  require.config({
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
      },
      persona: {
        exports: "navigator"
      }
    },
    paths: {
      hm: 'vendor/hm',
      esprima: 'vendor/esprima',
      jquery: 'vendor/jquery.min',
      text: 'lib/requirejs-text/text',
      underscore: 'lib/underscore/underscore-min',
      backbone: 'lib/backbone/backbone-min',
      persona: 'https://login.persona.org/include'
    }
  });

  require(['jquery', 'app'], function($, App) {
    return $(document).ready(function() {
      return new App;
    });
  });

}).call(this);
