(function() {

  define(['jquery', 'underscore', 'backbone', 'collections/Threads', 'text!templates/create_thread.html', 'router'], function($, _, Backbone, Threads, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      events: {
        "click button[type=submit]": "create_post"
      },
      initialize: function(options) {
        this.forumID = options.forumID;
        this.router = options.router;
        return this.$el.html(_.template(mainTemplate, {
          forumID: this.forumID
        }));
      },
      create_post: function(e) {
        var content, content_el, self, subject, subject_el, thread, threads, verify;
        subject_el = $("#create-thread input[name=subject]");
        content_el = $("#create-thread textarea[name=content]");
        subject = subject_el.val();
        content = content_el.val();
        verify = true;
        if (subject === "undefined" || subject.length <= 0) {
          subject_el.addClass('error');
          verify = false;
        }
        if (content === "undefined" || content.length <= 0) {
          content_el.addClass('error');
          verify = false;
        }
        if (verify) {
          threads = new Threads;
          thread = threads.create({
            subject: subject,
            content: content,
            forumID: this.forumID
          });
          self = this;
          thread.on("sync", function(event) {
            return self.router.navigate("thread/" + (this.get('id')), {
              trigger: true
            });
          });
        }
        return e.preventDefault();
      }
    });
  });

}).call(this);
