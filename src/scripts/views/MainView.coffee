define ['jquery', 'underscore', 'backbone', 'collections/Forums', 'text!templates/main.html'], ($, _, Backbone, Forums, mainTemplate) ->

  Backbone.View.extend {
    el: '#main-frame',

    events: {
    }

    initialize: ()->
      forums = new Forums
      forums.fetch()

      self = @

      forums.on 'reset', (event) ->
        self.$el.html(_.template(mainTemplate, {forums: @.models}))
  }
