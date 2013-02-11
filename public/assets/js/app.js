(function() {

  define(['jquery', 'backbone', 'persona', 'router', 'collections/Forums'], function($, Backbone, navigator, Router, MainView, Forums) {
    var App;
    return App = (function() {

      function App() {
        var router;
        router = new Router;
        Backbone.history.start();
        navigator.id.watch({
          loggedInUser: router.loggedInUser,
          onlogin: function(assertion) {
            return $.ajax({
              type: 'POST',
              url: 'user/login',
              data: {
                assertion: assertion
              },
              success: function(res) {
                var el;
                el = $("#user-area");
                el.html('');
                el.append("<li><a href=\"#/profile\">Profile</a></li>");
                el.append("<li><a href=\"javascript:navigator.id.logout();\">Logout</a></li>");
                return router.loggedInUser = res.email;
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
                return $("#user-area").append('<li><a href="javascript:navigator.id.request();">Login</a></li>');
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
