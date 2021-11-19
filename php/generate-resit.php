<?php
require __DIR__.'/../vendor/autoload.php';
require_once('currency.php'); 

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html = '<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">';
$html .= '<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="text-align: center;" width="700"><img src="../images/jata.png"></td>
</tr>
<tr>
<td style="text-align: center;" width="700">&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;" width="700"><h4>KERAJAAN NEGERI PERLIS<br>RESIT RASMI<br>ASAL</h4></td>
</tr>
<tr>
<td style="text-align: center;" width="700">&nbsp;</td>
</tr>
</tbody>
</table>
<table border="0" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td width="450">&nbsp;</td>
			<td colspan="3"><strong>(Kew. 38E - Pin.1/2021)</strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><strong>No. Resit</strong></td>
			<td>:</td>
			<td>'.$_POST['RECEIPT_NO'].'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><strong>Tarikh</strong></td>
			<td>:</td>
			<td>'.date('d-m-Y', strtotime($_POST['PAYMENT_DATETIME'])).'</td>
		</tr>
	</tbody>
</table>

<table border="0" width="800" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td width="132"><strong>Diterima daripada</strong></td>
			<td width="10">:</td>
			<td width="522">'.$_POST['nama'].'</td>
		</tr>
		<tr>
			<td width="132"><strong>No. Pelanggan</strong></td>
			<td width="10">:</td>
			<td width="522">'.$_POST['nric'].'</td>
		</tr>
		<tr>
			<td width="132"><strong>No. Telefon</strong></td>
			<td width="10">:</td>
			<td width="522">'.$_POST['telefon'].'</td>
		</tr>
		<tr>
			<td width="132"><strong>Alamat</strong></td>
			<td width="10">:</td>
			<td width="522">'.$_POST['alamat'].'</td>
		</tr>
		<tr>
			<td width="132"><strong>E-Mel</strong></td>
			<td width="10">:</td>
			<td width="522">'.$_POST['email'].'</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</tbody>
</table>

<table border="0.5" cellspacing="0" cellpadding="0" style="table-layout: fixed; width: 750px">
	<tbody>
		<tr style="background:#f2f2f2;text-align: center;">
			<td width="38"><strong>Bil.</strong></td>
			<td width="160"><strong>Perihal Pembayaran</strong></td>
			<td width="102"><strong>Cara Pembayaran / Bank Pembayar</strong></td>
			<td width="144"><strong>Rujukan Pembayaran</strong></td>
			<td width="100"><strong>ID Transaksi</strong></td>
			<td width="50"><strong>Amaun (RM)</strong></td>
		</tr>
		<tr>
			<td style="text-align: center;padding: 5px;">1.</td>
			<td style="text-align: left;padding: 5px;"><div style="width: 150px;">'.strtoupper($_POST['jenis_pembayaran']).'<br>'.$_POST['cukai'].'</div></td>
			<td style="text-align: center;padding: 5px;">'.strtoupper($_POST['PAYMENT_MODE']).'<br>'.$_POST['BUYER_BANK'].'</td>
			<td style="text-align: center;padding: 5px;">'.$_POST['PAYMENT_TRANS_ID'].'</td>
			<td style="text-align: center;padding: 5px;">'.$_POST['TRANS_ID'].'</td>
			<td style="text-align: center;padding: 5px;">'.$_POST['AMOUNT'].'</td>
		</tr>
		<tr>
			<td colspan="5" width="400" style="text-align: right;padding: 5px;"><strong>JUMLAH</strong></td>
			<td width="85" style="text-align: center;padding: 5px;"><strong>'.$_POST['AMOUNT'].'</strong></td>
		</tr>
	</tbody>
</table>
<table border="0" width="800" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="132">Ringgit Malaysia</td>
			<td width="10">:</td>
			<td width="522">'.convertMoney($_POST['AMOUNT']).'</td>
		</tr>
		<tr>
			<td width="132">Catatan</td>
			<td width="10">:</td>
			<td width="522">'.strtoupper($_POST['catatan']).'</td>
		</tr>
		<tr>
			<td width="132">Jabatan</td>
			<td width="10">:</td>
			<td width="">'.strtoupper($_POST['nama_agensi']).'</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
<p style="text-align: center;"><em>Ini adalah cetakan komputer dan tidak perlu ditandatangani</em></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Pembayaran anda telah diterima. Sebarang pertanyaan, sila hubungi Perbendaharaan Negeri Perlis di <u>perbendaharaan@perlis.gov.my</u></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>No. Kelulusan Perbendaharaan : PKN/BNPs/2021<br>Resit ini dijana oleh Portal eBayar Perlis</p>';
$html .= '</page>';
$html2pdf->writeHTML($html);
$html2pdf->output( __DIR__.'/resit/'.$_POST['TRANS_ID'].'.pdf');