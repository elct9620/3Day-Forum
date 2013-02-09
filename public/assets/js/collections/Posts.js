(function() {

  define(['backbone', 'models/Post'], function(Backbone, Post) {
    return Backbone.Collection.extend({
      model: Post,
      url: 'api/posts'
    });
  });

}).call(this);
