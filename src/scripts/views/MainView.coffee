define ['jquery', 'underscore', 'backbone', 'collections/Forums', 'text!templates/main.html'], ($, _, Backbone, Forums, mainTemplate) ->

  Backbone.View.extend {
    el: '#main-frame',

    initialize: ()->

      forums = new Forums
      forums.fetch()

      self = @

      alert = $("#alert")
      alert.text("Loading ...").toggle()

      forums.on 'reset', (event) ->
        self.$el.html(_.template(mainTemplate, {forums: @.models}))
        alert.toggle()
  }
