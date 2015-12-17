<?php

class Task{

	private static function getConnection()
	{
		require_once('bd_connection.php');
		MySQL::GetConnection();
	}
	public static function getTaskById($_id){
		self::getConnection();
		$result = mysql_query("SELECT t.name AS task_name, t.description AS task_desc, t.start_time AS task_start, t.end_time AS task_end, u.name AS creator FROM task AS t, user AS u WHERE t.id='$_id' AND t.id_creator=u.id");
		$row = mysql_fetch_array($result);
		return $row;
	}

	public static function getUsersById($_id){
		self::getConnection();
		$result = mysql_query("SELECT u.name AS name  FROM user AS u, task AS t, dl_task_user AS dl WHERE t.id=$_id AND dl.id_task=t.id AND dl.id_user=u.id");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function addNewTask($name, $desc, $start, $end, $login_user, $group){
		self::getConnection();
		$id_creator = mysql_query("SELECT id FROM user WHERE login='$login_user'");
		$id_creator = mysql_fetch_array($id_creator);
		$id_creator = $id_creator["id"];
		mysql_query("INSERT INTO task (name,description,start_time,end_time,id_creator,id_group) VALUES ('$name','$desc','$start','$end','$id_creator','$group')");
		$id_task = mysql_query("SELECT MAX(id) AS max FROM task WHERE name='$name'");
		$id_task = mysql_fetch_array($id_task);
		$id_task = $id_task["max"];
		require_once('group.php');
		$users = Group::getUsersIdByIdGroup($group);
		for($i=0;$i<count($users);$i++)
		{
			mysql_query("INSERT INTO dl_task_user (id_task,id_user) VALUES ('$id_task','".$users[$i]['id']."')");
		}
		return $id_task;
	}

	public static function addNewTaskForMe($name, $desc, $start, $end, $login_user){
		self::getConnection();
		$id_creator = mysql_query("SELECT id FROM user WHERE login='$login_user'");
		$id_creator = mysql_fetch_array($id_creator);
		$id_creator = $id_creator["id"];
		mysql_query("INSERT INTO task (name,description,start_time,end_time,id_creator,id_group,cancel) VALUES ('$name','$desc','$start','$end','$id_creator',NULL,NULL)");
		$id_task = mysql_query("SELECT MAX(id) AS max FROM task WHERE name='$name'");
		$id_task = mysql_fetch_array($id_task);
		$id_task = $id_task["max"];
		mysql_query("INSERT INTO dl_task_user (id_task, id_user) VALUES ('$id_task','$id_creator')");
		return $id_task;
	}

	public static function getAllTasks(){
		self::getConnection();
		$result = mysql_query("SELECT * FROM task WHERE end_time>NOW() AND id_group IS NULL");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getMyTasks($login_user){
		self::getConnection();
		$result = mysql_query("SELECT task.* FROM task,user,dl_task_user AS dl WHERE end_time>NOW() AND id_group IS NULL AND task.id=dl.id_task AND dl.id_user=user.id AND login='$login_user'");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function isMyTask($id_task, $login_user){
		self::getConnection();
		$result = mysql_query("SELECT COUNT(dl_task_user.id) FROM dl_task_user,user WHERE id_task='$id_task' AND id_user=user.id AND login='$login_user'");
		$row = mysql_fetch_row($result);
		return !$row[0]==0;
	}

	public static function addTaskToMe($id_task, $login_user){
		self::getConnection();
		$id_creator = mysql_query("SELECT id FROM user WHERE login='$login_user'");
		$id_creator = mysql_fetch_array($id_creator);
		$id_creator = $id_creator["id"];
		mysql_query("INSERT INTO dl_task_user (id_task,id_user) VALUES ('$id_task','$id_creator')");
	}

	public static function getInProcessTasks($login_user){
		self::getConnection();
		$result = mysql_query("SELECT task.id AS id_task, task.name AS name_task FROM task,user,dl_task_user AS dl WHERE end_time>NOW() AND id_group IS NULL AND task.id=dl.id_task AND dl.id_user=user.id AND login='$login_user' AND cancel IS NULL");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getCancelledTasks($login_user){
		self::getConnection();
		$result = mysql_query("SELECT task.id AS id_task, task.name AS name_task FROM task,user,dl_task_user AS dl WHERE end_time>NOW() AND id_group IS NULL AND task.id=dl.id_task AND dl.id_user=user.id AND login='$login_user' AND cancel IS NOT NULL");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getFinishedTasks($login_user){
		self::getConnection();
		$result = mysql_query("SELECT task.id AS id_task, task.name AS name_task FROM task,user,dl_task_user AS dl WHERE end_time<=NOW() AND id_group IS NULL AND task.id=dl.id_task AND dl.id_user=user.id AND login='$login_user'");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getInProcessTasksForGroup($login_user){
		self::getConnection();
		$result = mysql_query("SELECT task.id AS id_task, task.name AS name_task FROM task,user,dl_task_user AS dl WHERE end_time>NOW() AND id_group IS NOT NULL AND task.id=dl.id_task AND dl.id_user=user.id AND login='$login_user' AND cancel IS NULL");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getCancelledTasksForGroup($login_user){
		self::getConnection();
		$result = mysql_query("SELECT task.id AS id_task, task.name AS name_task FROM task,user,dl_task_user AS dl WHERE end_time>NOW() AND id_group IS NOT NULL AND task.id=dl.id_task AND dl.id_user=user.id AND login='$login_user' AND cancel IS NOT NULL");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function getFinishedTasksForGroup($login_user){
		self::getConnection();
		$result = mysql_query("SELECT task.id AS id_task, task.name AS name_task FROM task,user,dl_task_user AS dl WHERE end_time<=NOW() AND id_group IS NOT NULL AND task.id=dl.id_task AND dl.id_user=user.id AND login='$login_user'");
		$output = array();
		while($row = mysql_fetch_array($result)){
  			$output[] = $row;
		}
		mysql_free_result($result);
		return $output;
	}

	public static function isCancel($id_task, $login_user){
		self::getConnection();
		$result = mysql_query("SELECT COUNT(dl_task_user.id) FROM dl_task_user,user,task WHERE id_task='$id_task' AND id_user=user.id AND login='$login_user' AND id_task=task.id AND cancel IS NULL");
		$row = mysql_fetch_row($result);
		return $row[0]==0;
	}

	public static function cancelTask($id_task, $login_user){
		self::getConnection();
		mysql_query("UPDATE task SET cancel=0 WHERE id='$id_task'");
	}
}

?>