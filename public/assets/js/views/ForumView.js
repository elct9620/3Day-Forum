(function() {

  define(['jquery', 'underscore', 'backbone', 'collections/Forums', 'collections/Threads', 'text!templates/forum.html'], function($, _, Backbone, Forums, Threads, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      events: {},
      initialize: function() {
        var alert, forums, self, threads;
        forums = new Forums;
        forums.fetch({
          data: {
            parent: this.id
          }
        });
        threads = new Threads;
        threads.fetch({
          data: {
            forumID: this.id
          }
        });
        self = this;
        alert = $("#alert");
        alert.text("Loading ...").toggle();
        return threads.on('reset', function(event) {
          self.$el.html(_.template(mainTemplate, {
            threads: this.models,
            forumID: self.id
          }));
          return alert.toggle();
        });
      }
    });
  });

}).call(this);
