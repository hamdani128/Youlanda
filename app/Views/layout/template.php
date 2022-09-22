<?php

use Faker\Provider\Base;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$title;?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?=base_url()?>/assets/vendors/iconfonts/font-awesome/css/all.min.css" />
    <!-- End plugin css for this page -->
    <!-- Sweeatalert CSS -->
    <link rel="stylesheet" href="<?=base_url()?>/assets/js/sweetalert/sweetalert2.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/js/sweetalert/sweetalert2.min.css">

    <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?=base_url()?>/assets/images/youlanda.ico" />
    <!-- datatables -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <script src="<?=base_url()?>/assets/datatables.css"></script>
    <script src="<?=base_url()?>/assets/datatables.min.css"></script>
    <!-- Select -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- Jquery UI  -->
    <link rel="stylesheet" href="<?=base_url()?>/assets/js/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/js/jquery-ui/jquery-ui.structure.css">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?=$this->include('layout/topbar');?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <?=$this->include('layout/rightbar');?>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?=$this->include('layout/sidebar');?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?=$this->renderSection('content');?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?=$this->include('layout/footer');?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

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
    <!-- Custom js for this page-->
    <script src="<?=base_url()?>/assets/js/dashboard.js"></script>
    <!-- End custom js for this page-->
    <!-- Custom js for this page-->
    <script src="<?=base_url()?>/assets/js/data-table.js"></script>
    <!-- End custom js for this page-->
    <!-- Custom js for this page-->
    <script src="<?=base_url()?>/assets/js/form-validation.js"></script>
    <script src="<?=base_url()?>/assets/js/bt-maxLength.js"></script>
    <!-- End custom js for this page-->

    <!-- Custom js for this page-->
    <script src="<?=base_url()?>/assets/js/formpickers.js"></script>
    <script src="<?=base_url()?>/assets/js/form-addons.js"></script>
    <script src="<?=base_url()?>/assets/js/x-editable.js"></script>
    <script src="<?=base_url()?>/assets/js/dropify.js"></script>
    <script src="<?=base_url()?>/assets/js/dropzone.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery-file-upload.js"></script>
    <script src="<?=base_url()?>/assets/js/formpickers.js"></script>
    <script src="<?=base_url()?>/assets/js/form-repeater.js"></script>
    <script src="<?=base_url()?>/assets/script.js"></script>
    <script src="<?=base_url()?>/assets/script2.js"></script>
    <!-- End custom js for this page-->

    <!-- Sweetalert -->
    <script src="<?=base_url()?>/assets/js/sweetalert/sweetalert2.js"></script>
    <script src="<?=base_url()?>/assets/js/sweetalert/sweetalert2.all.js"></script>
    <script src="<?=base_url()?>/assets/js/sweetalert/sweetalert2.all.min.js"></script>
    <script src="<?=base_url()?>/assets/js/sweetalert/sweetalert2.min.js"></script>

    <!-- Custom js for this page-->
    <script src="<?=base_url()?>/assets/js/toastDemo.js"></script>
    <script src="<?=base_url()?>/assets/js/desktop-notification.js"></script>
    <!-- End custom js for this page-->
    <script src="<?=base_url()?>/assets/datatables.js"></script>
    <script src="<?=base_url()?>/assets/datatables.min.js"></script>
    <!-- datatable -->

    <!-- Juery UI -->
    <script src="<?=base_url()?>/assets/js/jquery-ui/jquery-ui.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
    <!-- End Jqeury -->
    <!-- Custom js for this page-->
    <script src="<?php base_url()?>/assets/js/file-upload.js"></script>
    <script src="<?php base_url()?>/assets/js/typeahead.js"></script>
    <script src="<?php base_url()?>/assets/js/select2.js"></script>
    <!-- End custom js for this page-->
    <!-- Custom js for this page-->
    <script src="<?=base_url()?>/assets/js/owl-carousel.js"></script>
    <!-- End custom js for this page-->

</body>

</html>