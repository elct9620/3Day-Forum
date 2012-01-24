<?php
/**
 * Home
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

$app->get('/(:forumID)', function($forumID = NULL) use ($app){
	
	$user = Users::getUser();
	
	if(!$forumID){
		$app->render('home.php');
	}else{
		$subForums = Forums::getForums($forumID);
		$threads = Thread::getThreads($forumID);
		$app->render('forum.php', array(
			'subForums' => $subForums,
			'threads' => $threads,
		));
	}
})->name('Home');
