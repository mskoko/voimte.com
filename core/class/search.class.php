<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  search.class.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

class Search {

	public function UserSearch($sText) {
		global $DataBase;

		$GetName 		= explode(' ', $sText);
		if (isset($GetName[0]) && !empty($GetName[0])) {
			$fName  	= ''.$GetName[0].'%';
		} else {
			$fName 		= '';
		}

		if (isset($GetName[1]) && !empty($GetName[1])) {
			$lName  	= ''.$GetName[1].'%';
		} else {
			$lName 		= '';
		}

		$Username 		= ''.$sText.''; 

		$DataBase->Query("SELECT `id`, `Username`, `Name`, `Lastname` FROM `users` WHERE `Name` LIKE :fName AND `Lastname` LIKE :lName OR `Username` = :Username LIMIT 10");
		$DataBase->Bind(':fName', $fName);
		$DataBase->Bind(':lName', $lName);
		$DataBase->Bind(':Username', $Username);

		$DataBase->Execute();

		$NapraviARR = array(
			'Count' => $DataBase->RowCount(),
			'Response' => $DataBase->ResultSet()
		);

		return $NapraviARR;
	}


	//Search by Category, Hastags, GeoLocation and etc..

















}