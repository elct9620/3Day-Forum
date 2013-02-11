(function() {

  define(['backbone', 'require', 'views/MainView', 'views/ForumView', 'views/ThreadView', 'views/CreateThreadView', 'views/ProfileView'], function(Backbone, require) {
    var Router;
    return Router = Backbone.Router.extend({
      routes: {
        "": "index",
        "forum/:id": "forum",
        "forum/:forumID/thread/new": "new_thread",
        "thread/:id": "thread",
        "profile": "profile"
      },
      initialize: function(options) {
        if (options == null) {
          options = {};
        }
        this.loggedInUser = options.email || null;
        return this.is_admin = options.is_admin || false;
      },
      index: function() {
        var MainView;
        MainView = require('views/MainView');
        return this.currentView = new MainView;
      },
      forum: function(id) {
        var ForumView;
        ForumView = require('views/ForumView');
        return this.currentView = new ForumView({
          id: id
        });
      },
      new_thread: function(forumID) {
        var CreateThreadView;
        CreateThreadView = require('views/CreateThreadView');
        return this.currentView = new CreateThreadView({
          forumID: forumID,
          router: this
        });
      },
      thread: function(id) {
        var ThreadView;
        ThreadView = require('views/ThreadView');
        return this.currentView = new ThreadView({
          id: id,
          router: this
        });
      },
      profile: function() {
        var ProfileView;
        ProfileView = require('views/ProfileView');
        return this.currentView = new ProfileView({
          router: this
        });
      }
    });
  });

}).call(this);
