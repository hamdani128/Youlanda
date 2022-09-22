<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.bootstrapdash.com/demo/melody/template/demo/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jun 2021 08:42:40 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Youlanda</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?=base_url()?>/assets/images/youlanda.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">



                            <div class="brand-logo">
                                <img src="<?=base_url()?>/assets/images/youlanda.png" alt="logo">
                            </div>
                            <h5>Youlanda - System Administrator</h5>
                            <h6 class="font-weight-light">Selamat Datang !</h6>
                            <form class="pt-3" action="/auth/check" method="POST" autocomplete="off">


                                <?php if (!empty(session()->getFlashdata('fail'))): ?>
                                <div class="alert alert-fill-danger" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    <?=session()->getFlashdata('fail');?>.
                                </div>
                                <?php elseif (!empty(session()->getFlashdata('warning'))): ?>
                                <div class="alert alert-fill-warning" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    <?=session()->getFlashdata('warning');?>.
                                </div>
                                <?php elseif (!empty(session()->getFlashdata('out'))): ?>
                                <div class="alert alert-fill-success" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    <?=session()->getFlashdata('out');?>.
                                </div>
                                <?php endif?>

                                <?=csrf_field()?>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg border-left-0"
                                            id="exampleInputEmail" placeholder="Username" name="username">
                                    </div>
                                    <span
                                        class="text-danger"><?=isset($validation) ? display_error($validation, 'username') : ''?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg border-left-0"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <span
                                        class="text-danger"><?=isset($validation) ? display_error($validation, 'password') : ''?></span>
                                </div>
                                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div> -->
                                <div class="my-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-small auth-form-btn">LOGIN</button>
                                </div>
                                <!-- <div class="mb-2 d-flex">
                                    <button type="button" class="btn btn-facebook auth-form-btn flex-grow mr-1">
                                        <i class="fab fa-facebook-f mr-2"></i>Facebook
                                    </button>
                                    <button type="button" class="btn btn-google auth-form-btn flex-grow ml-1">
                                        <i class="fab fa-google mr-2"></i>Google
                                    </button>
                                </div> -->
                                <!-- <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="register-2.html" class="text-primary">Create</a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy;
                            2018 All rights reserved.</p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?=base_url()?>/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?=base_url()?>/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?=base_url()?>/assets/js/off-canvas.js"></script>
    <script src="<?=base_url()?>/assets/js/hoverable-collapse.js"></script>
    <script src="<?=base_url()?>/assets/js/misc.js"></script>
    <script src="<?=base_url()?>/assets/js/settings.js"></script>
    <script src="<?=base_url()?>/assets/js/todolist.js"></script>
    <!-- endinject -->
</body>


<!-- Mirrored from www.bootstrapdash.com/demo/melody/template/demo/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jun 2021 08:42:40 GMT -->

</html>