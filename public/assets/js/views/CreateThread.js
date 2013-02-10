(function() {

  define(['jquery', 'underscore', 'backbone', 'collections/Threads', 'text!templates/create_thread.html'], function($, _, Backbone, Threads, mainTemplate) {
    return Backbone.View.extend({
      el: '#main-frame',
      events: {},
      initialize: function() {}
    });
  });

}).call(this);
