<? 
require "file_configfile.php";

date_default_timezone_set('Asia/Bangkok'); 
$gNow = date('Y-m-d H:i:s'); 

CallConnection(DatabaseSA,$ConSA); 
$JmlPerPage = 30; 


//TAMBAH FIELD 30-11-2018 
#AddField("tb_biodata","Nma_IstriSuami","varchar(100)","NULL","","Kode_Pos",""); 

#AddField("tb_biodata","Nma_PnggJawab","varchar(100)","NULL","","Nma_IstriSuami",""); 
#AddField("tb_biodata","Hub_PnggJawab","varchar(100)","NULL","","Nma_PnggJawab",""); 
#AddField("tb_biodata","Alm_PnggJawab","varchar(100)","NULL","","Hub_PnggJawab",""); 
#AddField("tb_biodata","Tlp_PnggJawab","varchar(100)","NULL","","Alm_PnggJawab",""); 
#AddField("tb_biodata","Cara_Bayar","varchar(100)","NULL","","Tlp_PnggJawab",""); 
#AddField("tb_biodata","KdBahasa","varchar(5)","NULL","","Cara_Bayar",""); 

//start -------------------------------// tutup klo dh bisa 
/* 
$rSQ = "update ref_tarif_level_4 set JasaSarana='0' where isnull(JasaSarana)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set JasaLayanan='0' where isnull(JasaLayanan)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set Tarif='0' where isnull(Tarif)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set JasaAskep='0' where isnull(JasaAskep)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set BAKHP='0' where isnull(BAKHP)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set JasaAnastesi='0' where isnull(JasaAnastesi)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set tRuangan='0' where isnull(tRuangan)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set tDokter='0' where isnull(tDokter)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set tPerawat='0' where isnull(tPerawat)"; 
$rsT = mysql_query($rSQ); 
$rSQ = "update ref_tarif_level_4 set tGizi='0' where isnull(tGizi)"; 
$rsT = mysql_query($rSQ); 
*/ 
//end -------------------------------// 

//18022017 

/* 
AddField("tb_tr_kunjungan_rinci","Dokter","enum('','Umum','Spesialis')","NULL","","",""); 
AddField("tb_tr_apt_obat_masuk","KdDepo","varchar(6)","NULL","","",""); 
AddField("tb_tr_apt_obat_post","KdDepo","varchar(6)","NULL","","",""); 
AddField("tb_tr_apt_obat_reture","KdDepo","varchar(6)","NULL","","",""); 
AddField("tb_tr_apt_obat_keluar","KdDepo","varchar(6)","NULL","","",""); 
*/ 

function fDisplay($gBR) 
{ 
    echo $gBR."<br>"; 
} 

function fDatePARSE($gTD,$gVe) 
{ 
    $gTF = date_parse($gTD); 
    return $gTF[$gVe]; 
} 

function fMakeKeyTable($nTBL,$DatabaseSA,$ConSA) 
{ 
    $tMX = fGlobal("Max(IDT)",$nTBL,"IDT","%","LIKE","",$DatabaseSA,$ConSA,""); 
    return $tMX+1; 
} 

function fFindTarifKelasPRW($tPR,$tKT,$gKL,$DatabaseSA,$ConSA) 
{ 
    $newTRF=$tPR.$tKT; 
    $tRP = fGlobal($newTRF,"ref_kelas","Kode",$gKL,"=","",$DatabaseSA,$ConSA,""); 
    $gRP = fGlobal("Tarif","ref_tarif_level_4","Kode",$tRP,"=","",$DatabaseSA,$ConSA,""); 
    return $gRP; 
} 

function fFindKdTarifKelasPRW($tPR,$tKT,$gKL,$DatabaseSA,$ConSA) 
{ 
    $newTRF=$tPR.$tKT; 
    $tRP = fGlobal($newTRF,"ref_kelas","Kode",$gKL,"=","",$DatabaseSA,$ConSA,""); 
    $gKD = fGlobal("Kode","ref_tarif_level_4","Kode",$tRP,"=","",$DatabaseSA,$ConSA,""); 
    return $gKD; 
} 

