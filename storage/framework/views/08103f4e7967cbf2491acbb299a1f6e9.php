<!-- This layout is for home page and documentations -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>e-filing</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        />
        <!-- Font Awesome Icons -->
        <link
            rel="stylesheet"
            href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>"
        />
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo e(asset('css/adminlte.min.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/mystyle.css')); ?>" />
    </head>

    <body class="hold-transition layout-top-nav">
        <?php echo e($slot); ?>

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="<?php echo e(asset('/vendor/jquery/jquery.min.js')); ?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo e(asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo e(asset('/js/adminlte.min.js')); ?>"></script>
    </body>
</html>
<?php /**PATH /Users/shenam/efilingupdate/resources/views/layouts/home.blade.php ENDPATH**/ ?>