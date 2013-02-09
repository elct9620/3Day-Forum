define ['backbone', 'models/Forum'], (Backbone, Forum) ->

  Backbone.Collection.extend {
    model: Forum,
    url: 'api/forums'
  }
