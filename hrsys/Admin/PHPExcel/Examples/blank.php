<?php

$connections = mysqli_connect("localhost", "root", "", "hotelreservationdb");
if(mysqli_connect_errno()){

	echo "Failed to connect to MySQL database: " . mysqli_connect_errno();
}

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$objPHPExcel->getActiveSheet(0)->setCellValue('A1','Month');
$objPHPExcel->getActiveSheet(0)->setCellValue('B1','Total revenue');
		
		foreach(range('A','B') as $cols){
			$objPHPExcel->getActiveSheet()
			->getColumnDimension($cols)
			->setAutoSize(true);
		}
$row_count = 2;

$retrieve_january = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-01-01' AND '2018-01-31'");
$row = mysqli_fetch_assoc($retrieve_january);
$january = $row["total"];

$retrieve_feb = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-02-01' AND '2018-02-31'");
$row = mysqli_fetch_assoc($retrieve_feb);
$feb = $row["total"];

$retrieve_march = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-03-01' AND '2018-03-31'");
$row = mysqli_fetch_assoc($retrieve_march);
$march = $row["total"];

$retrieve_april = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-04-01' AND '2018-04-31'");
$row = mysqli_fetch_assoc($retrieve_april);
$april = $row["total"];

$retrieve_may = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-05-01' AND '2018-05-31'");
$row = mysqli_fetch_assoc($retrieve_may);
$may = $row["total"];

$retrieve_june = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-06-01' AND '2018-06-31'");
$row = mysqli_fetch_assoc($retrieve_june);
$june = $row["total"];

$retrieve_july = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-07-01' AND '2018-07-31'");
$row = mysqli_fetch_assoc($retrieve_july);
$july = $row["total"];

$retrieve_august = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-08-01' AND '2018-08-31'");
$row = mysqli_fetch_assoc($retrieve_august);
$august = $row["total"];

$retrieve_september = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-09-01' AND '2018-09-31'");
$row = mysqli_fetch_assoc($retrieve_september);
$september = $row["total"];

$retrieve_october = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-10-01' AND '2018-10-31'");
$row = mysqli_fetch_assoc($retrieve_october);
$october = $row["total"];

$retrieve_november = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-11-01' AND '2018-11-31'");
$row = mysqli_fetch_assoc($retrieve_november);
$november = $row["total"];

$retrieve_december = mysqli_query($connections, "SELECT SUM(total) AS total FROM payment WHERE checkin BETWEEN '2018-12-01' AND '2018-12-31'");
$row = mysqli_fetch_assoc($retrieve_december);
$december = $row["total"];

foreach(range('A', 'B') as $cols){
	$objPHPExcel->getActiveSheet()
	->getColumnDimension($cols)
	->setAutoSize(true);
}
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'January');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $january);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'Febuary');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $feb);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'March');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $march);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'April');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $april);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'May');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $may);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'June');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $june);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'July');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $july);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'August');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $august);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'September');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $september);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'October');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $october);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'November');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $november);
$row_count++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row_count,'December');
$objPHPExcel->getActiveSheet(0)->setCellValue('B'.$row_count, $december);
$row_count++;

							

$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Plain.xls"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header ('Cache-Control: cache, must-revalidate'); 
header ('Pragma: public'); 

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>