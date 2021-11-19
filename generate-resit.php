<?php
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html = '<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">';
$html .= '<table border="0" width="800" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;"><strong>KERAJAAN NEGERI PERLIS<br>RESIT RASMI<br>ASAL</strong></td>
</tr>
</tbody>
</table>
<table border="0" width="800" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td width="400">&nbsp;</td>
			<td colspan="3"><strong>(Kew. 38E - Pin.1/2021)</strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><strong>No. Resit</strong></td>
			<td>:</td>
			<td>EBYR210923-0000881</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Tarikh</td>
			<td>:</td>
			<td>23-09-2021</td>
		</tr>
	</tbody>
</table>

<table border="0" width="800" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td width="132">Diterima daripada</td>
			<td width="19">:</td>
			<td width="522">MUHAMMAD HIZAMI BIN MUSTAFA</td>
		</tr>
		<tr>
			<td width="132">No. Pelanggan</td>
			<td width="19">:</td>
			<td width="522">871130145501</td>
		</tr>
		<tr>
			<td width="132">No. Telefon</td>
			<td width="19">:</td>
			<td width="522">0103920886</td>
		</tr>
		<tr>
			<td width="132">Alamat</td>
			<td width="19">:</td>
			<td width="522">BAYARAN CUKAI TANAH TAHUN 2021</td>
		</tr>
		<tr>
			<td width="132">E-Mel</td>
			<td width="19">:</td>
			<td width="522">hizamimustafa87@gmail.com</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</tbody>
</table>

<table border="1" width="800" cellspacing="0" cellpadding="0">
	<tbody>
		<tr style="background:grey;text-align: center;">
			<td width="38"><strong>Bil.</strong></td>
			<td width="123"><strong>Perihal Pembayaran</strong></td>
			<td width="102"><strong>Cara Pembayaran/ Bank Pembayar</strong></td>
			<td width="144"><strong>Rujukan Pembayaran</strong></td>
			<td width="180"><strong>ID Transaksi</strong></td>
			<td width="85"><strong>Amaun (RM)</strong></td>
		</tr>
<tr>
<td style="text-align: center;" width="38">
<p>1.</p>
</td>
<td style="text-align: center;" width="123">
<p>BAYARAN CUKAI TANAH</p>
<p>03PN547</p>
</td>
<td style="text-align: center;" width="102">
<p>FPX</p>
<p>CIMB BANK</p>
</td>
<td style="text-align: center;" width="144">
<p>2109232204310960</p>
</td>
<td style="text-align: center;" width="180">
<p>025000-01-20210923-1494</p>
</td>
<td width="85">
<p style="text-align: center;">10.00</p>
</td>
</tr>
<tr>
<td colspan="5" width="800">
<p style="text-align: right;"><strong>JUMLAH</strong></p>
</td>
<td width="85">
<p style="text-align: center;"><strong>10.00</strong></p>
</td>
</tr>
</tbody>
</table>
<table border="0" width="800" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="132">
<p>Ringgit Malaysia</p>
</td>
<td width="19">
<p>:</p>
</td>
<td width="522">
<p>SEPULUH SAHAJA</p>
</td>
</tr>
<tr>
<td width="132">
<p>Catatan</p>
</td>
<td width="19">
<p>:</p>
</td>
<td width="522">
<p>BAYARAN CUKAI TANAH TAHUN 2021</p>
</td>
</tr>
<tr>
<td width="132">
<p>Jabatan</p>
</td>
<td width="19">
<p>:</p>
</td>
<td width="">
<p>JABATAN TANAH DAN GALIAN NEGERI PERLIS</p>
</td>
</tr>
<tr>
<td colspan="3" width="800">
<p><em>Ini adalah cetakan komputer dan tidak perlu ditandatangani</em></p>
</td>
</tr>
<tr>
<td colspan="3" width="800">
<p>Pembayaran anda telah diterima. Sebarang pertanyaan, sila hubungi Perbendaharaan Negeri Perlis di <u>ebayar@perlis.gov.my</u></p>
</td>
</tr>
<tr>
<td colspan="3" width="672">
<p>No. Kelulusan Perbendaharaan : PKN/BNPs/2021</p>
</td>
</tr>
<tr>
<td colspan="3" width="672">
<p>Resit ini dijana oleh Portal eBayar Perlis</p>
</td>
</tr>
</tbody>
</table>';
$html .= '</page>';
$html2pdf->writeHTML($html);
$html2pdf->output();