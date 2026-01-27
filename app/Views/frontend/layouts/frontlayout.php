<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sona | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/font-awesome.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/elegant-icons.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/flaticon.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/owl.carousel.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/nice-select.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/jquery-ui.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/magnific-popup.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/slicknav.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('public/fe/css/style.css') ?>" type="text/css">
</head>
<?= view("frontend/elements/header"); ?>
  <?= view("frontend/elements/background"); ?>
  <?= $this->renderSection('frontend_content') ?>

  <?= view("frontend/elements/footer"); ?>
   <!-- Preloader -->
<script>
$(document).on('click','.bookingBtn',function(){
    $('#bookingCanvas').addClass('active');
    $('#canvasOverlay').addClass('active');
});

$(document).on('click','#closeBooking,#canvasOverlay',function(){
    $('#bookingCanvas').removeClass('active');
    $('#canvasOverlay').removeClass('active');
});
</script>
     </body>
</html>