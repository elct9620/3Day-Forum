(function() {

  define(['jquery', 'underscore', 'backbone', 'collections/Forums', 'text!templates/main.html'], function($, _, Backbone, Forums, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      initialize: function() {
        var alert, forums, self;
        forums = new Forums;
        forums.fetch();
        self = this;
        alert = $("#alert");
        alert.text("Loading ...").toggle();
        return forums.on('reset', function(event) {
          self.$el.html(_.template(mainTemplate, {
            forums: this.models
          }));
          return alert.toggle();
        });
      }
    });
  });

}).call(this);
