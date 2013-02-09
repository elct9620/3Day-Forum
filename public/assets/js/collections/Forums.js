(function() {

  define(['backbone', 'models/Forum'], function(Backbone, Forum) {
    return Backbone.Collection.extend({
      model: Forum,
      url: 'api/forums'
    });
  });

}).call(this);
