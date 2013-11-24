<?php
require_once 'DbConnect.php';

class SQL_Command extends DbConnect{

//$db = new DbConnect;

    function return_Result($query=""){
        $resultSet = array();
        $dbLink = $this->connectDb();
        $this->select_db($dbLink);

        if(!empty($query)){
            $result = mysql_query($query);
            if (!$result) {
                echo "Could not successfully run query ($sql) from DB: " . mysql_error();
                exit;
            }

            if (mysql_num_rows($result) == 0) {
                echo "No rows found, nothing to print so am exiting";
                exit;
            }

            while ($row = mysql_fetch_assoc($result)) {
                $resultSet[] = $row;
            }

            mysql_free_result($result);
        }
        $this->closeConnection($dbLink);
        return $resultSet;
    }

    function insertValues($sql_cmd){
            //echo "<br>".$sql_cmd."<BR>";
            $dbLink = $this->connectDb();
            $this->select_db($dbLink);
            if(!empty($sql_cmd)){
                $Result = mysql_query($sql_cmd, $dbLink);
                mysql_close($dbLink);
                if ($Result){
                    return true;
                }
                else{
                    return false;
                }
            }

    }

	function updateValues($sql_cmd){
		
			$dbLink = $this->connectDb();
			$this->select_db($dbLink);
			if(!empty($sql_cmd)){
				$Result = mysql_query($sql_cmd, $dbLink) or trigger_error(mysql_error());
				mysql_close($dbLink);
				if ($Result){
					return true;
				}
				else{
					return false;
				}
			
			}
	

	}

	function deleteValues($sql_cmd){
		$dbLink = $this->connectDb();
		$this->select_db($dbLink);
		if(!empty($sql_cmd)){
			//echo $sql_cmd;
			$Result = mysql_query($sql_cmd, $dbLink);
			mysql_close($dbLink);
			if($Result==true){
				//echo "yes";
				return true;
			}
			else{
				return false;
			}
		}

	}
}
?>
