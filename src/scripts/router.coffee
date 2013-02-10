define ['backbone', 'require', 'views/MainView', 'views/ForumView', 'views/ThreadView', 'views/CreateThreadView'], (Backbone, require) ->

  Router = Backbone.Router.extend {
    routes: {
      "": "index",
      "forum/:id": "forum",
      "forum/:forumID/thread/new": "new_thread",
      "thread/:id": "thread"
    }

    index: ->
      MainView =  require('views/MainView')
      @.currentView = new MainView

    forum: (id)->
      ForumView = require('views/ForumView')
      @.currentView = new ForumView {id: id}

    new_thread: (forumID)->
      CreateThreadView = require('views/CreateThreadView')
      @.currentView = new CreateThreadView {forumID: forumID, router: @}

    thread: (id) ->
      ThreadView = require('views/ThreadView')
      @.currentView = new ThreadView {id: id}
  }
