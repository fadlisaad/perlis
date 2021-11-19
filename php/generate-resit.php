<?php
require __DIR__.'/vendor/autoload.php';
require_once('currency.php'); 

use Spipu\Html2Pdf\Html2Pdf;

/*
STATUS:1
TRANS_ID:567
RECEIPT_NO:EBYR210622-0000309
PAYMENT_TRANS_ID:2019032503053000000000000000000191
PAYMENT_DATETIME:2021-06-22 17:11:47
AMOUNT:50.00
BUYER_BANK:CIMB BANK
MERCHANT_ORDER_NO:567
PAYMENT_MODE:fpx
nama:MARIAM BINTI MAHAMOD
nric:821124095012
telefon:01136461169
kod_agensi:005000
nama_agensi:Pejabat Setiausaha Kerajaan Negeri Perlis (Unit Kewangan)
jenis_pembayaran:Bayaran Borang Sebutharga/Tender
alamat:
cukai:
catatan:SEBUTHARGA SYARIKAT CSE SERVICES ENTERPRISE
agency_email:psukfpx@perlis.gov.my
STATUS_CODE:0
STATUS_MESSAGE:Debit approved
APPROVAL_CODE:
BUYER_NAME:test buyer
*/

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
			<td>Tarikh</td>
			<td>:</td>
			<td>'.$_POST['PAYMENT_DATETIME'].'</td>
		</tr>
	</tbody>
</table>
<p><
<table border="0" width="800" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td width="132">Diterima daripada</td>
			<td width="10">:</td>
			<td width="522">'.$_POST['nama'].'</td>
		</tr>
		<tr>
			<td width="132">No. Pelanggan</td>
			<td width="10">:</td>
			<td width="522">'.$_POST['nric'].'</td>
		</tr>
		<tr>
			<td width="132">No. Telefon</td>
			<td width="10">:</td>
			<td width="522">'.$_POST['telefon'].'</td>
		</tr>
		<tr>
			<td width="132">Alamat</td>
			<td width="10">:</td>
			<td width="522">'.$_POST['alamat'].'</td>
		</tr>
		<tr>
			<td width="132">E-Mel</td>
			<td width="10">:</td>
			<td width="522">'.$_POST['email'].'</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</tbody>
</table>

<table border="0.5" width="700" cellspacing="0" cellpadding="0">
	<tbody>
		<tr style="background:#f2f2f2;text-align: center;">
			<td width="38"><strong>Bil.</strong></td>
			<td width="123"><strong>Perihal Pembayaran</strong></td>
			<td width="102"><strong>Cara Pembayaran/ Bank Pembayar</strong></td>
			<td width="144"><strong>Rujukan Pembayaran</strong></td>
			<td width="180"><strong>ID Transaksi</strong></td>
			<td width="85"><strong>Amaun (RM)</strong></td>
		</tr>
		<tr>
			<td style="text-align: center;" width="38">1.</td>
			<td style="text-align: center;" width="123">'.$_POST['nama_agensi'].'<br>'.$_POST['kod_agensi'].'</td>
			<td style="text-align: center;" width="102">'.$_POST['PAYMENT_MODE'].'<br>'.$_POST['BUYER_BANK'].'</td>
			<td style="text-align: center;" width="144">'.$_POST['PAYMENT_TRANS_ID'].'</td>
			<td style="text-align: center;" width="180">'.$_POST['TRANS_ID'].'</td>
			<td width="85" style="text-align: center;">'.$_POST['AMOUNT'].'</td>
		</tr>
		<tr>
			<td colspan="5" width="400" style="text-align: right;"><strong>JUMLAH</strong></td>
			<td width="85" style="text-align: center;"><strong>'.$_POST['AMOUNT'].'</strong></td>
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
			<td width="522">'.$_POST['TRANS_ID'].'</td>
		</tr>
		<tr>
			<td width="132">Jabatan</td>
			<td width="10">:</td>
			<td width="">'.$_POST['TRANS_ID'].'</td>
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
$html2pdf->output('../resit/'.$_POST['TRANS_ID'].'.pdf');