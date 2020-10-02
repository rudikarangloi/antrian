<?php
date_default_timezone_set('UTC');
$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
$tdata = $sIdc."&".$tStamp;
$signature = hash_hmac('sha256', $tdata, $sKey, true);
$encodedSignature = base64_encode($signature);
?>