function CheckAdmType($IdL) 
{ 
    $gIdL = base64_decode(base64_decode(base64_decode($_GET['IdL'])));
    $nSQ = "SELECT P1.AdmType, P1.Kd_Ruang_Poli  
    FROM tb_user P1 JOIN tb_user_log P2 ON (P2.User_Id = P1.User_Id) WHERE  P2.IDT='".$gIdL."'";

    $nRs = mysqli_query($GLOBALS['_ConSA'] , $nSQ);
    while ($mRo = mysqli_fetch_array($nRs)) 
    { 
        return $mRo[0]; 
    } 
} 

function CheckKodePoli($IdL) 
{ 
    $gIdL = base64_decode(base64_decode(base64_decode($_GET['IdL']))); 
    $nSQ = "SELECT P1.Kd_Ruang_Poli  
    FROM tb_user P1 JOIN tb_user_log P2 ON (P2.User_Id = P1.User_Id) WHERE  P2.IDT='".$gIdL."'"; 
    $nRs = mysqli_query($GLOBALS['_ConSA'] , $nSQ);
    while ($mRo = mysqli_fetch_array($nRs)) 
    { 
        return $mRo[0]; 
    } 
} 

function fAmbilGetDate($nVr) 
{ 
    if ($nVr!="") 
    { 
        /* 
        [seconds] => 40            Numeric representation of seconds                        : 0 to 59     
        [minutes] => 58            Numeric representation of minutes                        : 0 to 59 
        [hours]   => 21            Numeric representation of hours                            : 0 to 23 
        [mday]    => 17            Numeric representation of the day of the month            : 1 to 31 
        [wday]    => 2            Numeric representation of the day of the week            : 0 (for Sunday) through 6 (for Saturday) 
        [mon]     => 6            Numeric representation of a month                        : 1 through 12 
        [year]    => 2003        A full numeric representation of a year, 4 digits        : Examples: 1999 or 2003 
        [yday]    => 167        Numeric representation of the day of the year            : 0 through 365 
        [weekday] => Tuesday    A full textual representation of the day of the week    : Sunday through Saturday 
        [month]   => June        A full textual representation of a month, such as January or March        : January through December     
        [0]       => 1055901520    Seconds since the Unix Epoch, similar to the values returned by time() and used by date().     : System Dependent, typically -2147483648 through 2147483647.  
        */ 
        $mArr = getdate(); 
        return $mArr[$nVr]; 
    } 
} 

function fBackCLR($tNum) 
{ 
    $tNum = $tNum%2; 
    if ($tNum==0) {return "bgcolor='#F4F1F1'";} 
    if ($tNum!=0) {return "bgcolor='#ffffff'";} 
} 

function fBackCLRfRM($tNum) 
{ 
    $tNum = $tNum%2; 
    if ($tNum==0) {return "background: #F4F1F1";} 
    if ($tNum!=0) {return "background: #ffffff";} 
} 

function fUserType($nX) 
{ 
    $UserType = array ('Creator','Administrator','Admin Unit','Reguler'); 
    return $UserType[$nX]; 
} 

function fMakeReg($gRefVr,$nDgT) 
{ 
    $NewKRg = substr("000000".$gRefVr,-$nDgT,strlen("000000".$gRefVr)); 
    return $NewKRg; 
} 

function fToNum($Angka) 
{ 
    return fConvertToNumeric($Angka); 
} 

function fConvertToNumeric($Angka) 
{ 
    if ($Angka=="") 
    { 
        return 0; 
    } 
    else 
    { 
        $CnvR = str_replace('.', '',$Angka); 
        $CnvR = str_replace(',', '.',$CnvR); 
        return $CnvR; 
    } 
} 

function fHiSplitT2K($DataG,$xChr) 
{ 
    $cTtK=""; 
    foreach (count_chars($DataG, 1) as $i => $val) 
    {if (chr($i)==$xChr) {$cTtK = $val;}} 
    return $cTtK; 
} 

