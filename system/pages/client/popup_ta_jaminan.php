<?php
//require "connfile-php7.php";
require "functionfile-php7.php";
include "../apps/mysql_connect.php";

extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
if (!isset($gDrP)){$gDrP="All";}

if ($gDrP=="All"){$gDrP="%";}
#echo $crt."<br>";
$SyT = "";
#echo $gDrP;
if ($FnD!="" || $gDrP!="")
{
	
	if ($crt=="JmNK"){
		$SrT="";
		if ($gDrP=="1"){$SrT="FS_KD_JAMINAN ='001' AND";}
		if ($gDrP=="2"){$SrT="(FS_KD_JAMINAN ='148' OR FS_KD_JAMINAN ='149' OR FS_KD_JAMINAN ='150' OR FS_KD_JAMINAN ='155') AND";}
		if ($gDrP=="3"){$SrT="FS_KD_JAMINAN!='001' AND FS_KD_JAMINAN!='148' AND FS_KD_JAMINAN!='149' AND FS_KD_JAMINAN!='150' AND FS_KD_JAMINAN!='155' AND";}
		
		$SyT ="WHERE $SrT (FS_KD_JAMINAN LIKE '%$gFnD%' OR FS_NM_JAMINAN LIKE '%$FnD%')";
	}
	
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="230" border="0">
	<?php
	$iG=1;
	
	if ($crt=="JmNK"){
		$nSQ = "SELECT FS_KD_JAMINAN, FS_NM_JAMINAN FROM ta_jaminan $SyT ORDER BY FS_KD_JAMINAN";
	}
	

	//echo $nSQ;
	$nRs = $mysqli->query($nSQ); 
	while ($mRo = $nRs->fetch_array()) {	
		
		$gKd = $mRo['FS_KD_JAMINAN'];
		$gNm = $mRo['FS_NM_JAMINAN'];
		$gDaT = "";		
		$gBK  = "";//fBackCLRfRM($iG);
		
		?>		
		<tr style="height:42px; <?php echo $gBK?>" onclick="showCLICK('<?php echo $gKd?>','<?php echo $gNm?>','<?php echo $IdL?>'); return false;">
			<td width="10" style="border-bottom:1px dotted #ccc">&nbsp;</td>
			<td width="40" style="border-bottom:1px dotted #ccc <?php echo $gBK?>"><?php echo $gKd?></td>
			<td style="border-bottom:1px dotted #ccc; padding-left:5px"><?php echo $gNm?> </td>
			<td width="70" style="border-bottom:1px dotted #ccc; text-align:<?php echo $lft?>"><?php echo $gDaT?> &nbsp;</td>
		</tr>
		<?php
		$iG++;
	}
				
	?>
	<?php if ($iG==1) {?>
		<tr height="20">
			<td colspan="4" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
		</tr>
	<?php } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
