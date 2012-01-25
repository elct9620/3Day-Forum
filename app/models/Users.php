<?php
/**
 * User Model
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

class Users extends ActiveMongo
{
	//資料表欄位
	public $userID; //使用者編號(Facebook ID)
	public $Nickname; //使用者膩稱
	
	/**
	 * Get User
	 * 
	 * @author Aotoki
	 * @return object|bool 成功傳回 User 物件，失敗則傳回 FALSE
	 */
	
	static public function getUser( $fromUserID = NULL )
	{
		$userID = $fromUserID;
		if(!$userID){
			$FB = new Facebook(array(
				'appId' => FB_APP_ID,
				'secret' => FB_SECRET,
			));
			
			$userID = $FB->getUser();
		}
		
		if(!$userID){
			$app = Slim::getInstance();
			$app->redirect($FB->getLoginUrl());
		}else{
			$user = new Users;
			$user->findOne(array('userID' => $userID));
			if(!$user->valid()){
				$user->userID = $userID;
				$user->save();
			}
			
			if(!$fromUserID){
				$app = Slim::getInstance();
				$app->view()->setData('user', $user);
			}
			return $user;
		}
		
	}
	
}
