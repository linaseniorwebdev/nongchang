<!-- BEGIN::Sidebar -->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<li class="nav-item <?php if ($com == 'index') echo 'active'; ?>">
				<a href="<?php if ($com == 'index') echo 'javascript:;'; else echo base_url('admin'); ?>">
					<i class="la la-home"></i>
					<span class="menu-title">控制台</span>
				</a>
			</li>
			<li class="nav-item <?php if ($com == 'users') echo 'active'; ?>">
				<a href="<?php if ($com == 'users') echo 'javascript:;'; else echo base_url('admin/users'); ?>">
					<i class="la la-users"></i>
					<span class="menu-title">用户管理</span>
				</a>
			</li>
			<li class="nav-item has-sub <?php if ($com == 'address') echo 'open'; ?>">
				<a href="javascript:;">
					<i class="la la-map-marker"></i>
					<span class="menu-title">地址管理</span>
				</a>
				<ul class="menu-content">
					<li class="<?php if ($com == 'address' && $sub == 'province') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'address' && $sub == 'province') echo 'javascript:;'; else echo base_url('admin/address/province'); ?>">省</a>
					</li>
					<li class="<?php if ($com == 'address' && $sub == 'city') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'address' && $sub == 'city') echo 'javascript:;'; else echo base_url('admin/address/city'); ?>">市</a>
					</li>
					<li class="<?php if ($com == 'address' && $sub == 'district') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'address' && $sub == 'district') echo 'javascript:;'; else echo base_url('admin/address/district'); ?>">区</a>
					</li>
				</ul>
			</li>
			<li class="nav-item has-sub <?php if ($com == 'land') echo 'open'; ?>">
				<a href="javascript:;">
					<i class="la la-map-o"></i>
					<span class="menu-title">土地管理</span>
				</a>
				<ul class="menu-content">
					<li class="<?php if ($com == 'land' && $sub == 'area') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'land' && $sub == 'area') echo 'javascript:;'; else echo base_url('admin/land/area'); ?>">区域管理</a>
					</li>
					<li class="<?php if ($com == 'land' && $sub == 'type') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'land' && $sub == 'type') echo 'javascript:;'; else echo base_url('admin/land/type'); ?>">土地类型</a>
					</li>
					<li class="<?php if ($com == 'land' && $sub == 'new') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'land' && $sub == 'new') echo 'javascript:;'; else echo base_url('admin/land/new'); ?>">新增土地</a>
					</li>
					<li class="<?php if ($com == 'land' && $sub == 'all') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'land' && $sub == 'all') echo 'javascript:;'; else echo base_url('admin/land/all'); ?>">所有土地</a>
					</li>
				</ul>
			</li>

			<li class="nav-item has-sub <?php if ($com == 'remote') echo 'open'; ?>">
				<a href="javascript:;">
					<i class="la la-video-camera"></i>
					<span class="menu-title">远程视频</span>
				</a>
				<ul class="menu-content">
					<li class="<?php if ($com == 'remote' && $sub == 'channels') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'remote' && $sub == 'channels') echo 'javascript:;'; else echo base_url('admin/remote/channels'); ?>">摄像频道</a>
					</li>
					<li class="<?php if ($com == 'remote' && $sub == 'add') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'remote' && $sub == 'add') echo 'javascript:;'; else echo base_url('admin/remote/add'); ?>">新增频道</a>
					</li>
				</ul>
			</li>

			<li class="nav-item has-sub <?php if ($com == 'task') echo 'open'; ?>">
				<a href="javascript:;">
					<i class="la la-calendar-check-o"></i>
					<span class="menu-title">任务管理</span>
				</a>
				<ul class="menu-content">
					<li class="<?php if ($com == 'task' && $sub == 'category') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'task' && $sub == 'category') echo 'javascript:;'; else echo base_url('admin/task/category'); ?>">任务类别</a>
					</li>
					<li class="<?php if ($com == 'task' && $sub == 'type') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'task' && $sub == 'type') echo 'javascript:;'; else echo base_url('admin/task/type'); ?>">任务类型</a>
					</li>
					<li class="<?php if ($com == 'task' && $sub == 'status') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'task' && $sub == 'status') echo 'javascript:;'; else echo base_url('admin/task/status'); ?>">任务状态</a>
					</li>
					<li class="<?php if ($com == 'task' && $sub == 'all') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'task' && $sub == 'all') echo 'javascript:;'; else echo base_url('admin/task/all'); ?>">所有任务</a>
					</li>
				</ul>
			</li>
			<li class="nav-item has-sub <?php if ($com == 'product') echo 'open'; ?>">
				<a href="javascript:;">
					<i class="la la-cubes"></i>
					<span class="menu-title">优品管理</span>
				</a>
				<ul class="menu-content">
					<li class="<?php if ($com == 'product' && $sub == 'unit') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'product' && $sub == 'unit') echo 'javascript:;'; else echo base_url('admin/product/unit'); ?>">优品单位</a>
					</li>
					<li class="<?php if ($com == 'product' && $sub == 'type') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'product' && $sub == 'type') echo 'javascript:;'; else echo base_url('admin/product/type'); ?>">优品类型</a>
					</li>
					<li class="<?php if ($com == 'product' && $sub == 'request') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'product' && $sub == 'request') echo 'javascript:;'; else echo base_url('admin/product/request'); ?>">入住请求</a>
					</li>
					<li class="<?php if ($com == 'product' && $sub == 'all') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'product' && $sub == 'all') echo 'javascript:;'; else echo base_url('admin/product/all'); ?>">所有优品</a>
					</li>
				</ul>
			</li>
			<li class="nav-item has-sub <?php if ($com == 'order') echo 'open'; ?>">
				<a href="javascript:;">
					<i class="la la-life-bouy"></i>
					<span class="menu-title">订单管理</span>
				</a>
				<ul class="menu-content">
					<li class="<?php if ($com == 'order' && $sub == 'product') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'order' && $sub == 'product') echo 'javascript:;'; else echo base_url('admin/order/product'); ?>">购买订单</a>
					</li>
					<li class="<?php if ($com == 'order' && $sub == 'land') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'order' && $sub == 'land') echo 'javascript:;'; else echo base_url('admin/order/land'); ?>">认购订单</a>
					</li>
				</ul>
			</li>
