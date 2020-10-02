<?php
define('HostnameSA','MY-KOMP');
define('DatabaseSA','rsgold');
define('UsernameSA','sa');
define('PasswordSA','simblud');

$serverName = "MY-KOMP";
$connectionInfo = array( "Database"=>"rsgold", "UID"=>"sa", "PWD"=>"simblud");

/*
$ConSA = sqlsrv_connect( $serverName, $connectionInfo);
$GLOBALS['_ConSA'] = $ConSA ;
if($ConSA)
{
	//echo "File koneksi berhasil";
}else
{
	echo "Error: <font color='#FF0000'>Koneksi ke SQL server tidak berhasil...!!</font>";
	exit;;
}

*/


/*
function CallConnection($gDatabase,$gCon)
{
	$SelDA =  mssql_select_db($gDatabase,$gCon);
	if ($SelDA==false)
	{
		echo "Error: DatabaseSQL <font color='#FF0000'><b>".$gDatabase."</b></font> tidak ditemukan...!!";
		exit;
	}
}
CallConnection(DatabaseSA,$ConSA);
*/

?>