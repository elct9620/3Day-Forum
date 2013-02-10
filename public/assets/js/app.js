(function() {

  define(['jquery', 'backbone', 'persona', 'router', 'collections/Forums'], function($, Backbone, navigator, Router, MainView, Forums) {
    var App;
    return App = (function() {

      function App() {
        new Router;
        Backbone.history.start();
        navigator.id.watch({
          loggedInUser: null,
          onlogin: function(assertion) {
            return $.ajax({
              type: 'POST',
              url: 'user/login',
              data: {
                assertion: assertion
              },
              success: function(res) {
                $("#user-area").html('');
                $("#user-area").append("Hello, " + res.nickname);
                $("#user-area").append("<img src=\"http://www.gravatar.com/avatar/" + res.gavatar + "\" alt=\"" + res.nickname + "\" />");
                return $("#user-area").append("<a href=\"javascript:navigator.id.logout();\">Logout</a>");
              },
              error: function(res) {
                return $("#user-area").append(res.error);
              }
            });
          },
          onlogout: function() {
            return $.ajax({
              type: 'GET',
              url: 'user/logout',
              success: function(res) {
                $("#user-area").html('');
                return $("#user-area").append('<a href="javascript:navigator.id.request();">Login</a>');
              },
              error: function(res) {}
            });
          }
        });
      }

      return App;

    })();
  });

}).call(this);
