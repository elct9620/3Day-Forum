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
	
	$app->render('topic.php', array(
		'postData' => $postData,
	));
	
})->name('Topic');
