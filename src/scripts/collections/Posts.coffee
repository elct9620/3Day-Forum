define ['backbone', 'models/Post'], (Backbone, Post) ->

  Backbone.Collection.extend {
    model: Post,
    url: 'api/posts'
  }
