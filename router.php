<?php

// Middleware
$authorize = array('\Aotoki\BaseController', 'authorizeUser');

// Home
$app->get('/', array('\Aotoki\HomeController', 'home'))->name('home');

// Authorize
$app->post('/user/login', array('\Aotoki\UserController', 'login'));
$app->get('/user/logout', array('\Aotoki\UserController', 'logout'));

//API::Forum
$app->get('/api/forums', array('\Aotoki\Api\ForumController', 'getForums'));
$app->post('/api/forum/new', $authorize, array('\Aotoki\Api\ForumController', 'create'));
$app->put('/api/forum/edit', $authorize, array('\Aotoki\Api\ForumController', 'update'));
$app->delete('/api/forum/destroy', $authorize, array('\Aotoki\Api\ForumController', 'destroy'));

//API::Thread
$app->get('/api/threads', array('\Aotoki\Api\ThreadController', 'getThreads'));
$app->get('/api/thread/:id', array('\Aotoki\Api\ThreadController', 'getThread'));
$app->post('/api/thread', $authorize, array('\Aotoki\Api\ThreadController', 'create'));
$app->put('/api/thread/:id/edit', $authorize, array('\Aotoki\Api\ThreadController', 'update'));
$app->delete('/api/thread/:id', $authorize, array('\Aotoki\Api\ThreadController', 'destroy'));

//API::Post
$app->get('/api/posts', array('\Aotoki\Api\PostController', 'getPosts'));
$app->post('/api/post', $authorize, array('\Aotoki\Api\PostController', 'create'));
$app->put('/api/post/:id/edit', $authorize, array('\Aotoki\Api\PostController', 'update'));
$app->delete('/api/post/:id', $authorize, array('\Aotoki\Api\PostController', 'destroy'));


$app->notFound(function() use ($app) {
  $app->render('404.html');
});
