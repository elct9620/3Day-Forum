<?php
/**
 * Posts
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

class Posts extends ActiveMongo
{
	//資料表欄位
	public $Name; //文章名稱
	public $Content; //文章內容
	public $threadID; //目標文章
	public $userID; //發文者
	public $timestamp; //發文時間
	
	/**
	 * Create Reply
	 * 
	 * @author Aotoki
	 * @param string 回覆內容
	 * @param string 主題ID
	 * @param int 使用者ID
	 * @param string 主題
	 */
	
	static public function createReply($Content, $threadID, $userID, $Name = NULL)
	{
		$post = new Posts;
		$post->Content = $Content;
		$post->userID = $userID;
		$post->threadID = $threadID;
		if($Name){
			$post->Name = $Name;
		}
		$post->timestamp = time();
		$post->save();
		unset($post);
	}
	
	/**
	 * Delete Reply
	 * 
	 * @author Aotoki
	 * @param string 文章ID
	 * @return string 主題ID
	 */
	
	static public function deleteReply($postID)
	{
		$post = new Posts;
		$post->findOne(new MongoId($postID));
		$threadID = $post->threadID;
		$post->delete();
		
		return $threadID;
	}
	
}
