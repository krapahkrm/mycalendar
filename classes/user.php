<?php
	class User{
		private $id;
		private $email;
		private $name;
		private $password;

		public static function check_user($_login, $_hash){
			require_once('bd_connection.php');
			MySQL::GetConnection();
			$result = mysql_query("SELECT * FROM user WHERE login='$_login' AND hash='$_hash'");
			$myrow = mysql_fetch_array($result);
			if (empty($myrow['id']))
		    {
			    return false;
		    }
		    return true;
		}

		public static function check_user_by_login($_login){
			require_once('../classes/bd_connection.php');
			MySQL::GetConnection();
			$result = mysql_query("SELECT * FROM user WHERE login='$_login'");
			$myrow = mysql_fetch_array($result);
			if (empty($myrow['id']))
		    {
			    return false;
		    }
		    return true;
		}

		public static function check_user_by_email($_email){
			require_once('../classes/bd_connection.php');
			MySQL::GetConnection();
			$result = mysql_query("SELECT * FROM user WHERE email='$_email'");
			$myrow = mysql_fetch_array($result);
			if (empty($myrow['id']))
		    {
			    return false;
		    }
		    return true;
		}

		public static function check_user_by_password($_login, $_password){
			require_once('../classes/bd_connection.php');
			MySQL::GetConnection();
			$result = mysql_query("SELECT * FROM user WHERE login='$_login' AND password='$_password'");
			$myrow = mysql_fetch_array($result);
			if (empty($myrow['id']))
		    {
			    return false;
		    }
		    return true;
		}

		public static function getHash($_login){
			require_once('../classes/bd_connection.php');
			MySQL::GetConnection();
			$new_hash = self::generateHash();
			mysql_query("UPDATE user SET hash='$new_hash'");
			return $new_hash;
		}

		public static function add_new_user($_login, $_password, $_name, $_email){
			require_once('../classes/bd_connection.php');
			MySQL::GetConnection();
			$new_hash = self::generateHash();
			mysql_query("INSERT INTO user (login, password,name,email,hash) VALUES ('$_login','$_password','$_name','$_email','$new_hash')");
		}

		private static function generateHash(){
			return "yeah";
		}

		private static function cryptPassword($_password){
			return $_password;
		}

		private static function encryptPassword($_password){
			return $_password;
		}

		public static function getName($_login){
			require_once('../classes/bd_connection.php');
			MySQL::GetConnection();
			$result = mysql_query("SELECT * FROM user WHERE login='$_login'");
			$myrow = mysql_fetch_array($result);
			$name = $myrow['name'];
			return $name;
		}

		public static function update_user($_login,$_hash,$_name,$_password)
		{
			if(self::check_user($_login,$_hash))
			{
				require_once('../classes/bd_connection.php');
				MySQL::GetConnection();
				$_password = self::cryptPassword($_password);
				mysql_query("UPDATE user SET name='$_name',password='$_password' WHERE login='$_login'");
				return true;
			}
			else
			{
				return false;
			}
		}
	}
?>