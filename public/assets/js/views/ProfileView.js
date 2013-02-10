(function() {

  define(['jquery', 'underscore', 'backbone', 'text!templates/profile.html'], function($, _, Backbone, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      events: {
        "click #profile button[type=submit]": "save_profile"
      },
      initialize: function(options) {
        this.router = options.router;
        return this.$el.html(_.template(mainTemplate));
      },
      save_profile: function(e) {
        var nickname, nickname_el, self, verify;
        nickname_el = $("#profile input[name=nickname]");
        nickname = nickname_el.val();
        verify = true;
        if (nickname === "undefined" || nickname.length <= 0) {
          nickname_el.addClass('error');
          verify = false;
        }
        if (verify) {
          self = this;
          $.ajax({
            type: 'POST',
            url: 'api/update_nickname',
            data: {
              nickname: nickname
            },
            success: function(res) {
              return self.router.navigate('', {
                trigger: true
              });
            },
            error: function() {
              return nickname_el.addClass('error');
            }
          });
        }
        return e.preventDefault();
      }
    });
  });

}).call(this);
