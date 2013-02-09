require.config {
  shim: {
  },

  paths: {
    hm: 'vendor/hm',
    esprima: 'vendor/esprima',
    jquery: 'vendor/jquery.min'
  }
}

require ['app'], (app) ->
  console.log(app);
