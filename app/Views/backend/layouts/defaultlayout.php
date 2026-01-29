	<!DOCTYPE html>
	<html lang="en" data-layout-mode="light_mode">


	<!-- Mirrored from dreamspos.dreamstechnologies.com/html/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Jun 2025 06:10:26 GMT -->

	<head>

		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Dreams POS is a powerful Bootstrap based Inventory Management Admin Template designed for businesses, offering seamless invoicing, project tracking, and estimates.">
		<meta name="keywords" content="inventory management, admin dashboard, bootstrap template, invoicing, estimates, business management, responsive admin, POS system">
		<meta name="author" content="Dreams Technologies">
		<meta name="robots" content="index, follow">
		<title>Dreams POS - Inventory Management & Admin Dashboard Template</title>

		<script src="<?php echo base_url('public/backend/js/theme-script.js') ?>" type="text/javascript"></script>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('public/backend/css/style1.css') ?>">
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/css/bootstrap-datetimepicker.min.css') ?>">

		<!-- animation CSS -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/css/animate.css') ?>">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/plugins/select2/css/select2.min.css') ?>">

		<!-- Daterangepikcer CSS -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/plugins/daterangepicker/daterangepicker.css') ?>">

		<!-- Tabler Icon CSS -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/plugins/tabler-icons/tabler-icons.min.css') ?>">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/plugins/fontawesome/css/fontawesome.min.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('public/backend/plugins/fontawesome/css/all.min.css') ?>">

		<!-- Color Picker Css -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/plugins/%40simonwep/pickr/themes/nano.min.css') ?>">

		<!-- Main CSS -->
		<link rel="stylesheet" href="<?php echo base_url('public/backend/css/style.css') ?>">

		<!-- jQuery -->
		<script src="<?php echo base_url('public/backend/js/jquery-3.7.1.min.js') ?>"></script>
		<!-- intl-tel-input CSS -->
		<script src="<?php echo base_url('public/backend/js/bootstrap.bundle.min.js') ?>" type="text/javascript"></script>


		<link rel="stylesheet" href="<?php echo base_url('public/backend/css/datatables.css') ?>">
		<script src="<?php echo base_url('public/backend/js/datatables.min.js') ?>"></script>
		<link rel="stylesheet" href="<?php echo base_url('public/backend/css/style1.css') ?>">

		<!-- Datatable -->


		<link rel="stylesheet" href="<?= base_url('public/backend/assets/js/tagify/tagify.css'); ?>" />

		<!-- intl-tel-input JS -->


<!-- Export dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


	</head>

	<body>




		<?= view("backend/elements/header"); ?>
		<?= view("backend/elements/sidebar"); ?>
		<?= view("backend/elements/background"); ?>

		<div class="page-wrapper">
			<?= $this->renderSection('content') ?>
		</div>

		<?= view("backend/elements/footer"); ?>



		<script src="<?= base_url('public/backend/assets/js/jquery-validate/jquery.validate.min.js'); ?>"></script>
		<script src="<?= base_url('public/backend/assets//js/jquery-validate/additional-methods.min.js'); ?>"></script>

		<script src="<?php echo base_url('public/backend/assets/js/sweetalert2.all.min.js') ?>"></script>

		<script src="<?php echo base_url('public/backend/js/script.js') ?>" type="text/javascript"></script>

		<!-- Feather Icon JS -->
		<script src="<?php echo base_url('public/backend/js/feather.min.js') ?>" type="text/javascript"></script>

		<!-- Slimscroll JS -->
		<script src="<?php echo base_url('public/backend/js/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>

		<!-- Bootstrap Core JS -->

		<!-- ApexChart JS -->
		<script src="<?php echo base_url('public/backend/plugins/apexchart/apexcharts.min.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>
		<script src="<?php echo base_url('public/backend/plugins/apexchart/chart-data.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>

		<!-- Chart JS -->
		<script src="<?php echo base_url('public/backend/plugins/chartjs/chart.min.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>
		<script src="<?php echo base_url('public/backend/plugins/chartjs/chart-data.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>

		<!-- Daterangepikcer JS -->
		<script src="<?php echo base_url('public/backend/js/moment.min.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>
		<script src="<?php echo base_url('public/backend/plugins/daterangepicker/daterangepicker.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>

		<!-- Select2 JS -->
		<script src="<?php echo base_url('public/backend/plugins/select2/js/select2.min.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>

		<!-- Color Picker JS -->
		<script src="<?php echo base_url('public/backend/plugins/%40simonwep/pickr/pickr.es5.min.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>
		<script src="<?= base_url('public/backend/assets/js/tagify/tagify.js'); ?>"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url('public/backend/js/theme-colorpicker.js') ?>" type="865edb14b8383387f5d447f6-text/javascript"></script>


		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



	</body>

	</html>