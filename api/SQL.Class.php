<?php
/*
*********************************************************
* Prepared by: Amalesh Debnath  						*
* Start Date: 24/11/2013 								*
* Purpose: Dynamic SQL Generator						*
* Name: SQL.Class.php									*
*********************************************************
*/

require_once ('sql.lib.php');

class SQL_Query_Generator extends SQL_Command
{
	//variable needed
	var $tableName=""; // variable for table name
	var $attributes=""; // variable for column
	var $whereClause=""; // variable to hold the string of where clasue
	var $orderByClause=""; // variable for holding the order by clause

	//Function to generate SQL
	function selectSQL($table, $attributeList, $whereClause = "", $orderBy = "", $distinct){
        if($distinct==true)
		    $sql = sprintf("SELECT DISTINCT %s FROM %s", implode("," , $attributeList), $table);
		else
		    $sql = sprintf("SELECT %s FROM %s", implode("," , $attributeList), $table);

//        echo $sql."<br>";
		
		if(!empty($whereClause)){ //if there is any where clause
			$sql.=" ".$whereClause;
		}

		if(!empty($orderBy)) { //if any order needed
			$sql.=" ".$orderBy;
		}
//		echo $sql."<br>";
		return $sql;
	}



	//function to get the result;
	function returnResult($sqlQuery)
	{
		//echo $sqlQuery;
		$varGetResult = $this->return_Result($sqlQuery);
		return $varGetResult;
	}

}

class DataHandler extends SQL_Query_Generator
{
    function getSelectData($sqlQuery){
        return $this->returnResult($sqlQuery);
    }

	function getSelectResult($tableName, $attribute, $whereCondition="", $orderCondition="", $distinct=false){
        $sqlQuery = $this->selectSQL($tableName, $attribute, $whereCondition, $orderCondition, $distinct);
	    //echo "<br>".$returnResult."<br>";
		return $this->returnResult($sqlQuery);
    }

    function insertData($tableName, $fieldNames, $values){
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $tableName, implode(", ", $fieldNames), implode(", ", $values));
//		echo "<br>".$sql."<BR>";
		$success = $this->insertValues($sql);
		return $success;
	}

	function updateData($tableName, $values, $whereClause){
		$sql = sprintf("UPDATE %s SET %s WHERE %s", $tableName, implode(", ", $values), $whereClause);
        $success = $this->updateValues($sql);
        return $success;
	}

	function deleteData($tableName, $theKey){
		$sql = sprintf("DELETE FROM %s WHERE %s", $tableName, $theKey);
		//echo "<br>".$sql."<BR>";
		$success = $this->deleteValues($sql);
		return $success;
	}
}
?>