define ['jquery', 'underscore', 'backbone', 'models/Thread', 'collections/Posts', 'text!templates/thread.html'], ($, _, Backbone, Thread, Posts, mainTemplate) ->

  Backbone.View.extend {
    el: '#main-frame',

    events: {
      "click #create-post button[type=submit]": "new_post"
    }

    initialize: ()->

      thread = new Thread({id: @.id})
      thread.fetch()

      @.posts = new Posts

      self = @

      thread.on 'change', (event) ->
        self.$el.html(_.template(mainTemplate, {thread: @, threadID: @.id}))

        self.posts.fetch({data: {threadID: @.id}})


      @.posts.on 'reset', (event) ->
        @.each (post) ->
          $("#posts").append("<div class=\"row\"><div class=\"columns two\"></div><div class=\"columns ten\">#{post.get('content')}</div></div>")

    new_post: (e) ->
      content_el = $("#create-post textarea[name=content]")

      content = content_el.val()

      verify = true

      if content == "undefined" or content.length <= 0
        content_el.addClass 'warn'
        verify = false

      if verify
        @.posts.create {
          content: content,
          threadID: @.id
        }

      e.preventDefault()

  }
