(function() {

  define(['jquery', 'underscore', 'backbone', 'models/Thread', 'collections/Posts', 'text!templates/thread.html', 'text!templates/post.html'], function($, _, Backbone, Thread, Posts, mainTemplate, postTemplate) {
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
            return $("#posts").append(_.template(postTemplate, {
              content: post.get('content')
            }));
          });
        });
      },
      new_post: function(e) {
        var content, content_el, post, verify;
        content_el = $("#create-post textarea[name=content]");
        content = content_el.val();
        verify = true;
        if (content === "undefined" || content.length <= 0) {
          content_el.addClass('warn');
          verify = false;
        }
        if (verify) {
          post = this.posts.create({
            content: content,
            threadID: this.id
          });
          content_el.val('');
          post.on("sync", function(event) {
            return $("#posts").append(_.template(postTemplate, {
              content: this.get('content')
            }));
          });
        }
        return e.preventDefault();
      }
    });
  });

}).call(this);
