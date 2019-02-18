<?php
require "connfile-php7.php";
require "functionfile-php7.php";

extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
if (!isset($gDrP)){$gDrP="All";}

if ($gDrP=="All"){$gDrP="%";}
#echo $crt."<br>";
$SyT = "";
#echo $gDrP;
if ($FnD!="" || $gDrP!="")
{
	if ($crt=="LaYK"){
		$SyT ="AND FS_NM_LAYANAN LIKE '%$FnD%'";
	}
	if ($crt=="KlSK"){
		$SyT ="WHERE (FS_KD_KELAS LIKE '%$FnD%' OR FS_NM_KELAS LIKE '%$FnD%')";
	}
	if ($crt=="JmNK"){
		$SrT="";
		if ($gDrP=="1"){$SrT="FS_KD_JAMINAN ='001' AND";}
		if ($gDrP=="2"){$SrT="(FS_KD_JAMINAN ='148' OR FS_KD_JAMINAN ='149' OR FS_KD_JAMINAN ='150' OR FS_KD_JAMINAN ='155') AND";}
		if ($gDrP=="3"){$SrT="FS_KD_JAMINAN!='001' AND FS_KD_JAMINAN!='148' AND FS_KD_JAMINAN!='149' AND FS_KD_JAMINAN!='150' AND FS_KD_JAMINAN!='155' AND";}
		
		$SyT ="WHERE $SrT (FS_KD_JAMINAN LIKE '%$gFnD%' OR FS_NM_JAMINAN LIKE '%$FnD%')";
	}
	if ($crt=="TrFK"){
		$SyT ="WHERE FS_KD_INSTALASI_DK LIKE '".$gDrP."' AND (FS_KD_KARCIS LIKE '%$gFnD%' OR FS_NM_KARCIS LIKE '%$FnD%')";
	}
	if ($crt=="MsKK"){
		$SyT ="WHERE (FS_KD_CARA_MASUK_DK LIKE '%$gFnD%' OR FS_NM_CARA_MASUK_DK LIKE '%$FnD%')";
	}
	if ($crt=="RjKK"){
		$SyT ="WHERE (FS_KD_RUJUKAN LIKE '%$gFnD%' OR FS_NM_RUJUKAN LIKE '%$FnD%')";
	}
	if ($crt=="InPK"){
		$SyT ="WHERE (FS_KD_JENIS_INAP LIKE '%$gFnD%' OR FS_NM_JENIS_INAP LIKE '%$FnD%')";
	}
	if ($crt=="SmFK"){
		$SyT ="WHERE (FS_KD_SMF LIKE '%$gFnD%' OR FS_NM_SMF LIKE '%$FnD%')";
	}
	if ($crt=="DiAK"){
		$SyT ="WHERE (FS_KD_ICD LIKE '%$gFnD%' OR FS_NM_ICD LIKE '%$FnD%')";
	}
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="230" border="0">
	<?php
	$iG=1;
	if ($crt=="LaYK"){
		$nSQ = "SELECT TOP 100 FS_KD_LAYANAN, FS_NM_LAYANAN, FS_REF_BPJS 
		FROM ta_layanan 
		WHERE FS_KD_LAYANAN LIKE '".$gDrP."%%%' 
		AND (FS_KD_LAYANAN LIKE 'RD%' 
		OR FS_KD_LAYANAN LIKE 'RI%' 
		OR FS_KD_LAYANAN LIKE 'RJ%' 
		OR FS_KD_LAYANAN LIKE 'UP%') 
		AND FS_NM_LAYANAN NOT LIKE 'XX%' 
		$SyT ORDER BY FS_KD_LAYANAN";
		
		if ($gDrP=='%'){
			$nSQ = "SELECT TOP 100 FS_KD_LAYANAN, FS_NM_LAYANAN, FS_REF_BPJS 
			FROM ta_layanan 
			WHERE FS_KD_LAYANAN LIKE 'RD%' 
			AND FS_NM_LAYANAN NOT LIKE 'XX%' 
			$SyT ORDER BY FS_KD_LAYANAN";
			
			$nSQ2 = "SELECT TOP 100 FS_KD_LAYANAN, FS_NM_LAYANAN, FS_REF_BPJS 
			FROM ta_layanan 
			WHERE FS_KD_LAYANAN LIKE 'RJ%' 
			AND FS_NM_LAYANAN NOT LIKE 'XX%' 
			$SyT ORDER BY FS_KD_LAYANAN";
			
			$nSQ3 = "SELECT TOP 100 FS_KD_LAYANAN, FS_NM_LAYANAN, FS_REF_BPJS 
			FROM ta_layanan 
			WHERE FS_KD_LAYANAN LIKE 'RI%' 
			AND FS_NM_LAYANAN NOT LIKE 'XX%' 
			$SyT ORDER BY FS_KD_LAYANAN";
			
			$nSQ4 = "SELECT TOP 100 FS_KD_LAYANAN, FS_NM_LAYANAN, FS_REF_BPJS 
			FROM ta_layanan 
			WHERE FS_KD_LAYANAN LIKE 'UP%' 
			AND FS_NM_LAYANAN NOT LIKE 'XX%' 
			$SyT ORDER BY FS_KD_LAYANAN";
		}
	}
	if ($crt=="KlSK"){
		$nSQ = "SELECT TOP 100 FS_KD_KELAS, FS_NM_KELAS FROM ta_kelas $SyT ORDER BY FS_KD_KELAS";
	}
	if ($crt=="JmNK"){
		$nSQ = "SELECT TOP 100 FS_KD_JAMINAN, FS_NM_JAMINAN FROM ta_jaminan $SyT ORDER BY FS_KD_JAMINAN";
	}
	if ($crt=="TrFK"){
		$nSQ = "SELECT TOP 100 FS_KD_KARCIS, FS_NM_KARCIS, FN_KARCIS FROM ta_karcis $SyT ORDER BY FS_KD_KARCIS";
	}
	if ($crt=="MsKK"){
		$nSQ = "SELECT TOP 100 FS_KD_CARA_MASUK_DK, FS_NM_CARA_MASUK_DK FROM ta_cara_masuk_dk $SyT ORDER BY FS_KD_CARA_MASUK_DK";
	}
	if ($crt=="RjKK"){
		$nSQ = "SELECT TOP 100 FS_KD_RUJUKAN, FS_NM_RUJUKAN, FS_NO_FASKES_BPJS FROM ta_rujukan $SyT ORDER BY FS_KD_RUJUKAN";
	}
	if ($crt=="InPK"){
		$nSQ = "SELECT TOP 100 FS_KD_JENIS_INAP, FS_NM_JENIS_INAP FROM ta_jenis_inap $SyT ORDER BY FS_KD_JENIS_INAP";
	}
	if ($crt=="SmFK"){
		$nSQ = "SELECT TOP 100 FS_KD_SMF, FS_NM_SMF FROM ta_smf $SyT ORDER BY FS_KD_SMF";
	}
	if ($crt=="DiAK"){
		$nSQ = "SELECT TOP 100 FS_KD_ICD, FS_NM_ICD FROM tc_tbl_icd $SyT ORDER BY FS_KD_ICD";
	}


	//echo $nSQ;
	$nRs = sqlsrv_query($ConSA, $nSQ);	
	while ($mRo = sqlsrv_fetch_array($nRs))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		if ($crt=="LaYK" || $crt=="RjKK" || $crt=="TrFK"){
			$gDaT = $mRo[2];
			if ($gDaT=="") {$gDaT="-";}
			$lft = "left";
			if ($crt=="TrFK"){$lft = "right"; $gDaT=fConvertToRupiahBulat($gDaT)."&nbsp;&nbsp;";}
		}
		else{
			$gDaT = "";
		}
		$gBK  = "";//fBackCLRfRM($iG);
		
		?>
		<!--<tr style="height:22px; <?php echo $gBK?>" onclick="showCLICK('<?php echo $crt?>','<?php echo $gKd?>','<?php echo $IdL?>'); return false;">-->
		<tr style="height:42px; <?php echo $gBK?>" onclick="showCLICK('<?php echo $mRo[0]?>','<?php echo $mRo[1]?>','<?php echo $IdL?>'); return false;">
			<td width="10" style="border-bottom:1px dotted #ccc">&nbsp;</td>
			<td width="40" style="border-bottom:1px dotted #ccc <?php echo $gBK?>"><?php echo $gKd?></td>
			<td style="border-bottom:1px dotted #ccc; padding-left:5px"><?php echo $gNm?> </td>
			<td width="70" style="border-bottom:1px dotted #ccc; text-align:<?php echo $lft?>"><?php echo $gDaT?> &nbsp;</td>
		</tr>
		<?php
		$iG++;
	}
	
	if ($crt=="LaYK" && $gDrP=='%'){
		####
		// $nRs = mssql_query($nSQ2);
		// while ($mRo = mssql_fetch_array($nRs, MYSQL_BOTH))

		$nRs = sqlsrv_query($ConSA, $nSQ2);	
		while ($mRo = sqlsrv_fetch_array($nRs))
		{
			$gKd = $mRo[0];
			$gNm = $mRo[1];
			if ($crt=="LaYK" || $crt=="RjKK" || $crt=="TrFK"){
				$gDaT = $mRo[2];
				if ($gDaT=="") {$gDaT="-";}
				$lft = "left";
				if ($crt=="TrFK"){$lft = "right"; $gDaT=fConvertToRupiahBulat($gDaT)."&nbsp;&nbsp;";}
			}
			else{
				$gDaT = "";
			}
			$gBK  = "";#fBackCLRfRM($iG);
			?>
			<tr style="height:22px; <?php echo $gBK?>" onclick="showCLICK('<?php echo $crt?>','<?php echo $gKd?>','<?php echo $IdL?>'); return false;">
				<td width="10" style="border-bottom:1px dotted #ccc">&nbsp;</td>
				<td width="40" style="border-bottom:1px dotted #ccc"><?php echo $mRo[0]?></td>
				<td style="border-bottom:1px dotted #ccc; padding-left:5px"><?php echo $mRo[1]?></td>
				<td width="70" style="border-bottom:1px dotted #ccc; text-align:<?php echo $lft?>"><?php echo $gDaT?>&nbsp;</td>
			</tr>
			<?php
			$iG++;
		}
		
		// $nRs = mssql_query($nSQ3);
		// while ($mRo = mssql_fetch_array($nRs, MYSQL_BOTH))

		$nRs = sqlsrv_query($ConSA, $nSQ3);	
		while ($mRo = sqlsrv_fetch_array($nRs))
		{
			$gKd = $mRo[0];
			$gNm = $mRo[1];
			if ($crt=="LaYK" || $crt=="RjKK" || $crt=="TrFK"){
				$gDaT = $mRo[2];
				if ($gDaT=="") {$gDaT="-";}
				$lft = "left";
				if ($crt=="TrFK"){$lft = "right"; $gDaT=fConvertToRupiahBulat($gDaT)."&nbsp;&nbsp;";}
			}
			else{
				$gDaT = "";
			}
			?>
			<tr height="22" onclick="showCLICK('<?php echo $crt?>','<?php echo $gKd?>','<?php echo $IdL?>'); return false;">
				<td width="10" style="border-bottom:1px dotted #ccc">&nbsp;</td>
				<td width="40" style="border-bottom:1px dotted #ccc"><?php echo $mRo[0]?></td>
				<td style="border-bottom:1px dotted #ccc; padding-left:5px"><?php echo $mRo[1]?></td>
				<td width="70" style="border-bottom:1px dotted #ccc; text-align:<?php echo $lft?>"><?php echo $gDaT?>&nbsp;</td>
			</tr>
			<?php
			$iG++;
		}
		
		// $nRs = mssql_query($nSQ4);
		// while ($mRo = mssql_fetch_array($nRs, MYSQL_BOTH))
		$nRs = sqlsrv_query($ConSA, $nSQ4);	
		while ($mRo = sqlsrv_fetch_array($nRs))
		{
			$gKd = $mRo[0];
			$gNm = $mRo[1];
			if ($crt=="LaYK" || $crt=="RjKK" || $crt=="TrFK"){
				$gDaT = $mRo[2];
				if ($gDaT=="") {$gDaT="-";}
				$lft = "left";
				if ($crt=="TrFK"){$lft = "right"; $gDaT=fConvertToRupiahBulat($gDaT)."&nbsp;&nbsp;";}
			}
			else{
				$gDaT = "";
			}
			?>
			<tr height="22" onclick="showCLICK('<?php echo $crt?>','<?php echo $gKd?>','<?php echo $IdL?>'); return false;">
				<td width="10" style="border-bottom:1px dotted #ccc">&nbsp;</td>
				<td width="40" style="border-bottom:1px dotted #ccc"><?php echo $mRo[0]?></td>
				<td style="border-bottom:1px dotted #ccc; padding-left:5px"><?php echo $mRo[1]?></td>
				<td width="70" style="border-bottom:1px dotted #ccc; text-align:<?php echo $lft?>"><?php echo $gDaT?>&nbsp;</td>
			</tr>
			<?php
			$iG++;
		}
		####
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
