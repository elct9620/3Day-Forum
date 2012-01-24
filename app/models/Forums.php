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
	 * Get Forums
	 * 
	 * @author Aotoki
	 * @param string 父論壇ID
	 * @return object|bool 成功傳回 Forum 物件，失敗傳回 FALSE
	 */
	
	static public function getForums( $parentID = NULL)
	{
		$forum = new Forums;
		$forum->reset();
		$forum->find(array('Parent' => $parentID));
		return $forum;
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
	
}
