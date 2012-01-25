<?php
/**
 * Thread
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

class Thread extends ActiveMongo
{
	//資料表欄位
	public $Name; //主題
	public $forumID; //所在論壇
	public $postID; //對應文章
	public $userID; //發文者ID
	public $timestamp; //發文時間
	
	/**
	 * Get Threads
	 * 
	 * @author Aotoki
	 * @param string 論壇ID
	 * @return array
	 */
	
	static public function getThreads($forumID)
	{
		$threads = new Thread;
		$threads->where(array('forumID' => $forumID));
		$threads->sort('timestamp DESC');
		
		$result = array();
		
		foreach ($threads as $thread) {
			$user = new Users;

			if(!isset($thread->userID)){
				$thread->userID = 0;
			}
			$user->findOne(array('userID' => $thread->userID));
			if($user->valid()){
				if(!isset($user->Nickname)){
					$user->Nickname = 'Anonymous';
				}
				$result[] = array(
					'thread' => $threads->getArray(),
					'user' => $user->getArray(),
				);
			}else{
				$result[] = array(
					'thread' => $thread->getArray(),
					'user' => NULL
				);
			}
			unset($user);
		}
		
		return $result;
	}
	
	/**
	 * Create Topic
	 * 
	 * @author Aotoki
	 * @param string 主題名稱
	 * @param string 主題內容
	 * @param string 論壇ID
	 * @param int 使用者ID
	 * @return string 文章ID
	 */
	
	static public function createTopic($Name, $Content, $forumID, $userID)
	{
		$currentTime = time();
		
		$thread = new Thread;
		$thread->Name = $Name;
		$thread->forumID = $forumID;
		$thread->userID = $userID;
		$thread->timestamp = $currentTime;
		$thread->save();
		
		$post = new Posts;
		$post->Name = $Name;
		$post->Content = $Content;
		$post->userID = $userID;
		$post->threadID = $thread->getID();
		$post->timestamp = $currentTime;
		$post->save();
		
		$thread->postID = $post->getID();
		$thread->save();
		
		return $thread->getID();
	}
	
	/**
	 * Get Topic
	 * 
	 * @author Aotoki
	 * @param string 主題ID
	 * @return array|bool
	 */
	
	static public function getTopic( $threadID )
	{
		$thread = new Thread;
		$thread->findOne(new MongoId($threadID));
		
		if(!$thread->valid()){
			return FALSE;
		}
		
		$mainPost = new Posts;
		$mainPost->findOne(new MongoId($thread->postID));
		
		if($mainPost->valid()){
			$posts = new Posts;
			$posts->find(array('threadID' => $threadID));
			
			$postData = array();
			
			if($posts->valid()){
				foreach($posts as $post) {
					$user = new Users;
					$user->findOne(array('userID' => $post->userID));
					
					$postData[] = array(
						'post' => $post->getArray(),
						'user' => $user->getArray(),
					);
					
				}
			}
			
			$user = new Users;
			$user->findOne(array('userID' => $thread->userID));
			
			return array(
				'thread' => $thread->getArray(),
				'post' => $mainPost->getArray(),
				'user' => $user->getArray(),
				'posts' => $postData,
			);
			
		}
		
		return FALSE;
	}
}
