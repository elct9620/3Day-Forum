<?php
/**
 * User Model
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

class User extends ActiveMongo
{
	public $userID;
	public $nickname;
	
	/**
	 * Auth User
	 * 
	 * @author Aotoki
	 * @return object|bool 成功傳回 User 物件，失敗則傳回 FALSE
	 */
	
	static public function authUser()
	{
		$FB = new Facebook(array(
			'appId' => FB_APP_ID,
			'secret' => FB_SECRET,
		));
		
		$userID = $FB->getUser();
		if(!$userID){
			$app = Slim::getInstance();
			$app->redirect($FB->getLoginUrl());
		}else{
			$user = new User;
			$user->findOne(array('userID' => $userID));
			if(!$user->valid()){
				$user->userID = $userID;
				$user->save();
			}
			
			return $user;
		}
		
	}
	
}
