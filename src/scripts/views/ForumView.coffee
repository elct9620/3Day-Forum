define ['jquery', 'underscore', 'backbone', 'collections/Forums', 'collections/Threads', 'text!templates/forum.html'], ($, _, Backbone, Forums, Threads, mainTemplate) ->

  Backbone.View.extend {
    el: '#main-frame',

    events: {
    }

    initialize: ()->
      forums = new Forums
      forums.fetch({data: {parent: @.id}})

      threads = new Threads
      threads.fetch({data: {forumID: @.id}})

      self = @

      alert = $("#alert")
      alert.text("Loading ...").toggle()

      threads.on 'reset', (event) ->
        self.$el.html(_.template(mainTemplate, {threads: @.models, forumID: self.id}))
        alert.toggle()
  }
