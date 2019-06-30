<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

	<title><?php echo $title; ?></title>

	<link rel="apple-touch-icon" href="public/images/ico/favicon.png">
	<link rel="shortcut icon" type="image/png" href="public/images/ico/favicon.png">

	<link rel="stylesheet" href="public/css/vendors.css" />
	<link rel="stylesheet" href="public/vendors/css/tables/datatable/datatables.min.css" />
	<link rel="stylesheet" href="public/vendors/css/tables/extensions/responsive.dataTables.min.css" />
	<link rel="stylesheet" href="public/vendors/css/tables/extensions/colReorder.dataTables.min.css" />
	<link rel="stylesheet" href="public/vendors/css/tables/extensions/buttons.dataTables.min.css" />
	<link rel="stylesheet" href="public/vendors/css/tables/datatable/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="public/vendors/css/tables/extensions/fixedHeader.dataTables.min.css" />
    <link rel="stylesheet" href="public/vendors/css/extensions/sweetalert.css" />
    <link rel="stylesheet" href="public/vendors/css/extensions/toastr.css" />

	<link rel="stylesheet" href="public/css/app.css" />
	<link rel="stylesheet" href="public/css/core/menu/menu-types/vertical-menu-modern.css" />
	<link rel="stylesheet" href="public/css/core/colors/palette-gradient.css" />
	<link rel="stylesheet" href="public/fonts/simple-line-icons/style.min.css" />
	<link rel="stylesheet" href="public/vendors/css/charts/jquery-jvectormap-2.0.3.css" />
	<link rel="stylesheet" href="public/vendors/css/forms/selects/select2.min.css" />
	<link rel="stylesheet" href="public/vendors/css/jasny-bootstrap/jasny-bootstrap.css" />
	<link rel="stylesheet" href="public/css/plugins/images/cropper/cropper.css">
	<link rel="stylesheet" href="public/css/plugins/animate/animate.css">
	<link rel="stylesheet" href="public/vendors/css/forms/selects/selectize.css">
	<link rel="stylesheet" href="public/vendors/css/forms/selects/selectize.default.css">

	<style>
		.header-navbar .navbar-container ul.nav li a.nav-link-search, .header-navbar .navbar-container ul.nav li a.nav-link-expand {
			padding: 1.6rem 1rem 1.7rem 1rem;
		}

		@media (max-width: 767.98px) {
			.header-navbar .navbar-header .navbar-brand {
				top: -8px;
			}
		}
	</style>

	<script src="public/vendors/js/vendors.min.js"></script>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
