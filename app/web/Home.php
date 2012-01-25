<?php
/**
 * Home
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

$app->map('/(:forumID)(/:action)', function($forumID = NULL, $action = NULL) use ($app){
	
	$user = Users::getUser();
	
	if($action == 'DELETE'){
		if(isset($user->Type) && intval($user->Type) === 1){
			$parent = Forums::deleteForum($forumID);
			$app->redirect($app->urlFor('Home', array('forumID' => $parent)));
		}
	}
	
	if($forumName = $app->request()->post('forumName')){
		if(isset($user->Type) && intval($user->Type) === 1){
			Forums::createForum($forumName, $forumID);
		}
	}
	
	if(!$forumID){
		$app->render('home.php');
	}else{
		$subForums = Forums::getForums($forumID);
		$threads = Thread::getThreads($forumID);
		$currentForum = Forums::getForum($forumID);
		$app->render('forum.php', array(
			'forumID' => $forumID,
			'forumTree' => $currentForum,
			'subForums' => $subForums,
			'threads' => $threads,
		));
	}
})->via('GET', 'POST')->name('Home');
