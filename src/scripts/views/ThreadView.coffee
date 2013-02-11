define ['jquery', 'underscore', 'backbone', 'models/Thread', 'models/Post', 'collections/Posts', 'text!templates/thread.html', 'text!templates/post.html'], ($, _, Backbone, Thread, Post, Posts, mainTemplate, postTemplate) ->

  Backbone.View.extend {
    el: '#main-frame',

    events: {
      "click #create-post button[type=submit]": "new_post",
      "click a.delete-thread": "delete_thread",
      "click a.delete": "delete_post"
    }

    initialize: (options)->

      @.router = options.router

      @.thread = new Thread({id: @.id})
      @.thread.fetch()

      @.posts = new Posts

      self = @

      @.thread.on 'change', (event) ->
        self.$el.html(_.template(mainTemplate, {
          subject: self.thread.get('subject'),
          content: self.thread.get('content'),
          author: self.thread.get('author').nickname,
          gavatar: self.thread.get('author').gavatar,
          threadID: @.id,
          is_author: (self.router.loggedInUser == self.thread.get('author').email) || self.router.is_admin
        }))

        self.posts.fetch({data: {threadID: @.id}})

      @.posts.on 'reset', (event) ->
        @.each (post) ->
          $("#posts").append(_.template(postTemplate, {
            id: post.get('id'),
            content: post.get('content'),
            author: post.get('author').nickname,
            gavatar: post.get('author').gavatar,
            is_author: (self.router.loggedInUser == post.get('author').email) || self.router.is_admin
          }))

    new_post: (e) ->
      content_el = $("#create-post textarea[name=content]")

      content = content_el.val()

      verify = true

      if content == "undefined" or content.length <= 0
        content_el.addClass 'warn'
        verify = false

      if verify
        post = @.posts.create {
          content: content,
          threadID: @.id
        }

        content_el.val('');

        self = @

        post.on "sync", (event) ->
          $("#posts").append(_.template(postTemplate, {
            id: @.get('id'),
            content: @.get('content'),
            author: @.get('author').nickname,
            gavatar: @.get('author').gavatar,
            is_author: (self.router.loggedInUser == @.get('author').email) || self.router.is_admin
          }))

      e.preventDefault()

    delete_thread: (e) ->
      self = @

      @.thread.destroy()

      @.thread.on "sync", (event) ->
        self.router.navigate "forum/#{self.thread.get('forum')}", {trigger: true}

      e.preventDefault()

    delete_post: (e) ->

      id = $(e.target).attr('data-id')
      post_el = $("#post-id-#{id}")

      post = new Post({id: id})
      post.destroy()

      post.on "sync", (event) ->
        post_el.remove()

      e.preventDefault()
  }
