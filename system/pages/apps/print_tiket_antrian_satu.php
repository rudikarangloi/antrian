<?php
require __DIR__ . '/escpos-php-development/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector_antrian_satu;
include "fungsi_indotgl.php";


function cetak_nomor_antrian($nomor, $nama_loket, $reg,$printer_name)
{
	$connector = new WindowsPrintConnector("$printer_name");
	$printer = new Printer($connector);
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setTextSize(1,1);
	$printer -> text("Rumah Sakit Umum Daerah  Imanuddin \n");
	$printer -> setTextSize(2,1);
	$printer -> setUnderline(Printer::UNDERLINE_DOUBLE);
	$printer -> text("Pangkalan Bun\n"); 
	$printer -> setUnderline(false);
	$printer -> setTextSize(1,1);
	$printer -> text("$reg \n"); 
	$printer -> text("\n");
	
	$printer -> setTextSize(1,1);
	$printer -> text("Nomor antrian : \n");
	$printer -> text("\n");
	//$printer -> text("   ================= ");
	//$printer -> text("\n");
	$printer -> setTextSize(5,5);
	$printer -> text("$nomor \n");
	$printer -> setTextSize(1,1);
	$printer -> text("\n");
	$printer -> text("$nama_loket");

	//$printer -> text("   ================= ");
	$printer -> text("\n\n\n");
	$printer -> setTextSize(1,1);
	$printer -> text("Terima Kasih Atas kunjungan Anda");
	$printer -> text("\n");
	//$printer -> text(strftime('%c'));
	$printer -> text(tanggal_sekarang());	
	$printer -> text("\n");

	$printer -> text("\n\n\n");
	$printer -> cut();
	$printer -> close();
}



?>