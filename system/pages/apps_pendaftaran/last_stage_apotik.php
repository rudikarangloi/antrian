<?php
 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";

include "mysql_connect.php";	

$loket = $_POST['loket'];
$date = date("Y-m-d");


/*SQL SERVER*/
/*
$SQL = " SELECT Max(id) as id FROM data_antrian WHERE counter='".$loket."' ";
$mRs = mssql_query($SQL);
$mRo = mssql_fetch_array($mRs);
$tRo = mssql_num_rows($mRs);
if ($tRo==0){		
	$id=0;
	//-->$data = array('next' => 0);
}else{
	$id=$mRo[0];
	//-->$data = array('next' => $id);
}
mssql_close($ConSA);
*/


/*MYSQL SERVER*/
//$results = $mysqli->query('SELECT Max(id) as id FROM data_antrian WHERE counter='.$loket.'');
//Jika nomor antrian per loket
//$results = $mysqli->query('SELECT count(*) as id FROM data_antrian WHERE counter='.$loket.$filter_waktu.' ORDER by id');
//Jika nomor antrian tidak per loket



$results = $mysqli->query('SELECT count(*) as id FROM data_antrian_apotik WHERE id '.$filter_waktu.' ORDER by id');

$row = $results->fetch_array();
if ($row['id'] == NULL) {
    $data = array('next' => 0);
} else {
    $data = array('next' => $row['id']);
}
echo json_encode($data);
include 'mysql_close.php';

?>