<!--			<li class="nav-item  --><?php //if ($com == 'delivery') echo 'active'; ?><!--">-->
<!--				<a href="--><?php //if ($com == 'delivery') echo 'javascript:;'; else echo base_url('admin/delivery'); ?><!--">-->
<!--					<i class="la la-truck"></i>-->
<!--					<span class="menu-title">赠送管理</span>-->
<!--				</a>-->
<!--			</li>-->
			<li class="nav-item has-sub <?php if ($com == 'wallet') echo 'open'; ?>">
				<a href="javascript:;">
					<i class="la la-money"></i>
					<span class="menu-title">钱包管理</span>
				</a>
				<ul class="menu-content">
					<li class="<?php if ($com == 'wallet' && $sub == 'income') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'wallet' && $sub == 'income') echo 'javascript:;'; else echo base_url('admin/wallet/income'); ?>">收入</a>
					</li>
					<li class="<?php if ($com == 'wallet' && $sub == 'withdraw') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'wallet' && $sub == 'withdraw') echo 'javascript:;'; else echo base_url('admin/wallet/withdraw'); ?>">退钱</a>
					</li>
				</ul>
			</li>
			<li class="nav-item has-sub <?php if ($com == 'system') echo 'open'; ?>">
				<a href="javascript:;">
					<i class="la la-gears"></i>
					<span class="menu-title">系统管理</span>
				</a>
				<ul class="menu-content">
<!--					<li class="--><?php //if ($com == 'system' && $sub == 'coupon') echo 'active'; ?><!--">-->
<!--						<a class="menu-item" href="--><?php //if ($com == 'system' && $sub == 'coupon') echo 'javascript:;'; else echo base_url('admin/system/coupon'); ?><!--">优惠券</a>-->
<!--					</li>-->
					<li class="<?php if ($com == 'system' && $sub == 'game') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'system' && $sub == 'game') echo 'javascript:;'; else echo base_url('admin/system/game'); ?>">游戏设定</a>
					</li>
					<li class="<?php if ($com == 'system' && $sub == 'wallet') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'system' && $sub == 'wallet') echo 'javascript:;'; else echo base_url('admin/system/wallet'); ?>">系统钱包</a>
					</li>
<!--					<li class="--><?php //if ($com == 'system' && $sub == 'ads') echo 'active'; ?><!--">-->
<!--						<a class="menu-item" href="--><?php //if ($com == 'system' && $sub == 'ads') echo 'javascript:;'; else echo base_url('admin/system/ads'); ?><!--">广告</a>-->
					</li>
					<li class="<?php if ($com == 'system' && $sub == 'other') echo 'active'; ?>">
						<a class="menu-item" href="<?php if ($com == 'system' && $sub == 'other') echo 'javascript:;'; else echo base_url('admin/system/other'); ?>">其他设定</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<!-- END::Sidebar -->