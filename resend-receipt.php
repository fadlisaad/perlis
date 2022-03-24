<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Resit | Gerbang Pembayaran Negeri Perlis</title>
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
                                    <h2>Resit</h2>
                                    <p>Anda boleh mendapatkan semula salinan resit pembayaran. Isikan maklumat resit seperti di bawah</p>
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

                <div class="row justify-content-md-center">
                    <div class="col-lg-6">
                        <div class="border p-3 mb-3 rounded">
                            <form method="post" action="action.php?id=resend-resit" id="form-resit">
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="resit">No. Resit</label>
                                        <input type="text" name="resit" placeholder="No resit dari EPIC" required="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Alamat Email</label>
                                        <input type="email" name="email" placeholder="Alamat email resit akan dihantar" required="" class="form-control">
                                    </div>
                                    <button type="submit" class="btn bg-biru text-white mt-1">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer start -->
        <footer class="footer d-print-none bg-biru">
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
    </body>
</html>