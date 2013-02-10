define ['jquery', 'underscore', 'backbone', 'text!templates/profile.html'], ($, _, Backbone, mainTemplate) ->

  Backbone.View.extend {
    el: '#main-frame',

    events: {
      "click #profile button[type=submit]": "save_profile"
    }

    initialize: (options)->
      @.router = options.router
      @.$el.html(_.template(mainTemplate))

    save_profile: (e)->
      nickname_el = $("#profile input[name=nickname]")

      nickname = nickname_el.val()

      verify = true

      if nickname == "undefined" or nickname.length <= 0
        nickname_el.addClass 'error'
        verify = false

      if verify
        self = @
        $.ajax {
          type: 'POST',
          url: 'api/update_nickname',
          data: {nickname: nickname},
          success: (res) ->
            self.router.navigate '', {trigger: true}
          error: ->
            nickname_el.addClass 'error'
        }

      e.preventDefault()

  }
