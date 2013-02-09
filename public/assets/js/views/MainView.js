(function() {

  define(['jquery', 'underscore', 'backbone', 'collections/Forums', 'text!templates/main.html'], function($, _, Backbone, Forums, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      initialize: function() {
        var forums, self;
        forums = new Forums;
        forums.fetch();
        self = this;
        return forums.on('reset', function(event) {
          return self.$el.html(_.template(mainTemplate, {
            forums: this.models
          }));
        });
      }
    });
  });

}).call(this);
