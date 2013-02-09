(function() {

  define(['jquery', 'underscore', 'backbone', 'collections/Forums', 'collections/Threads', 'text!templates/forum.html'], function($, _, Backbone, Forums, Threads, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      events: {},
      initialize: function() {
        var forums, self, threads;
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
        return threads.on('reset', function(event) {
          return self.$el.html(_.template(mainTemplate, {
            threads: this.models
          }));
        });
      }
    });
  });

}).call(this);
