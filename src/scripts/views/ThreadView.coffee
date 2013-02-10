define ['jquery', 'underscore', 'backbone', 'models/Thread', 'collections/Posts', 'text!templates/thread.html'], ($, _, Backbone, Thread, Posts, mainTemplate) ->

  Backbone.View.extend {
    el: '#main-frame',

    events: {
    }

    initialize: ()->

      thread = new Thread({id: @.id})
      thread.fetch()

      posts = new Posts

      self = @

      thread.on 'change', (event) ->
        self.$el.html(_.template(mainTemplate, {thread: @}))

        posts.fetch({data: {threadID: @.id}})


      posts.on 'reset', (event) ->
        @.each (post) ->
          $("#posts").append("<div>#{post.get('content')}</div>")

  }
