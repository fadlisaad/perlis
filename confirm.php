<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Pengesahan Pembayaran | Gerbang Pembayaran Negeri Perlis</title>
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
        <section class="bg-home bg-kuning" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h2>Pengesahan Pembayaran</h2>
                                    <p>Sila semak maklumat pembayaran berikut</p>
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

                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="border p-3 mb-3 rounded">
                            <h4>Pengesahan</h4>
                            <?php
                            require ('php/conn.php');

                            //echo "<pre>"; var_dump($_POST); echo "</pre>";

                            $service = $_POST['service'];
                            $agency = $_POST['agency'];
                            $agency_id = $_POST['agency_id'];

                            $stmt_agency = $pdo->prepare("SELECT * FROM agencies WHERE code = :agency");
                            $stmt_agency->execute(['agency' => $agency]); 
                            $row_agency = $stmt_agency->fetch();

                            $stmt_service = $pdo->prepare("SELECT * FROM services WHERE code = :service AND agency_id = :agency_id");
                            $stmt_service->execute(['service' => $service, 'agency_id' => $agency_id]); 
                            $row_service = $stmt_service->fetch();

                            $data = $_POST;

                            echo "<form id='confirm' action='action.php?id=process-payment' method='post'>";
                            if (is_array($data) || is_object($data))
                            {
                                foreach ($data as $key => $val) {
                                    echo "<input type='hidden' name='".$key."' value='".filter_var($val, FILTER_SANITIZE_STRING)."'>";
                                }
                            }
                            echo "<input type='hidden' name='nama_agensi' value='".$row_agency['name']."'>";
                            echo "<input type='hidden' name='jenis_pembayaran' value='".$row_service['name']."'>";
                            echo "<input type='hidden' name='agency_email' value='".$row_agency['email']."'>";
                            echo "</form>";
                            ?>

                            <dl class="row">
                                <dt class="col-md-4">ID Transaksi</dt>
                                <dd class="col-md-8"><?php echo $row_agency['TRANS_ID'] ?? '' ?></dd>

                                <dt class="col-md-4">Agensi</dt>
                                <dd class="col-md-8"><?php echo $row_agency['name'] ?? '' ?></dd>

                                <dt class="col-md-4">Jenis Pembayaran</dt>
                                <dd class="col-md-8"><?php echo $row_service['name'] ?? '' ?></dd>

                                <dt class="col-md-4">Jumlah</dt>
                                <dd class="col-md-8">RM <?php echo number_format($_POST['amount'],2) ?? '' ?></dd>

                                <dt class="col-md-4">Nama</dt>
                                <dd class="col-md-8"><?php echo $_POST['nama'] ?? '' ?></dd>

                                <dt class="col-md-4">No. Kad Pengenalan</dt>
                                <dd class="col-md-8"><?php echo $_POST['nric'] ?? '' ?></dd>

                                <dt class="col-md-4">E-mail</dt>
                                <dd class="col-md-8"><?php echo $_POST['email'] ?? '' ?></dd>

                                <dt class="col-md-4">Telefon</dt>
                                <dd class="col-md-8"><?php echo $_POST['telefon'] ?? '' ?></dd>

                                <dt class="col-md-4">Catatan</dt>
                                <dd class="col-md-8"><?php echo $_POST['catatan'] ?? '' ?></dd>
                                
                                <?php if($_POST['alamat'] != NULL): ?>
                                <dt class="col-md-4">Alamat Rumah (Harumanis)</dt>
                                <dd class="col-md-8"><?php echo $_POST['alamat'] ?></dd>
                                <?php endif; ?>
                                
                                <?php if($_POST['cukai'] != NULL): ?>
                                <dt class="col-md-4">No. Cukai / No. Akaun</dt>
                                <dd class="col-md-8"><?php echo $_POST['cukai'] ?></dd>
                                <?php endif; ?>
                            </dl>
                            <a href="#" onclick="submitForm()" class="btn bg-biru text-white"><i class="fa fa-print"></i> Bayar</a>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </section>

        <!-- footer start -->
        <footer class="footer bg-biru">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="text-white">&copy; 2021 Hakcipta Terpelihara Perbendaharaan Negeri Perlis</p>
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
        <script type='text/javascript'>
            function submitForm() {
                document.getElementById('confirm').submit();
            }
        </script>
    </body>
</html>
