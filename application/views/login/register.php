<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - PT Agrikultur Gemilang Indonesia</title>

    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/img/logo/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/logo/favicon.ico">

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/css/style.css">
</head>
<body>
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
            	<h2 class="title">Form Register Member</h2>
            	<?php if($this->session->flashdata('sukses')){
		echo '<div class="alert alert-warning">';
		echo $this->session->flashdata('sukses');
		echo '</div>';
	} ?>
                <div class="signup-content">
                    <div class="signup-form">
                    	<?php 
                    	//display error
		echo validation_errors('<div class="alert alert-warning">','</div>');
                        echo form_open(base_url('login/register'),'class="login100-form validate-form"') ?>
                         <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama Lengkap"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="no_hp" id="no_hp" placeholder="No Handphone"/>
                            </div>
                            <div class="form-group paraf">
			                    <p>Sudah Memiliki Akun? <a href="<?php echo base_url('login') ?>" class="signup-image-link">Login</a></p>
			                </div>
                    </div>
                    <div class="signup-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-accounts"></i></i></label>
                                <input type="text" name="komoditi" id="komoditi" placeholder="Komoditi"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-pin"></i></label>
                                <input type="text" name="alamat" id="alamat" placeholder="ALamat Lengkap"/>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-pin"></i></label>
                                <input type="text" name="provinsi" id="provinsi" placeholder="Provinsi"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-pin"></i></label>
                                <input type="text" name="kabupaten" id="kabupaten" placeholder="Kabupaten/Kota"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-pin"></i></label>
                                <input type="text" name="kecamatan" id="kecamatan" placeholder="Kecamatan"/>
                            </div>
                            <div class="form-group form-button">
			                    <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
			                </div>
                        </form>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="<?php echo base_url() ?>assets/login/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/login/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>