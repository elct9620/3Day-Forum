(function() {

  define(['backbone', 'require', 'views/MainView', 'views/ForumView', 'views/ThreadView'], function(Backbone, require) {
    var Router;
    return Router = Backbone.Router.extend({
      routes: {
        "": "index",
        "forum/:id": "forum",
        "thread/:id": "thread"
      },
      index: function() {
        var MainView;
        MainView = require('views/MainView');
        return new MainView;
      },
      forum: function(id) {
        var ForumView;
        ForumView = require('views/ForumView');
        return new ForumView({
          id: id
        });
      },
      thread: function(id) {
        var ThreadView;
        ThreadView = require('views/ThreadView');
        return new ThreadView({
          id: id
        });
      }
    });
  });

}).call(this);
