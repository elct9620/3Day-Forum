(function() {

  define(['jquery', 'underscore', 'backbone', 'models/Thread', 'collections/Posts', 'text!templates/thread.html'], function($, _, Backbone, Thread, Posts, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      events: {},
      initialize: function() {
        var posts, self, thread;
        thread = new Thread({
          id: this.id
        });
        thread.fetch();
        posts = new Posts;
        self = this;
        thread.on('change', function(event) {
          self.$el.html(_.template(mainTemplate, {
            thread: this
          }));
          return posts.fetch({
            data: {
              threadID: this.id
            }
          });
        });
        return posts.on('reset', function(event) {
          return this.each(function(post) {
            return $("#posts").append("<div>" + (post.get('content')) + "</div>");
          });
        });
      }
    });
  });

}).call(this);
