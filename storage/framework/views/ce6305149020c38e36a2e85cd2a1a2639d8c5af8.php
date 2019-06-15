<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
          <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="<?php echo e(asset('vendors/bootstrap/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendors/fontawesome/css/all.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendors/themify-icons/themify-icons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendors/linericon/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendors/owl-carousel/owl.theme.default.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendors/owl-carousel/owl.carousel.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                    <div id="app">
            <?php if(strpos($_SERVER['REQUEST_URI'],"admin") == true): ?>
            <app-admin></app-admin>
            <?php else: ?>
            <app-client></app-client>
               <?php endif; ?>
            </div>
        </div>
    </body>

       <script src="<?php echo e(mix('js/app.js')); ?>"></script>


  <script src="<?php echo e(asset('vendors/bootstrap/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/jquery/jquery-3.2.1.min.js')); ?>"></script>

  <script src="<?php echo e(asset('vendors/owl-carousel/owl.carousel.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jquery.ajaxchimp.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/mail-script.js')); ?>"></script>
  <script src="<?php echo e(asset('js/main.js')); ?>"></script>
</html>
