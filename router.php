<?php

// Home
$app->get('/', array('\Aotoki\HomeController', 'home'));

//API::Forum
$app->get('/api/forums', array('\Aotoki\Api\ForumController', 'getForums'));
$app->post('/api/forum/new', array('\Aotoki\Api\ForumController', 'create'));
$app->put('/api/forum/edit', array('\Aotoki\Api\ForumController', 'update'));
$app->delete('/api/forum/destroy', array('\Aotoki\Api\ForumController', 'destroy'));

//API::Thread
$app->get('/api/threads', array('\Aotoki\Api\ThreadController', 'getThreads'));
$app->get('/api/thread/:id', array('\Aotoki\Api\ThreadController', 'getThread'));
$app->post('/api/forum/:forumID/thread/new', array('\Aotoki\Api\ThreadController', 'create'));
$app->put('/api/forum/:forumID/threads/:id/edit', array('\Aotoki\Api\ThreadController', 'update'));
$app->delete('/api/forum/:forumID/threads/:id/destroy', array('\Aotoki\Api\ThreadController', 'destroy'));

//API::Post
$app->get('/api/posts', array('\Aotoki\Api\PostController', 'getPosts'));
$app->post('/api/thread/:threadID/post/new', array('\Aotoki\Api\PostController', 'create'));
$app->put('/api/thread/:threadID/post/:id/edit', array('\Aotoki\Api\PostController', 'update'));
$app->delete('/api/thread/:threadID/post/:id/destroy', array('\Aotoki\Api\PostController', 'destroy'));


$app->notFound(function() use ($app) {
  $app->render('404.html');
});
