<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  user.class.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

class User {

	public function LogIn($Email, $Password, $AutoLogin=false, $ZapamtiME, $vratiNaProfil) {
		global $DataBase;
		global $Alert;
		global $User;
		global $Secure;

		$DataBase->Query("SELECT id, Email, Password, reg_token FROM `users` WHERE `Email` = :Email");
		$DataBase->Bind(':Email', $Email);
		$DataBase->Execute();

		$UserData 	= $DataBase->Single();
		$UserCount 	= $DataBase->RowCount();

		//Autologin provera;
		if ($AutoLogin == false) {
			$Provera = md5($Password) == $UserData['Password'];
		} else {
			$Provera = !empty($Password);
		}

		if($UserCount == true && $Provera) {
			$_SESSION['UserLogin']['ID']	 	= $UserData['id'];

			if (!empty($UserData['reg_token'])) {
				if(isset($_COOKIE['accept_cookie']) && $_COOKIE['accept_cookie'] == '1') {
				    if ($ZapamtiME == '1') {
				    	// Get Current date, time
						$current_time = time();

						// Set Cookie expiration for 1 month
						$cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);  // for 1 month

				    	setcookie('member_login', '1', $cookie_expiration_time);
				    	//Set Secure Cookies -> HttpOnly
				    	setcookie('l0g1n', $UserData['reg_token'].'_'.$UserData['id'], $cookie_expiration_time, '/', null, null, TRUE);
				    }
				}
			}

			$Alert->SaveAlert('Welcome!', 'success');
			if (empty($vratiNaProfil) || $vratiNaProfil == '') {
				$rdrNaProf = $User->UserData()['Username'];
			} else {
				// Ako user ne postoji vrati me na moj prof;
				if (empty($User->GetIDuName($vratiNaProfil)['id'])) {
					$rdrNaProf = $User->UserData()['Username'];
				} else {
					$rdrNaProf = $Secure->SecureTxt($vratiNaProfil);
				}
			}
			header('Location: /@'.$rdrNaProf);
			die();
		} else {
			$_SESSION['Email'] = $Secure->SecureTxt($Email);

			$Alert->SaveAlert('You have entered incorrect information. Please try again!', 'error');
			header('Location: /login?rdr='.$rdrNaProf);
			die();
		}
	}

	public function IsLoged() {
		global $User;

		if(isset($_SESSION['UserLogin']['ID']) && !empty($User->UserDataByID($_SESSION['UserLogin']['ID'])['id'])) {
			$return = true;
		} else {
			if (isset($_COOKIE['l0g1n'])) {
				$GetUid = explode('_', $_COOKIE['l0g1n']);
				if (!empty($GetUid[1])) {
					if (!empty($User->UserDataByID($GetUid[1])['id'])) {
						if ($User->UserDataByID($GetUid[1])['reg_token'] == $GetUid[0]) {
							$return = $User->ProduziLogin($GetUid[1]);
						} else {
							$return = false;
						}
					}
				} else {
					$return = false;
				}
			} else {
				$return = false;
			}

			$return = false;
		}

		return $return;
	}

	public function ProduziLogin($uID) {
		global $User;

		if (!empty($uID) && is_numeric($uID)) {
			if (!empty($User->UserDataByID($uID)['id'])) {
				$_SESSION['UserLogin']['ID'] = $uID;
				$return = true;
			} else {
				$return = false;
			}
		}
		
		return $return;
	}

	public function UserData() {
		global $DataBase;

		if(isset($_SESSION['UserLogin'])) {
			$DataBase->Query("SELECT * FROM `users` WHERE `id` = :uID");
			$DataBase->Bind(':uID', $_SESSION['UserLogin']['ID']);
			$DataBase->Execute();

			return $DataBase->Single();
		} else {
			return false;
		}
	}

	public function UserDataByID($uID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `id` = :uID");
		$DataBase->Bind(':uID', $uID);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function RegTokenKeyStatus($Key, $UserID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `id` = :uID AND `reg_token` = :Key");
		$DataBase->Bind(':uID', $UserID);
		$DataBase->Bind(':Key', $Key);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function RegTokenKey($Key, $UserID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `id` = :uID AND `reg_token` = :Key");
		$DataBase->Bind(':uID', $UserID);
		$DataBase->Bind(':Key', $Key);
		$DataBase->Execute();

		return $DataBase->RowCount();
	}

	public function GetIDuName($uName) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `Username` = :uName");
		$DataBase->Bind(':uName', $uName);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function getFullName($uID) {
		global $User;
		global $Secure;

		return $Secure->SecureTxt($User->UserDataByID($uID)['Name'].' '.$User->UserDataByID($uID)['Lastname']);
	}

	public function GetImage($uID) {
		global $User;
		global $Secure;

		$Image = $Secure->SecureTxt($User->UserDataByID($uID)['Image']);
		if (empty($Image)||$Image == '') {
			$Image = 'user/img/default.png';
		} else {
			$Image = $Image;
		}

		return $Image;
	}

	public function UserIDByUsername($Username) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `Username` = :Username");
		$DataBase->Bind(':Username', $Username);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function UserIDByEmail($Email) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `users` WHERE `Email` = :Email");
		$DataBase->Bind(':Email', $Email);
		$DataBase->Execute();

		return $DataBase->Single();
	}

	public function UpdateInformation($Username, $fName, $lName, $Email, $Website, $Image, $userID) {
		global $DataBase;

		$DataBase->Query("UPDATE `users` SET `Username` = :Username, `Email` = :Email, `Name` = :fName, `Lastname` = :lName, `Image` = :Image, `Website` = :Website WHERE `id` = :uID;");
		$DataBase->Bind(':Username', $Username);
		$DataBase->Bind(':Email', $Email);
		$DataBase->Bind(':fName', $fName);
		$DataBase->Bind(':lName', $lName);
		$DataBase->Bind(':Image', $Image);
		$DataBase->Bind(':Website', $Website);
		$DataBase->Bind(':uID', $userID);

		return $DataBase->Execute();
	}

	public function UpdatePassword($nPass, $userID) {
		global $DataBase;

		$DataBase->Query("UPDATE `users` SET `Password` = :Password WHERE `id` = :uID;");
		$DataBase->Bind(':Password', $nPass);
		$DataBase->Bind(':uID', $userID);

		return $DataBase->Execute();
	}


	public function ProfileViews($pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `user_views` WHERE `profile_id` = :pID");
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		return $DataBase->RowCount();
	}

	public function isProfileView($uID, $pID) {
		global $DataBase;

		$DataBase->Query("SELECT * FROM `user_views` WHERE `user_id` = :uID AND `profile_id` = :pID");
		$DataBase->Bind(':uID', $uID);
		$DataBase->Bind(':pID', $pID);
		$DataBase->Execute();

		return $DataBase->RowCount();
	}

	public function addProfileView($uID, $pID) {
		global $DataBase;

		$DataBase->Query("INSERT INTO `user_views` (`id`, `user_id`, `profile_id`, `Date`) VALUES (NULL, :uID, :pID, :Date);");
		$DataBase->Bind(':uID', $uID);
		$DataBase->Bind(':pID', $pID);
		$DataBase->Bind(':Date', date('d.m.Y, H:ia'));
		
		return $DataBase->Execute();
	}

	public function AddNewAccount($fName, $lName, $Username, $Email, $Pass, $regToken) {
		global $DataBase;
	
		$DataBase->Query("INSERT INTO `users` (`id`, `Username`, `Password`, `Email`, `Name`, `Lastname`, `Gender`, `Image`, `Website`, `reg_token`, `reg_status`) VALUES (NULL, :Username, :Pass, :Email, :fName, :lName, '', NULL, NULL, :regToken, '1');");
		$DataBase->Bind(':fName', $fName);
		$DataBase->Bind(':lName', $lName);
		$DataBase->Bind(':Username', $Username);
		$DataBase->Bind(':Email', $Email);
		$DataBase->Bind(':Pass', $Pass);
		$DataBase->Bind(':regToken', $regToken);

		return $DataBase->Execute();
	}











}