function fGlobal($nFldD,$nTbl,$nFldF,$nSyR,$fArtM,$nOdr,$NmDB,$NmCon,$fShow) 
{ 
    $fGlobal=""; 
    $JmLa=fHiSplitT2K($nFldD,":"); 
    $JmLb=fHiSplitT2K($nFldF,":"); 
     
    $fArtM = str_replace("Like", "LIKE",$fArtM); 
    $fArtM = str_replace("like", "LIKE",$fArtM); 
     
    if ($JmLb > 0 ) 
    { 
        $SxR = explode(':', $nFldF);
        $SyR = explode(':', $nSyR);
        if ($fArtM!="") {$ArT = explode(':', $fArtM);}
        for ($iGL=0; $iGL<=$JmLb; $iGL++) 
        { 
            if ($fArtM!="") {$fOpr=$ArT[$iGL];} else {$fOpr="LIKE";} 
             
            if ($iGL==0) 
            {$zFldF = $SxR[$iGL]." ".$fOpr." '".$SyR[$iGL]."'";} 
            else 
            {$zFldF = $zFldF." AND ".$SxR[$iGL]." ".$fOpr." '".$SyR[$iGL]."'";} 
        } 
    } 
    else 
    { 
        if ($fArtM!="") {$fOpr=$fArtM;} else {$fOpr="LIKE";} 
        $zFldF= $nFldF." ".$fOpr." '".$nSyR."'"; 
    } 
     
    $nFldD = str_replace("IfNull", "IFNULL",$nFldD); 
    $nFldD = str_replace("Ifnull", "IFNULL",$nFldD); 
    $nFldD = str_replace("ifnull", "IFNULL",$nFldD); 
     
    $nFldD = str_replace("sum", "SUM",$nFldD); 
    $nFldD = str_replace("Sum", "SUM",$nFldD); 
     
    $nFldD = str_replace("Count", "COUNT",$nFldD); 
    $nFldD = str_replace("count", "COUNT",$nFldD); 
     
    $nFldD = str_replace("Max", "MAX",$nFldD); 
    $nFldD = str_replace("max", "MAX",$nFldD); 
     
    $nFldD = str_replace("Min", "MIN",$nFldD); 
    $nFldD = str_replace("min", "MIN",$nFldD); 
     
    $nFldD = str_replace("Desc", "DESC",$nFldD); 
    $nFldD = str_replace("desc", "DESC",$nFldD); 

    $nFldD = str_replace("Limit", "LIMIT",$nFldD); 
    $nFldD = str_replace("limit", "LIMIT",$nFldD); 

    if ($nOdr!="") { $nOdr=" ORDER BY ".$nOdr;} 
    if ($JmLa > 0) {$SQGL="SELECT ".str_replace(":", ", ",$nFldD)." FROM ".strtolower($nTbl)." WHERE ".$zFldF.$nOdr;} 
    else {$SQGL="SELECT ".str_replace(":", ", ",$nFldD)." AS FldD FROM ".strtolower($nTbl)." WHERE ".$zFldF.$nOdr;} 
    if ($fShow!="") {echo $SQGL."<br>";} 
    mysqli_select_db($NmCon,$NmDB); 
	//$nRstGlo = mysqli_query($SQGL,$NmCon); 
	$nRstGlo = mysqli_query($NmCon, $SQGL) ; 
    $mRowGlo = mysqli_fetch_assoc($nRstGlo); 
    $tRowGlo = mysqli_num_rows($nRstGlo); 
    if ($tRowGlo > 0) 
    { 
        if ($JmLa > 0) 
        { 
            $Sx=explode(':',$nFldD);
            for ($iGL=0; $iGL<=$JmLa; $iGL++) 
            { 
                if ($iGL==0) 
                    {$zFldD=$mRowGlo[$Sx[$iGL]];} 
                else 
                    {$zFldD=$zFldD.":".$mRowGlo[$Sx[$iGL]];} 
            } 
            return $zFldD; 
        } 
        else 
        { 
            return $mRowGlo['FldD']; 
        } 
    } 
} 

