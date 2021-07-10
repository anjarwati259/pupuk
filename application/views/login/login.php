<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - PT Agrikultur Gemilang Indonesia</title>

    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/img/logo/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo base_url() ?>/assets/img/logo/favicon.ico">

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/css/style.css">
</head>
<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">

                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="<?php echo base_url() ?>assets/login/images/logo.png" alt="sing up image"></figure>
                    </div>
                    <div class="signin-form">
                        <!-- alert -->
                        <?php 
                        //notifikasi gagal login
                        if($this->session->flashdata('warning')){
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                            echo $this->session->flashdata('warning');
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>';
                          echo '</div>';
                        }else if($this->session->flashdata('sukses')){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                            echo $this->session->flashdata('sukses');
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>';
                          echo '</div>';
                        }
                        ?>

                        <h2 class="form-title">Login Member</h2>
                        <?php echo form_open(base_url('login'),'class="login100-form validate-form"') ?>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username" required="" />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" required="" />
                            </div>
                            <p>Tidak Punya Akun? <a href="<?php echo base_url('login/register') ?>" class="signup-image-link">Register</a></p>
                            
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>