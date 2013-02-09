(function() {

  define(['backbone', 'require', 'views/MainView'], function(Backbone, require, MainView) {
    var Router;
    return Router = Backbone.Router.extend({
      routes: {
        "": "index",
        "forums": "forum",
        "forum/:slug": "forum"
      },
      index: function() {
        return new MainView;
      },
      forum: function(slug) {
        return console.log(slug);
      }
    });
  });

}).call(this);
