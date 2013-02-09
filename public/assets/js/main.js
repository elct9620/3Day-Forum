(function() {

  require.config({
    shim: {},
    paths: {
      hm: 'vendor/hm',
      esprima: 'vendor/esprima',
      jquery: 'vendor/jquery.min'
    }
  });

  require(['app'], function(app) {
    return console.log(app);
  });

}).call(this);
