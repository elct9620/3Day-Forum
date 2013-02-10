define ['jquery', 'backbone', 'persona', 'router', 'collections/Forums'], ($, Backbone, navigator, Router, MainView, Forums) ->

  class App
    constructor: ->
      # Backbone Router
      new Router
      #Backbone.history.start({pushState: true, root: '/3day-forum'})
      Backbone.history.start()

      # BorwserID (Persona)
      navigator.id.watch {
        loggedInUser: null,

        onlogin: (assertion) ->
          $.ajax {
            type: 'POST',
            url: 'user/login',
            data: {assertion: assertion},
            success: (res)->
              $("#user-area").html('');
              $("#user-area").append "Hello, #{res.nickname}"
              $("#user-area").append "<img src=\"http://www.gravatar.com/avatar/#{res.gavatar}\" alt=\"#{res.nickname}\" />"
              $("#user-area").append "<a href=\"javascript:navigator.id.logout();\">Logout</a>"

            error: (res)->
              $("#user-area").append res.error

          }

        onlogout: () ->
          $.ajax {
            type: 'GET',
            url: 'user/logout',
            success: (res) ->
              $("#user-area").html('');
              $("#user-area").append '<a href="javascript:navigator.id.request();">Login</a>'

            error: (res) ->
              # Do nothing

          }
      }

