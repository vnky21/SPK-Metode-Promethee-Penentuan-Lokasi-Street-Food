<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>SISTEM PENDUKUNG KEPUTUSAN</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head> 


   
<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
            <?php if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'error') : ?>
            <div id='alert-error' data-message="<?= $_SESSION['message'] ?>"></div>
        <?php
        $_SESSION['alert'] = null;
        endif; ?>
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4 mt-5"><a class="app-logo" href="./index.php"><img class="logo-icon me-2" src="assets/images/logo-blue.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to App</h2>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" action="login/proses.php" method="post">         
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Email</label>
								<input id="signin-email" name="username" type="text" class="form-control signin-email" placeholder="Username" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="password-1">Password</label>
								<input id="password-1" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
                                <span class="toggle-password-login" onclick="togglePassword('password-1', 'eye-icon-1')">
                                     <i id="eye-icon-1" class="fas fa-eye"></i>
                                </span>
                            </div><!--//form-group-->

							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
							</div>
						</form>
						
						<div class="auth-option text-center pt-5">Ingin melihat hasil perhitungannya? Klik <a class="text-link" href="hasil.php" >disini</a>.</div>
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
			    <footer class="app-auth-footer">
				    <div class="container text-center py-3">
				         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                         <small class="copyright">Copyright &copy; <?= date('Y'); ?> SPK Pemilihan Lokasi Street Food Menggunakan Metode Promethee | Imelda Lukas</small>
				       
				    </div>
			    </footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
            <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
                <div class="auth-background-holder">
                </div>
                <div class="auth-background-mask"></div>
                <div class="auth-background-overlay p-3 p-lg-5">
                    <div class="d-flex flex-column align-content-end h-100">
                        <div class="h-100"></div>
                        <div class="overlay-content p-3 p-lg-4 rounded">
                            <h5 class="mb-2 overlay-title">Selamat Datang di</h5>
                            <div>Sistem Pendukung Keputusan Pemilihan Lokasi Street Food Menggunakan Metode Promethee</div>
                        </div>
                    </div>
                </div><!--//auth-background-overlay-->
            </div><!--//auth-background-col-->
    
    </div><!--//row-->

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	    <!-- Javascript -->
	    <script src="assets/plugins/popper.min.js"></script>
	    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	    <!-- Charts JS -->
	    <script src="assets/plugins/chart.js/chart.min.js"></script>
	    <script src="assets/js/index-charts.js"></script>

	    <!-- Page Specific JS -->
	    <script src="assets/js/app.js"></script>
	    <script src="assets/js/alert.js"></script>

</body>
</html> 