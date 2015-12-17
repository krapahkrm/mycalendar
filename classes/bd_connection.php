<?php
	class MySQL
	{
		static protected $SqlConnection = null;
		static function GetConnection(){
			if(self::$SqlConnection === null)
			{
				if(!@$db = mysql_connect ("localhost:3306","root","Dracon1_"))
				{
					exit('not connect db');
				}
				if(!@mysql_select_db ("mycalendar",$db))
				{
					exit('not select db');
				}
				mysql_set_charset("utf8");
			}
			return self::$SqlConnection=true;
		}
	}

?>