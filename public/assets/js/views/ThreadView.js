(function() {

  define(['jquery', 'underscore', 'backbone', 'models/Thread', 'models/Post', 'collections/Posts', 'text!templates/thread.html', 'text!templates/post.html'], function($, _, Backbone, Thread, Post, Posts, mainTemplate, postTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      events: {
        "click #create-post button[type=submit]": "new_post",
        "click a.delete-thread": "delete_thread",
        "click a.delete": "delete_post"
      },
      initialize: function(options) {
        var alert, self;
        this.router = options.router;
        this.thread = new Thread({
          id: this.id
        });
        this.thread.fetch();
        this.posts = new Posts;
        self = this;
        alert = $("#alert");
        alert.text("Loading ...").toggle();
        this.thread.on('change', function(event) {
          self.$el.html(_.template(mainTemplate, {
            subject: self.thread.get('subject'),
            content: self.thread.get('content'),
            author: self.thread.get('author').nickname,
            gavatar: self.thread.get('author').gavatar,
            threadID: this.id,
            is_author: (self.router.loggedInUser === self.thread.get('author').email) || self.router.is_admin
          }));
          self.posts.fetch({
            data: {
              threadID: this.id
            }
          });
          return alert.toggle();
        });
        return this.posts.on('reset', function(event) {
          return this.each(function(post) {
            return $("#posts").append(_.template(postTemplate, {
              id: post.get('id'),
              content: post.get('content'),
              author: post.get('author').nickname,
              gavatar: post.get('author').gavatar,
              is_author: (self.router.loggedInUser === post.get('author').email) || self.router.is_admin
            }));
          });
        });
      },
      new_post: function(e) {
        var content, content_el, post, self, verify;
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
          self = this;
          post.on("sync", function(event) {
            return $("#posts").append(_.template(postTemplate, {
              id: this.get('id'),
              content: this.get('content'),
              author: this.get('author').nickname,
              gavatar: this.get('author').gavatar,
              is_author: (self.router.loggedInUser === this.get('author').email) || self.router.is_admin
            }));
          });
        }
        return e.preventDefault();
      },
      delete_thread: function(e) {
        var self;
        self = this;
        this.thread.destroy();
        this.thread.on("sync", function(event) {
          return self.router.navigate("forum/" + (self.thread.get('forum')), {
            trigger: true
          });
        });
        return e.preventDefault();
      },
      delete_post: function(e) {
        var id, post, post_el;
        id = $(e.target).attr('data-id');
        post_el = $("#post-id-" + id);
        post = new Post({
          id: id
        });
        post.destroy();
        post.on("sync", function(event) {
          return post_el.remove();
        });
        return e.preventDefault();
      }
    });
  });

}).call(this);
