define ['backbone', 'require', 'views/MainView', 'views/ForumView', 'views/ThreadView'], (Backbone, require) ->

  Router = Backbone.Router.extend {
    routes: {
      "": "index",
      "forum/:id": "forum",
      "thread/:id": "thread"
    }

    index: ->
      MainView =  require('views/MainView')
      new MainView

    forum: (id)->
      ForumView = require('views/ForumView')
      new ForumView {id: id}

    thread: (id) ->
      ThreadView = require('views/ThreadView')
      new ThreadView {id: id}
  }
