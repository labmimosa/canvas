<?php
/*
*********************************************************
* Prepared by: Amalesh Debnath  						*
* Start Date: 24/11/2013 								*
* Purpose: Dynamic SQL Generator						*
* Name: SQL.Class.php									*
*********************************************************
*/

require_once('SQL.Class.php');

$db = new DataHandler;

$dataType = $_REQUEST['dataType'];
if(strcmp($dataType,'posts')==0) {
    $categories = explode(",",$_REQUEST['categories']);
    return getPosts($db,$categories);
}


function getPosts($db,$categories){
    $sql = 'SELECT * FROM  `wp_posts`';
    if(!empty($categories)){
        foreach($categories AS $category){
            if(strpos($sql,'WHERE') === false){
                $sql.="WHERE `post_title` LIKE '".$category."'";
            } else {
                $sql.=" OR `post_title` LIKE '".$category."'";
            }
        }
    }
    return json_encode($db->getSelectData($sql));
}