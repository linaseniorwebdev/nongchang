<!-- BEGIN::Fixed Top Bar -->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
	<div class="navbar-wrapper">
		<div class="navbar-header">
			<ul class="nav navbar-nav flex-row position-relative">
				<li class="nav-item mobile-menu d-md-none mr-auto">
					<a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
						<i class="ft-menu font-large-1"></i>
					</a>
				</li>
				<li class="nav-item mr-auto">
					<a class="navbar-brand" href="<?php echo base_url('admin') ?>">
						<img class="brand-logo" alt="modern admin logo" src="public/images/logo/logo.png">
						<h3 class="brand-text">觅菜园</h3>
					</a>
				</li>
				<li class="nav-item d-none d-md-block nav-toggle">
					<a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
						<i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i>
					</a>
				</li>
				<li class="nav-item d-md-none">
					<a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
						<i class="la la-ellipsis-v"></i>
					</a>
				</li>
			</ul>
		</div>
		<div class="navbar-container content">
			<div class="collapse navbar-collapse" id="navbar-mobile">
				<ul class="nav navbar-nav mr-auto float-left">
					<li class="nav-item d-none d-md-block">
						<a class="nav-link nav-link-expand" href="#">
							<i class="ficon ft-maximize"></i>
						</a>
					</li>
				</ul>
				<ul class="nav navbar-nav float-right">
					<li class="dropdown dropdown-user nav-item">
						<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
							<span class="avatar avatar-online">
								<img src="<?php echo base_url('uploads/avatars/default.png') ?>" alt="avatar">
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">
								<i class="ft-user"></i> 账户管理
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?php echo base_url('admin/signout') ?>">
								<i class="ft-power"></i> 登出
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<!-- END::Fixed Top Bar -->