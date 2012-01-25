<?php
/**
 * Profile
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

$app->map('/profile', function() use ($app){
	
	$user = Users::getUser();
	
	if($app->request()->getMethod() == 'POST'){
		$nickname = $app->request()->post('Nickname');
		$user->Nickname = htmlspecialchars($nickname);
		$user->save();
	}
	
	$app->render('profile.php');
	
})->via('GET', 'POST')->name('Profile');
