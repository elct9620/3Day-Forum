<?php

// Home
$app->get('/', array('\Aotoki\HomeController', 'home'));

//API::Forum
$app->get('/api/forums', array('\Aotoki\Api\ForumController', 'getForums'));
$app->get('/api/forum/:forumID/childs', array('\Aotoki\Api\ForumController', 'getChildForums'));
$app->get('/api/forum/new', array('\Aotoki\Api\ForumController', 'create'));
$app->get('/api/forum/edit', array('\Aotoki\Api\ForumController', 'update'));
$app->get('/api/forum/destroy', array('\Aotoki\Api\ForumController', 'destroy'));

//API::Thread
$app->get('/api/forum/:forumID/threads(/:page)', array('\Aotoki\Api\ThreadController', 'getThreads'));
$app->get('/api/forum/:forumID/thread/:id', array('\Aotoki\Api\ThreadController', 'getThread'));
$app->post('/api/forum/:forumID/thread/new', array('\Aotoki\Api\ThreadController', 'create'));
$app->post('/api/forum/:forumID/threads/:id/edit', array('\Aotoki\Api\ThreadController', 'update'));
$app->get('/api/forum/:forumID/threads/:id/destroy', array('\Aotoki\Api\ThreadController', 'destroy'));

//API::Post
$app->get('/api/thread/:threadID/posts/(/:page)', array('\Aotoki\Api\PostController', 'getPosts'));
$app->post('/api/thread/:threadID/post/new', array('\Aotoki\Api\PostController', 'create'));
$app->post('/api/thread/:threadID/post/:id/edit', array('\Aotoki\Api\PostController', 'update'));
$app->get('/api/thread/:threadID/post/:id/destroy', array('\Aotoki\Api\PostController', 'destroy'));


$app->notFound(function() use ($app) {
  $app->render('404.html');
});
