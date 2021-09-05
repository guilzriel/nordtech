<?php
/**
 * Didn't have much time to setup a new install of Laravel
 * I'm just getting the most important parts done:
 *
 * 1- call api
 * 2- insert into DB
 * 3- Get from dB
 * 4 - Display in semi-acceptable format
 *
 */

//TODO fill out DB info
$mysql_host = '';
$mysql_user = '';
$mysql_pw = '';
$dbname = '';


require_once('University_domains_and_names_API.php');

$urls = array(
    'Canada',
    'United States'
);



$api = new University_domains_and_names_API($mysql_host, $mysql_user, $mysql_pw, $dbname);

/*
try {
    $json_list_of_universities = $api->get_list_of_universities_from_api($urls);
}catch(Exception $e){
    var_dump($e->getMessage());
    die();
}


$api->insert_list($json_list_of_universities);
*/

$list_of_universities = $api->get_list_of_universities();


//normally would use a view
include_once 'university_view.php';



$api = null;