function ChangeNmOrLenghtField($nTBL,$nFLD,$mFLD,$nLHT,$mTYP,$mLHT,$nDEF) 
{ 
    /* 
    nFLD : Nama Field Lama 
    mFLD : Nama Field Baru 
    nLHT : Length Asal 
    mLHT : Length Baru 
    */ 
     
    $iB=0; 
    $nSD=mysqli_query($GLOBALS['_ConSA'], "SELECT * FROM $nTBL LIMIT 0,1");
    while($iB< (($___mysqli_tmp = mysqli_num_fields($nSD)) ? $___mysqli_tmp : false)) 
    { 
        $meta   = (((($___mysqli_tmp = mysqli_fetch_field_direct($nSD, 0)) && is_object($___mysqli_tmp)) ? ( (!is_null($___mysqli_tmp->primary_key = ($___mysqli_tmp->flags & MYSQLI_PRI_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->multiple_key = ($___mysqli_tmp->flags & MYSQLI_MULTIPLE_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->unique_key = ($___mysqli_tmp->flags & MYSQLI_UNIQUE_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->numeric = (int)(($___mysqli_tmp->type <= MYSQLI_TYPE_INT24) || ($___mysqli_tmp->type == MYSQLI_TYPE_YEAR) || ((defined("MYSQLI_TYPE_NEWDECIMAL")) ? ($___mysqli_tmp->type == MYSQLI_TYPE_NEWDECIMAL) : 0)))) && (!is_null($___mysqli_tmp->blob = (int)in_array($___mysqli_tmp->type, array(MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_BLOB, MYSQLI_TYPE_MEDIUM_BLOB, MYSQLI_TYPE_LONG_BLOB)))) && (!is_null($___mysqli_tmp->unsigned = ($___mysqli_tmp->flags & MYSQLI_UNSIGNED_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->zerofill = ($___mysqli_tmp->flags & MYSQLI_ZEROFILL_FLAG) ? 1 : 0)) && (!is_null($___mysqli_type = $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = (($___mysqli_type == MYSQLI_TYPE_STRING) || ($___mysqli_type == MYSQLI_TYPE_VAR_STRING)) ? "type" : "")) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && in_array($___mysqli_type, array(MYSQLI_TYPE_TINY, MYSQLI_TYPE_SHORT, MYSQLI_TYPE_LONG, MYSQLI_TYPE_LONGLONG, MYSQLI_TYPE_INT24))) ? "int" : $___mysqli_tmp->type)) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && in_array($___mysqli_type, array(MYSQLI_TYPE_FLOAT, MYSQLI_TYPE_DOUBLE, MYSQLI_TYPE_DECIMAL, ((defined("MYSQLI_TYPE_NEWDECIMAL")) ? constant("MYSQLI_TYPE_NEWDECIMAL") : -1)))) ? "real" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_TIMESTAMP) ? "timestamp" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_YEAR) ? "year" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && (($___mysqli_type == MYSQLI_TYPE_DATE) || ($___mysqli_type == MYSQLI_TYPE_NEWDATE))) ? "date " : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_TIME) ? "time" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_SET) ? "set" : $___mysqli_tmp->type)) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_ENUM) ? "enum" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_GEOMETRY) ? "geometry" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_DATETIME) ? "datetime" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && (in_array($___mysqli_type, array(MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_BLOB, MYSQLI_TYPE_MEDIUM_BLOB, MYSQLI_TYPE_LONG_BLOB)))) ? "blob" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_NULL) ? "null" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type) ? "unknown" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->not_null = ($___mysqli_tmp->flags & MYSQLI_NOT_NULL_FLAG) ? 1 : 0)) ) : false ) ? $___mysqli_tmp : false); 
        $length = ((($___mysqli_tmp = mysqli_fetch_fields($nSD)) && (isset($___mysqli_tmp[0]))) ? $___mysqli_tmp[0]->length : false); 
        $iB++; 
        if ($meta->name==$nFLD && $length==(int)$nLHT) 
        { 
            $SQD= "ALTER TABLE ".$nTBL." CHANGE COLUMN ".$nFLD." ".$mFLD." ".$mTYP."(".$mLHT.") NULL DEFAULT '".$nDEF."'"; 
            $nRs= mysqli_query($GLOBALS['_ConSA'], $SQD);
        } 
    } 
} 

function AddField($nTbl,$nField,$nType,$nNull,$nDefa,$nAfter,$nIdx) 
{ 
    $JumFld=0; 
    if ($nDefa !="") {$nDefa = "default '".$nDefa."'";} else {$nDefa="default ''";} 
    if ($nAfter!="") {$nAfter= "AFTER ".$nAfter;} else {$nAfter="";} 
     
    $JumFld = HitField($nTbl,$nField); 
    if ($JumFld == 0) 
    { 
        $sqlC="ALTER TABLE ".$nTbl." ADD ".$nField." ".$nType." ".$nNull." ".$nDefa." ".$nAfter; 
        $nRs = mysqli_query($GLOBALS['_ConSA'], $sqlC) or die(mysqli_error($GLOBALS['_ConSA']));
        if ($nIdx==1) 
        { 
            $sqlC="ALTER TABLE ".$nTbl." ADD INDEX ".$nField." (".$nField.")"; 
            $nRs = mysqli_query($GLOBALS['_ConSA'], $sqlC) or die(mysqli_error($GLOBALS['_ConSA']));
        } 
    } 
} 

