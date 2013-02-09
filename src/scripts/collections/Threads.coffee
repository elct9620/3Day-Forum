define ['backbone', 'models/Thread'], (Backbone, Thread) ->

  Backbone.Collection.extend {
    model: Thread,
    url: 'api/threads'
  }
