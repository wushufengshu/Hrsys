<?php
require_once('tcpdf_include.php');
$connections = mysqli_connect("localhost", "root", "", "hotelreservationdb");
if(mysqli_connect_errno()){

	echo "Failed to connect to MySQL database: " . mysqli_connect_errno();
}

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Suite Life Hotel');
$pdf->SetTitle('Suite Life Hotel Revenues');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


$pdf->SetFont('dejavusans', '', 10);


$pdf->AddPage('P');
$html = '<table border="1" width="100%"> ';
$html .=   '<tr>
				<td>
					<b>Month</b>
				</td>
				<td>
					<b>Total revenue</b>
				</td>
			</tr>';

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

$html .= '<tr>
			<td>January</td>
			<td>P ' . number_format($january).'.00</td>
		</tr>
		<tr>
			<td>Febuary</td>
			<td>P ' . number_format($feb).'.00</td>
		</tr>
		<tr>
			<td>March</td>
			<td>P ' . number_format($march).'.00</td>
		</tr>
		<tr>
			<td>April</td>
			<td>P ' . number_format($april).'.00</td>
		</tr>
		<tr>
			<td>May</td>
			<td>P ' . number_format($may).'.00</td>
		</tr>
		<tr>
			<td>June</td>
			<td>P ' . number_format($june).'.00</td>
		</tr>
		<tr>
			<td>July</td>
			<td>P ' . number_format($july).'.00</td>
		</tr>
		<tr>
			<td>August</td>
			<td>P ' . number_format($august).'.00</td>
		</tr>
		<tr>
			<td>September</td>
			<td>P ' . number_format($september).'.00</td>
		</tr>
		<tr>
			<td>October</td>
			<td>P ' . number_format($october).'.00</td>
		</tr>
		<tr>
			<td>November</td>
			<td>P ' . number_format($november).'.00</td>
		</tr>
		<tr>
			<td>December</td>
			<td>P ' . number_format($december).'.00</td>
		</tr>';



$html .='</table>';


$pdf->WriteHTML($html, true, false, true, false, '');
$pdf->lastPage();

$pdf->Output('Plain.pdf', 'I');