function HitField($nTbl,$nFild) 
{ 
    $tJm = 0; 
    $nSQ = "SHOW FIELDS FROM ".$nTbl; 
    $nRs = mysqli_query($GLOBALS['_ConSA'], $nSQ) or die(mysqli_error($GLOBALS['_ConSA']));
    $mRo = mysqli_fetch_assoc($nRs); 
    $tRo = mysqli_num_rows($nRs); 
    if ($tRo > 0) 
    { 
        do 
        { 
            if ($mRo['Field']==$nFild) 
            { 
                $tJm++; 
            } 
        } 
        while ($mRo = mysqli_fetch_assoc($nRs));     
    } 
    return $tJm; 
} 

function fBullet($nX) 
{ 
    $NmArr = array ('','-','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','##','I','II','III','IV','V','VI','VII','VIII','IX','X'); 
    return $NmArr[$nX]; 
} 

function datediff($tgl1, $tgl2) 
{ 
    $tgl1 = (is_string($tgl1) ? strtotime($tgl1) : $tgl1); 
    $tgl2 = (is_string($tgl2) ? strtotime($tgl2) : $tgl2); 
    $diff_secs = abs($tgl2-$tgl1); 
    $base_year = min(date("Y", $tgl1), date("Y", $tgl2)); 
    $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year); 
     
    return array(  
    "year" => date("Y", $diff) - $base_year, 
    "month_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, 
    "month" => date("n", $diff) - 1, 
    "day_total" => floor($diff_secs / (3600 * 24)), 
    "day" => date("j", $diff) - 1, 
    "hour_total" => floor($diff_secs / 3600), 
    "hour" => date("G", $diff), 
    "minute_total" => floor($diff_secs / 60), 
    "minute" => (int) date("i", $diff), 
    "second_total" => $diff_secs, 
    "second" => (int) date("s", $diff)."&nbsp; "); 
} 

function HitJmlHari($TG1,$TG2) 
{ 
    $gDT1 = strtotime($TG1); 
    if ($TG2) {$gDT2 = strtotime($TG2);} 
    else {$gDT2 = strtotime(date('Y-m-d'));} 
    $gDff = abs($gDT2-$gDT1); 
    $gJml = $gDff/86400; 
    if ($gJml==0) {$gJml=1;} 
    return $gJml; 
} 

function fToRp($Angka) 
{ 
    return fConvertToRupiah($Angka); 
} 

function fConvertToRupiah($Angka) 
{ 
    return number_format($Angka, 2, ",", "."); 
} 

function fConvertToRupiahBulat($Angka) 
{ 
    return number_format($Angka, 0, ",", "."); 
} 

function fConvertDateShort($mDt) 
{ 
    $mDt = explode("-",$mDt);
    $mD = (int)$mDt[2]; 
    $mB = (int)$mDt[1]; 
    $mT = (int)$mDt[0]; 
    return substr("00".$mD,-2,2)."/".substr("00".$mB,-2,2)."/".$mT; 
} 

function fConvertDateShortStrip($mDt) 
{ 
    $mDt = explode("-",$mDt);
    $mD = (int)$mDt[2]; 
    $mB = (int)$mDt[1]; 
    $mT = (int)$mDt[0]; 
    return substr("00".$mD,-2,2)."-".substr("00".$mB,-2,2)."-".$mT; 
} 

function fConvertDateShortBln($mDt) 
{ 
		  
    //$mDt = explode("-",$mDt); 
    $mDt = explode("-",$mDt); 
    $mD = (int)$mDt[2]; 
    $mB = (int)$mDt[1]; 
    $mT = (int)$mDt[0]; 
    return substr("00".$mD,-2,2)." ".fNmBulanShort($mB)." ".$mT; 
} 

