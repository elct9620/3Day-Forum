(function() {

  define(['jquery', 'underscore', 'backbone', 'models/Thread', 'collections/Posts', 'text!templates/thread.html'], function($, _, Backbone, Thread, Posts, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      events: {
        "click #create-post button[type=submit]": "new_post"
      },
      initialize: function() {
        var self, thread;
        thread = new Thread({
          id: this.id
        });
        thread.fetch();
        this.posts = new Posts;
        self = this;
        thread.on('change', function(event) {
          self.$el.html(_.template(mainTemplate, {
            thread: this,
            threadID: this.id
          }));
          return self.posts.fetch({
            data: {
              threadID: this.id
            }
          });
        });
        return this.posts.on('reset', function(event) {
          return this.each(function(post) {
            return $("#posts").append("<div>" + (post.get('content')) + "</div>");
          });
        });
      },
      new_post: function(e) {
        var content, content_el, verify;
        content_el = $("#create-post textarea[name=content]");
        content = content_el.val();
        verify = true;
        if (content === "undefined" || content.length <= 0) {
          content_el.addClass('warn');
          verify = false;
        }
        if (verify) {
          this.posts.create({
            content: content,
            threadID: this.id
          });
        }
        return e.preventDefault();
      }
    });
  });

}).call(this);
