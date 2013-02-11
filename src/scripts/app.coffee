define ['jquery', 'backbone', 'persona', 'router', 'collections/Forums'], ($, Backbone, navigator, Router, MainView, Forums) ->

  class App
    constructor: ->
      # Backbone Router
      router = new Router
      #Backbone.history.start({pushState: true, root: '/3day-forum'})
      Backbone.history.start()

      # BorwserID (Persona)
      navigator.id.watch {
        loggedInUser: router.loggedInUser,

        onlogin: (assertion) ->
          $.ajax {
            type: 'POST',
            url: 'user/login',
            data: {assertion: assertion},
            success: (res)->
              el = $("#user-area")
              el.html('');
              el.append "<li><a href=\"#/profile\">Profile</a></li>"
              el.append "<li><a href=\"javascript:navigator.id.logout();\">Logout</a></li>"

              router.loggedInUser = res.email

            error: (res)->
              $("#user-area").append res.error

          }

        onlogout: () ->
          $.ajax {
            type: 'GET',
            url: 'user/logout',
            success: (res) ->
              $("#user-area").html('');
              $("#user-area").append '<li><a href="javascript:navigator.id.request();">Login</a></li>'

            error: (res) ->
              # Do nothing

          }
      }

