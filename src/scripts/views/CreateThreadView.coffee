define ['jquery', 'underscore', 'backbone', 'collections/Threads', 'text!templates/create_thread.html'], ($, _, Backbone, Threads, mainTemplate) ->

  Backbone.View.extend {
    el: '#main-frame',

    events: {
      "click button[type=submit]": "create_post"
    }

    initialize: (options)->
      @.forumID = options.forumID

      this.$el.html(_.template(mainTemplate, {forumID: @.forumID}))

    create_post: (e) ->
      subject_el = $("#create-thread input[name=subject]")
      content_el = $("#create-thread textarea[name=content]")

      subject = subject_el.val()
      content = content_el.val()

      verify = true

      if subject is "undefined" or subject.length <= 0
        subject_el.addClass 'warn'
        verify = false

      if content is "undefined" or content.length <= 0
        content_el.addClass 'warn'
        verify = false

      if verify
        threads = new Threads
        threads.create {
          subject: subject
          content: content
          forumID: @.forumID
        }

      e.preventDefault()
  }
