<?php
/**
 * Post
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

$app->get('/view/:threadID(/:action)', function ($threadID, $action = NULL) use ($app){
	
	$user = Users::getUser();
	
	$postData = Thread::getTopic($threadID);
	$currentForum = Forums::getForum($postData['thread']['forumID']);
	
	if($action == 'DELETE'){
		if(isset($user->Type) && intval($user->Type) === 1){
			Thread::deleteTopic($threadID);
			$app->redirect($app->urlFor('Home', array('forumID' => $postData['thread']['forumID'])));
		}
	}
	
	$app->render('topic.php', array(
		'threadID' => $threadID,
		'forumTree' => $currentForum,
		'postData' => $postData,
		'admUser' => (isset($user->Type) && intval($user->Type) === 1),
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

$app->get('/del/:postID', function($postID) use ($app){
	
	$user = Users::getUser();
	if(isset($user->Type) && intval($user->Type) === 1){
		$threadID = Posts::deleteReply($postID);
		$app->redirect($app->urlFor('Topic', array('threadID' => $threadID)));
	}
	
})->name('delPost');
