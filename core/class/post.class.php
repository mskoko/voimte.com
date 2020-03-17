<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  post.class.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


class Post {

	public function Feed() {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `voimte_post` ORDER by `id` DESC");
		$DataBase->Execute();

		return $DataBase->ResultSet();
	}

	public function Posts($userID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `voimte_post` WHERE `profile_id` = :uID ORDER by `id` DESC");
		$DataBase->Bind(':uID', $userID);
		$DataBase->Execute();

		return $DataBase->ResultSet();
	}

	public function PostByID($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `voimte_post` WHERE `id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function editPost($pMsg, $userID, $postID) {
		global $DataBase;

		$DataBase->Query("UPDATE `voimte_post` SET `p_text` = :pMsg WHERE `id` = :postID AND `user_id` = :userID");
		$DataBase->Bind(':pMsg', $pMsg);
		$DataBase->Bind(':postID', $postID);
		$DataBase->Bind(':userID', $userID);

		return $DataBase->Execute();
	}

	public function AddProfileMsg($ProfileID, $userID, $VoimTe, $pAudio, $Annon, $fInfo=NULL) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `voimte_post` (`id`, `profile_id`, `user_id`, `p_text`, `p_audio`, `fInfo`, `Annon`, `Date`) VALUES (NULL, :pID, :uID, :pText, :pAudio, :fInfo, :Annon, :Date);");
		$DataBase->Bind(':pID', $ProfileID);
		$DataBase->Bind(':uID', $userID);
		$DataBase->Bind(':pText', $VoimTe);
		$DataBase->Bind(':pAudio', $pAudio);
		$DataBase->Bind(':Annon', $Annon);
		$DataBase->Bind(':fInfo', $fInfo);
		$DataBase->Bind(':Date', date('d.m.Y, H:ia'));

		return $DataBase->Execute();
	}

	public function PostLikes($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `voimte_post_like` WHERE `post_id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();
		
		return $DataBase->RowCount();
	}

	public function isLikePost($pID, $uID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `voimte_post_like` WHERE `post_id` = :pID AND `user_id` = :uID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Bind(':uID', $uID);
		$DataBase->Execute();
		
		return $DataBase->RowCount();
	}

	public function addLikePost($pID, $uID) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `voimte_post_like` (`id`, `post_id`, `user_id`, `Date`) VALUES (NULL, :pID, :uID, :Date);");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Bind(':uID', $uID);
		$DataBase->Bind(':Date', date('d.m.Y, H:ia'));
		
		return $DataBase->Execute();
	}

	public function RemoveLikePost($pID, $uID) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `voimte_post_like` WHERE `post_id` = :pID AND `user_id` = :uID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Bind(':uID', $uID);
		
		return $DataBase->Execute();
	}

	public function PostsCountByUserID($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `voimte_post` WHERE `profile_id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		return $DataBase->RowCount();
	}

	public function delPost($userID, $postID) {
		global $DataBase;

		$DataBase->Query("DELETE FROM `voimte_post` WHERE `id` = :postID AND `user_id` = :userID");
		$DataBase->Bind(':postID', $postID);
		$DataBase->Bind(':userID', $userID);

		return $DataBase->Execute();
	}

	public function LoveAnimation($Msg)	{
		/*
			Auto detect key 'love'
			1. love 			= Heart animation
		*/
		$Msg = str_replace('love', '<span id="is_anim" onclick="love_anim()"></span><b id="love">love</b>', $Msg);

		return $Msg;
	}

	//Vrati count -- Koliko je puta ukucna rec 'Love'
	public function LoveHeartCount($Msg) {
		$array = explode(' ', $Msg);

		$br=1;
		$arr2 = array();
		foreach ($array as $k => $v) {
			//echo $v.'<br>';
			
			if(strspn('love', $v)) {
    			$arr2[] = $v;
			}
		}

		//print_r($arr2);
		return count($arr2);
	}

}