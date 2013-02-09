(function() {

  define(['backbone'], function(Backbone) {
    return Backbone.Model.extend({
      urlRoot: 'api/thread'
    });
  });

}).call(this);
