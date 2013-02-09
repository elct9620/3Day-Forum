(function() {

  define(['backbone', 'router', 'collections/Forums'], function(Backbone, Router, MainView, Forums) {
    var App;
    return App = (function() {

      function App() {
        new Router;
        Backbone.history.start();
      }

      return App;

    })();
  });

}).call(this);
