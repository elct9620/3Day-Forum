(function() {

  define(['backbone', 'models/Thread'], function(Backbone, Thread) {
    return Backbone.Collection.extend({
      model: Thread,
      url: 'api/threads'
    });
  });

}).call(this);