function fConvertDateLongBln($mDt) 
{ 
    $mDt = explode("-",$mDt); 
    $mD = (int)$mDt[2]; 
    $mB = (int)$mDt[1]; 
    $mT = (int)$mDt[0]; 
    return substr("00".$mD,-2,2)." ".fNmBulanLong($mB)." ".$mT; 
} 

function fNmBulanShort($nX) 
{ 
    //$NmBulan = array ('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'); 
    $NmBulan = array ('','JAN','FEB','MAR','APR','MEI','JUN','JUL','AGS','SEP','OKT','NOV','DES'); 
    return $NmBulan[$nX]; 
} 

function fNmBulanLong($nX) 
{ 
    $NmBulan = array ('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'); 
    return $NmBulan[$nX]; 
} 

function fBulanToNumeric($nX) 
{ 
    if (strtolower($nX)=="januari") {return "1";} 
    if (strtolower($nX)=="februari") {return "2";} 
    if (strtolower($nX)=="maret") {return "3";} 
    if (strtolower($nX)=="april") {return "4";} 
    if (strtolower($nX)=="mei") {return "5";} 
    if (strtolower($nX)=="juni") {return "6";} 
    if (strtolower($nX)=="juli") {return "7";} 
    if (strtolower($nX)=="agustus") {return "8";} 
    if (strtolower($nX)=="september") {return "9";} 
    if (strtolower($nX)=="oktober") {return "10";} 
    if (strtolower($nX)=="november") {return "11";} 
    if (strtolower($nX)=="nopember") {return "11";} 
    if (strtolower($nX)=="desember") {return "12";} 
} 

function fTerbilang($angka) 
{ 
    return terbilang($angka)." rupiah"; 
} 
function terbilang($angka) 
{ 
    // pastikan kita hanya berususan dengan tipe data numeric 
    $angka = (float)$angka; 
      
    // array bilangan 
    // sepuluh dan sebelas merupakan special karena awalan 'se' 
    $bilangan = array( 
            '', 
            'satu', 
            'dua', 
            'tiga', 
            'empat', 
            'lima', 
            'enam', 
            'tujuh', 
            'delapan', 
            'sembilan', 
            'sepuluh', 
            'sebelas' 
    ); 
      
    // pencocokan dimulai dari satuan angka terkecil 
    if ($angka < 12) { 
        // mapping angka ke index array $bilangan 
        return $bilangan[$angka]; 
    } else if ($angka < 20) { 
        // bilangan 'belasan' 
        // misal 18 maka 18 - 10 = 8 
        return $bilangan[$angka - 10] . ' belas'; 
    } else if ($angka < 100) { 
        // bilangan 'puluhan' 
        // misal 27 maka 27 / 10 = 2.7 (integer => 2) 'dua' 
        // untuk mendapatkan sisa bagi gunakan modulus 
        // 27 mod 10 = 7 'tujuh' 
        $hasil_bagi = (int)($angka / 10); 
        $hasil_mod = $angka % 10; 
        return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod])); 
    } else if ($angka < 200) { 
        // bilangan 'seratusan' (itulah indonesia knp tidak satu ratus saja? :)) 
        // misal 151 maka 151 = 100 = 51 (hasil berupa 'puluhan') 
        // daripada menulis ulang rutin kode puluhan maka gunakan 
        // saja fungsi rekursif dengan memanggil fungsi terbilang(51) 
        //return sprintf('seratus %s', terbilang($angka - 100))." rupiah"; 
        return sprintf('seratus %s', terbilang($angka - 100)); 
    } else if ($angka < 1000) { 
        // bilangan 'ratusan' 
        // misal 467 maka 467 / 100 = 4,67 (integer => 4) 'empat' 
        // sisanya 467 mod 100 = 67 (berupa puluhan jadi gunakan rekursif terbilang(67)) 
        $hasil_bagi = (int)($angka / 100); 
        $hasil_mod = $angka % 100; 
        return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod))); 
    } else if ($angka < 2000) { 
        // bilangan 'seribuan' 
        // misal 1250 maka 1250 - 1000 = 250 (ratusan) 
        // gunakan rekursif terbilang(250) 
        //return trim(sprintf('seribu %s', terbilang($angka - 1000)))." rupiah"; 
        return trim(sprintf('seribu %s', terbilang($angka - 1000))); 
    } else if ($angka < 1000000) { 
        // bilangan 'ribuan' (sampai ratusan ribu 
        $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif 
        $hasil_mod = $angka % 1000; 
        return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod)); 
    } else if ($angka < 1000000000) { 
        // bilangan 'jutaan' (sampai ratusan juta) 
        // 'satu puluh' => SALAH 
        // 'satu ratus' => SALAH 
        // 'satu juta' => BENAR 
        // @#$%^ WT* 
          
        // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif 
        $hasil_bagi = (int)($angka / 1000000); 
        $hasil_mod = $angka % 1000000; 
        return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod))); 
    } else if ($angka < 1000000000000) { 
        // bilangan 'milyaran' 
        $hasil_bagi = (int)($angka / 1000000000); 
        // karena batas maksimum integer untuk 32bit sistem adalah 2147483647 
        // maka kita gunakan fmod agar dapat menghandle angka yang lebih besar 
        $hasil_mod = fmod($angka, 1000000000); 
        return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod))); 
    } else if ($angka < 1000000000000000) { 
        // bilangan 'triliun' 
        $hasil_bagi = $angka / 1000000000000; 
        $hasil_mod = fmod($angka, 1000000000000); 
        return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod))); 
    } else { 
        return '......'; 
    } 
} 

