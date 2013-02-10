(function() {

  define(['backbone', 'require', 'views/MainView', 'views/ForumView', 'views/ThreadView', 'views/CreateThreadView'], function(Backbone, require) {
    var Router;
    return Router = Backbone.Router.extend({
      routes: {
        "": "index",
        "forum/:id": "forum",
        "forum/:forumID/thread/new": "new_thread",
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
      new_thread: function(forumID) {
        var CreateThreadView;
        CreateThreadView = require('views/CreateThreadView');
        return new CreateThreadView({
          forumID: forumID
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
