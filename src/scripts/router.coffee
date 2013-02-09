define ['backbone', 'require', 'views/MainView'], (Backbone, require, MainView) ->

  Router = Backbone.Router.extend {
    routes: {
      "": "index",
      "forums": "forum",
      "forum/:slug": "forum"
    }

    index: ->
      new MainView

    forum: (slug)->
      console.log slug

  }
