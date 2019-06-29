<html class="loading" lang="en" data-textdirection="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

	<title>管理员登录</title>

	<link rel="apple-touch-icon" href="public/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="public/images/ico/favicon.ico">

	<link rel="stylesheet" type="text/css" href="public/css/vendors.css">
	<link rel="stylesheet" type="text/css" href="public/vendors/css/forms/icheck/icheck.css">
	<link rel="stylesheet" type="text/css" href="public/vendors/css/forms/icheck/custom.css">
	<link rel="stylesheet" type="text/css" href="public/css/app.css">
	<link rel="stylesheet" type="text/css" href="public/css/core/menu/menu-types/vertical-menu-modern.css">
	<link rel="stylesheet" type="text/css" href="public/css/core/colors/palette-gradient.css">
	<link rel="stylesheet" type="text/css" href="public/css/pages/login-register.css">

	<style>
		.form-control-position {
			top: 13px;
		}
	</style>
</head>
<body class="vertical-layout vertical-menu-modern 1-column bg-full-screen-image menu-expanded blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<section class="flexbox-container">
				<div class="col-12 d-flex align-items-center justify-content-center">
					<div class="col-md-4 col-10 box-shadow-2 p-0">
						<div class="card border-grey border-lighten-3 px-1 py-1 m-0">
							<div class="card-header border-0">
								<div class="card-title text-center">
									<!-- <img src="public/images/logo/logo-nczc.png" alt="branding logo"> -->
									<h2>觅菜园管理系统</h2>
								</div>
							</div>
							<?php
							if (isset($reason)) {
								if ($reason == 'nouser')
									echo '<span class="text-center" style="color: red;">账户不正确</span>';
								else
									echo '<span class="text-center" style="color: red;">密码不正确</span>';
							}
							?>
							<div class="card-content">
								<div class="card-body">
									<form class="form-horizontal" action="<?php echo base_url('admin/signin'); ?>" method="post">
										<fieldset class="form-group position-relative has-icon-left">
											<input type="text" class="form-control" name="username" placeholder="账户" value="<?php if (isset($username)) echo $username; ?>" />
											<div class="form-control-position">
												<i class="ft-user"></i>
											</div>
										</fieldset>
										<fieldset class="form-group position-relative has-icon-left">
											<input type="password" class="form-control" name="password" placeholder="密码" value="<?php if (isset($password)) echo $password; ?>" />
											<div class="form-control-position">
												<i class="la la-key"></i>
											</div>
										</fieldset>
										<button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> 登录</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<script src="public/vendors/js/vendors.min.js"></script>
</body>
</html>