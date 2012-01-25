<?php
/**
 * Post
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

$app->get('/view/:threadID', function ($threadID) use ($app){
	
	$user = Users::getUser();
	
	$postData = Thread::getTopic($threadID);
	$currentForum = Forums::getForum($postData['thread']['forumID']);
	
	$app->render('topic.php', array(
		'threadID' => $threadID,
		'forumTree' => $currentForum,
		'postData' => $postData,
	));
	
})->name('Topic');

$app->map('/create/:forumID', function($forumID) use ($app){
	
	$user = Users::getUser();
	$reqMethod = $app->request()->getMethod();
	
	switch($reqMethod){
		
		case 'GET':
			$currentForum = Forums::getForum($forumID);
			$app->render('createTopic.php', array('forumTree' => $currentForum));
			break;
		case 'POST':
			
			$postName = $app->request()->post('postName');
			$postContent = $app->request()->post('postContent');
			
			if($postName && $postContent){
				$threadID = Thread::createTopic($postName, $postContent, $forumID, $user->userID);
				$app->redirect($app->urlFor('Topic', array('threadID' => $threadID)));
			}
			
			$app->redirect($app->urlFor('createTopic', array('forumID' => $forumID)));
			
			break;
		default:
			$app->redirect($app->urlFor('Home', array('forumID' => $forumID)));
	}
	
})->via('GET', 'POST')->name('createTopic');

$app->post('/reply/:threadID', function($threadID) use ($app){
	
	$user = Users::getUser();
	
	$postName = $app->request()->post('postName');
	$postContent = $app->request()->post('postContent');
	
	if($postContent){
		Posts::createReply($postContent, $threadID, $user->userID, $postName);
	}
	
	$app->redirect($app->urlFor('Topic', array('threadID' => $threadID)));
	
})->name('replyTopic');