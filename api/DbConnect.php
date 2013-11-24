<?php 
/*
*********************************************************
* Prepared by: Amalesh Debnath						    *
* Date: 24/11/2013 										*
* Purpose: To open and close database connection		*
*********************************************************
*/
class DbConnect{
		var $theDbConnect = "";
		
		//default constructor
		
		var $theHost = "localhost";
		var $theUser = "root";
		var $thePassword = "";
		var $theDatabase = "canvas";
		
		//function to connect to database server
		function connectDb(){
            $theDbConnect = mysql_pconnect($this->theHost, $this->theUser, $this->thePassword) or trigger_error(mysql_error());
            return $theDbConnect;
		}

		//function to close connection
		function closeConnection($dbconn){
			mysql_close($dbconn);
		}
		
		function select_db ($hostLink){
		    mysql_select_db($this->theDatabase, $hostLink);
		}
	}
?>