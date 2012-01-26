<?php
/**
 * Fourums
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

class Forums extends ActiveMongo
{
	//資料表欄位
	public $Name; //論壇名稱
	public $Parent; //父論壇
	
	/**
	 * Get Forum
	 * 
	 * @author Aotoki
	 * @param string 論壇ID
	 * @return object|bool
	 */
	
	static public function getForum( $ID, $forumArgs = array() )
	{
		$forum = new Forums;
		$forum->findOne(new MongoId($ID));
		
		array_push($forumArgs, $forum);
		if(isset($forum->Parent)){
			$forumArgs = self::getForum($forum->Parent, $forumArgs);
		}
		sort($forumArgs, SORT_DESC);
		return $forumArgs;
	}
	
	/**
	 * Get Forums
	 * 
	 * @author Aotoki
	 * @param string 父論壇ID
	 * @return object|bool 成功傳回 Forum 物件，失敗傳回 FALSE
	 */
	
	static public function getForums( $parentID = NULL)
	{
		$forums = new Forums;
		$forums->find(array('Parent' => $parentID));
		
		$result = array();
		
		foreach ($forums as $ID => $forum) {
			$lastPost = new Thread;
			$lastPost->sort('timestamp DESC');
			$lastPost->where('forumID',(string) $forum->getID());
			$lastPost->limit(1);
			
			if(!$lastPost->valid()){
				$lastPost = array();
			}else{
				$lastPost = $lastPost->getArray();
			}
			
			$result[] = array(
				'forum' => $forum->getArray(),
				'lastPost' => $lastPost,
			);
			
			unset($lastPost);
		}
		
		return $result;
	}
	
	/**
	 * Create Forum
	 * 
	 * @author Aotoki
	 * @param string 論壇名稱
	 */
	
	static public function createForum($Name, $Parent = NULL)
	{
		$forum = new Forums;
		$forum->Name = $Name;
		if($Parent){
			$forum->Parent = $Parent;
		}
		$forum->save();
		unset($forum);
	}
	
	/**
	 * Delete Forum
	 * 
	 * @author Aotoki
	 * @param string 論壇ID
	 */
	
	static public function deleteForum($forumID)
	{
		
		$parentID = NULL;
		
		$forum = new Forums;
		$forum->findOne(new MongoId($forumID));
		if(isset($forum->Parent)){
			$parentID = $forum->Parent;
		}
		$forum->delete();
		
		$subForums = self::getForums($forumID);
		foreach($subForums as $ID => $forum){
			self::deleteForum($ID);
		}
		
		$topics = new Thread;
		$topics->find(array('forumID' => $forumID));
		foreach($topics as $ID => $topic){
			Thread::deleteTopic($ID);
		}
		
		return $parentID;
	}
	
}