function SumPembayaPerpoli($rRG,$rNO,$DatabaseSA,$ConSA) 
{ 
    $JmBYR = fGlobal("IfNull(sum(JmlBayar),0)","tb_tr_pembayaran_rinci","Register:Nomor",$rRG.":".$rNO,"=:<>","",$DatabaseSA,$ConSA,""); 
    return $JmBYR; 
} 

function SumTagihanPerpoli($rRG,$DatabaseSA,$ConSA) 
{ 
    $bya01 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_kartu_berobat","Register",$rRG."%","LIKE","",$DatabaseSA,$ConSA,""); 
    $bya01 = $bya01+fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_catatan_medik","Register",$rRG."%","LIKE","",$DatabaseSA,$ConSA,""); 
    $bya02 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_pelayanan_poli","Register",$rRG."%","LIKE","",$DatabaseSA,$ConSA,""); 
    $bya03 = fGlobal("IfNull(sum(TotalTagihan),0)","tb_tr_kunjungan_visite_dokter","Register",$rRG."%","LIKE","",$DatabaseSA,$ConSA,""); 
    $bya04 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_kon","Register",$rRG."%","LIKE","",$DatabaseSA,$ConSA,""); 
    $bya05 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_tindakan","Register",$rRG."%","LIKE","",$DatabaseSA,$ConSA,""); 
    $bya06 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_lab","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya07 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_rad","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya08 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_ele","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya09 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_usg","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya10 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_rhb","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya11 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_bdh","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya12 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_bph","Register",$rRG."%","LIKE","",$DatabaseSA,$ConSA,""); 
    $bya13 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_gzi","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya14 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_med","Register",$rRG."%","LIKE","",$DatabaseSA,$ConSA,""); 
    $bya15 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_ptd","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya16 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_amb","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya17 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_znh","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
    $bya18 = fGlobal("IfNull(sum(Tarif),0)","tb_tr_kunjungan_rinci_apt","Register:Executed",$rRG."%:Y","LIKE:=","",$DatabaseSA,$ConSA,""); 
     
    $byaTG = $bya01+$bya02+$bya03+$bya04+$bya05+$bya06+$bya07+$bya08+$bya09+$bya10+$bya11+$bya12+$bya13+$bya14+$bya15+$bya16+$bya17+$bya18; 
    return $byaTG; 
} 

//echo strtotime("now")."<br>"; 
//echo strtotime("10 September 2000")."<br>"; 
//echo strtotime("+1 day")."<br>"; 
//echo strtotime("+1 year")."<br>"; 
//echo strtotime("+15 year")."<br>"; 
//echo strtotime("+1 week")."<br>"; 
//echo strtotime("+1 week 2 days 4 hours 2 seconds")."<br>"; 
//echo strtotime("next Thursday")."<br>"; 
//echo strtotime("last Monday")."<br>"; 

?>