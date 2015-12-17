<?php

class Group{

	private static function getConnection()
	{
		require_once('bd_connection.php');
		MySQL::GetConnection();
	}

	public static function getAllGroups(){
		self::getConnection();
		$result = mysql_query("SELECT * FROM groups");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getGroupsByUserLogin($_login_user){
		self::getConnection();
		$result = mysql_query("SELECT groups.* FROM groups,user,dl_group_user AS dl WHERE user.login='$_login_user' AND user.id=dl.id_user AND dl.id_group=groups.id");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getGroupById($_id){
		self::getConnection();
		$result = mysql_query("SELECT groups.name AS g_name, user.name AS u_name FROM groups,user WHERE groups.id='$_id' AND groups.id_creator=user.id");
		$row = mysql_fetch_array($result);
		return $row;
	}

	public static function getUsersByIdGroup($_id){
		self::getConnection();
		$result = mysql_query("SELECT user.name FROM groups,user,dl_group_user WHERE groups.id='$_id' AND groups.id=dl_group_user.id_group AND user.id=dl_group_user.id_user");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getUsersIdByIdGroup($_id){
		self::getConnection();
		$result = mysql_query("SELECT user.id FROM groups,user,dl_group_user WHERE groups.id='$_id' AND groups.id=dl_group_user.id_group AND user.id=dl_group_user.id_user");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function checkGroupByName($_name){
		self::getConnection();
		$result = mysql_query("SELECT * FROM groups WHERE name='$_name'");
		$row = mysql_fetch_array($result);
		if($row) return true;
		return false;
	}

	public static function addNewGroup($_name,$_login_user){
		self::getConnection();
		$result = mysql_query("SELECT id FROM user WHERE login='$_login_user'");
		$row = mysql_fetch_array($result);
		$id_user = $row["id"];
		mysql_query("INSERT INTO groups (name,id_creator) VALUES ('$_name','$id_user')");
		$result = mysql_query("SELECT id FROM groups WHERE name='$_name'");
		$row = mysql_fetch_array($result);
		$id_group = $row["id"];
		mysql_query("INSERT INTO dl_group_user (id_group,id_user) VALUES ('$id_group','$id_user')");
		return $id_group;
	}

	public static function getCountTaskByIdGroup($_id){
		self::getConnection();
		$result = mysql_query("SELECT COUNT(id) FROM task WHERE id_group='$_id'");
		$row = mysql_fetch_row($result);
		return $row[0];
	}

	public static function getCountEndTaskByIdGroup($_id){
		self::getConnection();
		$result = mysql_query("SELECT COUNT(id) FROM task WHERE id_group='$_id' AND end_time<=NOW()");
		$row = mysql_fetch_row($result);
		return $row[0];
	}
	public static function getCountStartTaskByIdGroup($_id){
		self::getConnection();
		$result = mysql_query("SELECT COUNT(id) FROM task WHERE id_group='$_id' AND end_time>NOW()");
		$row = mysql_fetch_row($result);
		return $row[0];
	}

	public static function getEndTasksByIdGroup($_id){
		self::getConnection();
		$result = mysql_query("SELECT id AS id_task, name AS task_name FROM task WHERE id_group='$_id' AND end_time<=NOW()");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getStartTasksByIdGroup($_id){
		self::getConnection();
		$result = mysql_query("SELECT id AS id_task, name AS task_name FROM task WHERE id_group='$_id' AND end_time>NOW()");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function checkCreator($_id_group, $_login_user){
		self::getConnection();
		$result = mysql_query("SELECT * FROM groups AS g, user AS u WHERE g.id='$_id_group' AND g.id_creator=u.id AND u.login='$_login_user'");
		if( mysql_fetch_array($result)) return true;
		return false;
	}

	public static function checkGroupForUser($_id_group, $_login_user){
		self::getConnection();
		$result = mysql_query("SELECT * FROM groups AS g, user AS u, dl_group_user AS dl WHERE g.id='$_id_group' AND dl.id_user=u.id AND dl.id_group=g.id AND u.login='$_login_user'");
		if( mysql_fetch_array($result)) return true;
		return false;
	}

	public static function addNewUser($id_group, $login_user){
		self::getConnection();
		$result = mysql_query("SELECT id FROM user WHERE login='$login_user'");
		$row = mysql_fetch_array($result);
		$id_user = $row["id"];
		mysql_query("INSERT INTO dl_group_user (id_group,id_user) VALUES('$id_group','$id_user')");
	}

	public static function deleteUser($id_group, $login_user){
		self::getConnection();
		$result = mysql_query("SELECT id FROM user WHERE login='$login_user'");
		$row = mysql_fetch_array($result);
		$id_user = $row["id"];
		mysql_query("DELETE FROM dl_task_user WHERE id_user='$id_user' AND id_task IN(SELECT id FROM task WHERE id_group='$id_group')");
		mysql_query("DELETE FROM dl_group_user WHERE id_group='$id_group' AND id_user='$id_user'");

	}
}

?>