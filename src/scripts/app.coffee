define ['backbone', 'router', 'collections/Forums'], (Backbone, Router, MainView, Forums) ->

  class App
    constructor: ->
      new Router

      #Backbone.history.start({pushState: true, root: '/3day-forum'})
      Backbone.history.start()

