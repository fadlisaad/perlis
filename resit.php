<?php
if($_SERVER['REQUEST_METHOD'] != "POST") {
    header("HTTP/1.0 403 Forbidden");
    print("Forbidden");
    exit();
}
$config_filename = 'config.json';
if (!file_exists($config_filename)) {
    throw new Exception("Can't find ".$config_filename);
}
$config = json_decode(file_get_contents($config_filename), true);

require 'vendor/autoload.php';
require_once 'php/currency.php';

//send email
use PHPMailer\PHPMailer\PHPMailer;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$purifier = new HTMLPurifier();

if(isset($_POST['payload'])) {
    if($_POST['payload'] == 'ZWI0eUFy') {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Bukti Pembayaran | Gerbang Pembayaran Negeri Perlis</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Gerbang Pembayaran Perlis" name="description" />
        <meta content="Fadli Saad" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="images/favicon.png">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

        <!--Material Icon -->
        <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css" />

        <!-- Custom  sCss -->
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>

    <body>

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark">
            <div class="container-fluid">
                <!-- LOGO -->
                <a class="logo text-uppercase" href="https://ebayar.perlis.gov.my">
                    <img src="images/logo.png" alt="" class="logo-light" height="50" />
                    <img src="images/logo.png" alt="" class="logo-dark" height="50" />
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto" id="mySidenav">
                        <li class="nav-item active">
                            <a href="https://ebayar.perlis.gov.my" class="btn bg-biru text-white">Laman Utama</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- home start -->
        <section class="bg-home bg-kuning d-print-none" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h2>Bukti Pembayaran</h2>
                                    <p>Sila semak bukti pembayaran berikut</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- home end -->

        <!-- content start -->
        <section class="section">
            <div class="container-fluid">

                <?php if(isset($_POST['TRANS_ID']) && isset($_POST['PAYMENT_DATETIME']) && isset($_POST['AMOUNT']) && isset($_POST['PAYMENT_TRANS_ID'])):
                    $trans_id = $purifier->purify($_POST['TRANS_ID']);
                    $receipt_no = $purifier->purify($_POST['RECEIPT_NO']);
                    $payment_datetime = $purifier->purify($_POST['PAYMENT_DATETIME']);
                    $amount = $purifier->purify($_POST['AMOUNT']);
                    $payment_mode = $purifier->purify($_POST['PAYMENT_MODE']);
                    $payment_trans_id = $purifier->purify($_POST['PAYMENT_TRANS_ID']);
                    $approval_code = $purifier->purify($_POST['APPROVAL_CODE']);
                    $buyer_bank = $purifier->purify($_POST['BUYER_BANK']);
                    $buyer_name = $purifier->purify($_POST['BUYER_NAME']);
                    $nama = $purifier->purify($_POST['nama']);
                    $nric = $purifier->purify($_POST['nric']);
                    $telefon = $purifier->purify($_POST['telefon']);
                    $email = $purifier->purify($_POST['email']);
                    $jenis_pembayaran = $_POST['jenis_pembayaran'];
                    $nama_agensi = $purifier->purify($_POST['nama_agensi']);
                    $email_agensi = $purifier->purify($_POST['agency_email']);
                    $catatan = $purifier->purify($_POST['catatan']);
                    $cukai = $purifier->purify($_POST['cukai']);

                    try {
                        $html2pdf = new Html2Pdf('P', 'A4', 'en');
                        $html = '<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">';
                        $html .= '<p style="text-align: center;"><img src="images/jata.png"></p>
                        <h4 style="text-align: center;">KERAJAAN NEGERI PERLIS<br>RESIT RASMI<br>ASAL</h4>
                        <table border="0" cellspacing="0" cellpadding="0" style="table-layout: fixed; width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="width:60%;">&nbsp;</td>
                                    <td colspan="3"><strong>(Kew. 38E - Pin.1/2021)</strong></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>No. Resit</strong></td>
                                    <td>:</td>
                                    <td>'.$receipt_no.'</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>Tarikh</strong></td>
                                    <td>:</td>
                                    <td>'.date('d-m-Y', strtotime($payment_datetime)).'</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><strong>ID Transaksi</strong></td>
                                    <td>:</td>
                                    <td>'.$trans_id.'</td>
                                </tr>
                            </tbody>
                        </table>
            
                        <table border="0" cellspacing="0" cellpadding="0" style="table-layout: fixed; width: 100%;">
                            <tbody>
                                <tr>
                                    <td width="132"><strong>Diterima daripada</strong></td>
                                    <td width="10">:</td>
                                    <td width="522">'.$nama.'</td>
                                </tr>
                                <tr>
                                    <td width="132"><strong>No. Pelanggan</strong></td>
                                    <td width="10">:</td>
                                    <td width="522">'.$nric.'</td>
                                </tr>
                                <tr>
                                    <td width="132"><strong>No. Telefon</strong></td>
                                    <td width="10">:</td>
                                    <td width="522">'.$telefon.'</td>
                                </tr>
                                <tr>
                                    <td width="132"><strong>Alamat</strong></td>
                                    <td width="10">:</td>
                                    <td width="522">'.$alamat.'</td>
                                </tr>
                                <tr>
                                    <td width="132"><strong>E-Mel</strong></td>
                                    <td width="10">:</td>
                                    <td width="522">'.$email.'</td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
            
                        <table border="0.5" cellspacing="0" cellpadding="0" style="table-layout: fixed; width: 100%;">
                            <tbody>
                                <tr style="background:#f2f2f2;text-align: center;">
                                    <td width="38"><strong>Bil.</strong></td>
                                    <td width="260"><strong>Perihal Pembayaran</strong></td>
                                    <td width="102"><strong>Cara Pembayaran / Bank Pembayar</strong></td>
                                    <td width="144"><strong>Rujukan Pembayaran</strong></td>
                                    <td width="50"><strong>Amaun (RM)</strong></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;padding: 5px;">1.</td>
                                    <td style="text-align: left;padding: 5px;"><div style="width: 150px;">'.strtoupper($jenis_pembayaran).'<br>'.$cukai.'</div></td>
                                    <td style="text-align: center;padding: 5px;">'.strtoupper($payment_mode).'<br>'.$buyer_bank.'</td>
                                    <td style="text-align: center;padding: 5px;">'.$payment_trans_id.'</td>
                                    <td style="text-align: center;padding: 5px;">'.$amount.'</td>
                                </tr>
                                <tr>
                                    <td colspan="4" width="400" style="text-align: right;padding: 5px;"><strong>JUMLAH</strong></td>
                                    <td width="85" style="text-align: center;padding: 5px;"><strong>'.$amount.'</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="0" width="800" cellspacing="0" cellpadding="0" style="table-layout: fixed; width: 100%;">
                            <tbody>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="132">Ringgit Malaysia</td>
                                    <td width="10">:</td>
                                    <td width="522">'.convertMoney($amount).'</td>
                                </tr>
                                <tr>
                                    <td width="132">Catatan</td>
                                    <td width="10">:</td>
                                    <td width="522">'.strtoupper($catatan).'</td>
                                </tr>
                                <tr>
                                    <td width="132">Jabatan</td>
                                    <td width="10">:</td>
                                    <td width="">'.strtoupper($nama_agensi).'</td>
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
                        $html2pdf->output( __DIR__.'/resit/'.$trans_id.'.pdf', 'F');
                    } catch (Html2PdfException $e) {
                        $html2pdf->clean();
                        $formatter = new ExceptionFormatter($e);
                        echo $formatter->getHtmlMessage();
                    }
                ?>

                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="border p-3 mb-3 rounded">
                            <h4>Bukti Pembayaran</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <ul>
                                                        <li>No. Resit: <?php echo $receipt_no ?? '-' ?></li>
                                                        <li>ID Transaksi: <?php echo $trans_id ?? '-' ?></li>
                                                        <li>Tarikh/Masa: <?php echo $payment_datetime ?? '-' ?></li>
                                                        <li>Jumlah: RM <?php echo $amount ?? '-' ?></li>
                                                        <li>Mod Pembayaran: <?php echo strtoupper($payment_mode) ?? '-' ?></li>
                                                        <li>ID Pembayaran: <?php echo $payment_trans_id ?? '-' ?></li>
                                                        <li>Kod Pengesahan: <?php echo $approval_code ?? '-' ?></li>
                                                        <li>Bank Pembayar: <?php echo $buyer_bank ?? '-' ?></li>
                                                        <li>Nama Pembayar: <?php echo $buyer_name ?? '-' ?></li>
                                                        <li>Nama: <?php echo $nama ?? '-' ?></li>
                                                        <li>No. Kad Pengenalan: <?php echo $nric ?? '-' ?></li>
                                                        <li>Telefon: <?php echo $telefon ?? '-' ?></li>
                                                        <li>E-mail: <?php echo $email ?? '-' ?></li>
                                                        <li>Jenis Pembayaran: <?php echo $jenis_pembayaran ?? '-' ?></li>
                                                        <li>Agensi: <?php echo $nama_agensi ?? '-' ?></li>
                                                        <li>Catatan: <?php echo $catatan ?? '-' ?></li>
                                                        <?php if($_POST['alamat'] != NULL): ?>
                                                        <li>Alamat (Harumanis): <?php echo $_POST['alamat'] ?? '-' ?></li>
                                                        <?php endif; ?>
                                                        <?php if($_POST['cukai'] != NULL): ?>
                                                            <li>No. Cukai Tanah / No. Akaun: <?php echo $_POST['cukai'] ?? '-' ?></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <?php if($_POST['STATUS'] == 1): $msg = "Pembayaran anda telah diterima. Jika anda mempunyai sebarang pertanyaan, sila hubungi Perbendaharaan Negeri Perlis di ebayar@perlis.gov.my atau ".$email_agensi; ?>
                                            <tr>
                                                <td><div class="alert alert-info"><?php echo $msg ?></div></td>
                                            </tr>
                                            <?php else: $msg = "Pembayaran anda tidak berjaya. Sila cuba semula. Jika anda mempunyai sebarang pertanyaan, sila hubungi Perbendaharaan Negeri Perlis di ebayar@perlis.gov.my atau ".$email_agensi; ?>
                                            <tr>
                                                <td><div class="alert alert-warning"><?php echo $msg ?></div></td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo $config['base_url'].'/resit/'.$trans_id.'.pdf' ?>" class="btn bg-biru text-white d-print-none" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <?php
                // prepare receipt
                $receipt = "<p>".$msg."</p><ul>
                    <li>No. Resit: ".$receipt_no."</li>
                    <li>ID Transaksi: ".$trans_id."</li>
                    <li>Tarikh/Masa: ".$payment_datetime."</li>
                    <li>Jumlah: RM ".$amount."</li>
                    <li>Mod Pembayaran: ".strtoupper($payment_mode)."</li>
                    <li>ID Pembayaran: ".$payment_trans_id."</li>
                    <li>Kod Pengesahan: ".$approval_code."</li>
                    <li>Bank Pembayar: ".$buyer_bank."</li>
                    <li>Nama Pembayar: ".$buyer_name."</li>
                    <li>Nama: ".$nama."</li>
                    <li>No. Kad Pengenalan: ".$_POST['nric']."</li>
                    <li>Telefon: ".$telefon."</li>
                    <li>E-mail: ".$email."</li>
                    <li>Jenis Pembayaran: ".$jenis_pembayaran."</li>
                    <li>Agensi: ".$nama_agensi."</li>
                    <li>Catatan: ".$catatan."</li>";
                    if($_POST['alamat'] != NULL):
                $receipt .= "<li>Alamat (Harumanis): ".$_POST['alamat']."</li>";
                    endif;
                    if($_POST['cukai'] != NULL):
                $receipt .= "<li>No. Cukai Tanah / No. Akaun: ".$_POST['cukai']."</li>";
                    endif;
                $receipt .= "</ul>";

                // check pdf resit sebelum send as attachment
                
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = $config['email']['debug'];
                $mail->Host = $config['email']['host'];
                $mail->Port = $config['email']['port'];
                $mail->SMTPAuth = false;
                $mail->SMTPAutoTLS = false;
                $mail->Username = $config['email']['username'];
                $mail->Password = $config['email']['password'];
                $mail->setFrom($config['email']['username'], $config['email']['from']);
                $mail->addReplyTo($config['email']['username'], $config['email']['from']);
                $mail->addAddress($email, $nama);
                $mail->addCC($email_agensi);
                $mail->Subject = 'Status Pembayaran di E-Bayar Perlis';
                $mail->AddAttachment('resit/'.$trans_id.'.pdf', 'Resit-eBayar-'.$trans_id.'.pdf');
                $mail->isHTML(true);
                $mail->Body = $receipt;
                if (!$mail->send()) {
                    echo "<script>alert('Terdapat ralat dalam menghantar bukti pembayaran ini. Sila semak jika anda memasukkan alamat e-mail dengan tepat.');</script>";
                    echo $mail->ErrorInfo;
                } else {
                    echo "<script>alert('Sila semak e-mail anda untuk mendapatkan salinan bukti pembayaran ini.');</script>";
                }
            else:
                echo "<div class='alert alert-danger'>No data received</div>";
            endif;
                ?>
            </div>
        </section>

        <!-- footer start -->
        <footer class="footer d-print-none bg-biru">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="text-white">&copy; 2021-2022 Hakcipta Terpelihara Perbendaharaan Negeri Perlis</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </footer>
        <!-- footer end -->
        
        <!-- Back to top -->    
        <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

        <!-- javascript -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>

        <!-- custom js -->
        <script src="js/app.js"></script>
    </body>
</html>
<?php
    } else {
        die('Go away you nasty bot!');
    }
} else {
    die('No valid post data received');
}
?>
