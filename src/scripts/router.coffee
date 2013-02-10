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
      new MainView

    forum: (id)->
      ForumView = require('views/ForumView')
      new ForumView {id: id}

    new_thread: (forumID)->
      CreateThreadView = require('views/CreateThreadView')
      new CreateThreadView {forumID: forumID}

    thread: (id) ->
      ThreadView = require('views/ThreadView')
      new ThreadView {id: id}
  }
