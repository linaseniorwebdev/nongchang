<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-body">
			<section id="minimal-statistics">
				<div class="row">
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="info"><?php echo $users['total']; ?></h3>
											<span>总用户</span>
										</div>
										<div class="align-self-center">
											<i class="icon-users info font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress mt-1 mb-0" style="height: 7px;">
										<div class="progress-bar bg-info" role="progressbar" style="width: <?php if ($users['total'] > 0) echo (double)$users['7days'] * 100.0 / (double)$users['total']; else echo '0'; ?>%"></div>
									</div>
									<div class="text-right pt-1">
										<span style="float: left;"><?php echo $users['7days']; ?></span>
										<span>过去7天</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="warning"><?php echo $products['total']; ?></h3>
											<span>总优品</span>
										</div>
										<div class="align-self-center">
											<i class="icon-support warning font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress mt-1 mb-0" style="height: 7px;">
										<div class="progress-bar bg-warning" role="progressbar" style="width: <?php if ($products['total'] > 0) echo (double)$products['7days'] * 100.0 / (double)$products['total']; else echo '0'; ?>%"></div>
									</div>
									<div class="text-right pt-1">
										<span style="float: left;"><?php echo $products['total']; ?></span>
										<span>过去7天</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="success"><?php echo $lands['total']; ?></h3>
											<span>总土地</span>
										</div>
										<div class="align-self-center">
											<i class="icon-directions success font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress mt-1 mb-0" style="height: 7px;">
										<div class="progress-bar bg-success" role="progressbar" style="width: <?php if ($lands['total'] > 0) echo (double)$lands['7days'] * 100.0 / (double)$lands['total']; else echo '0'; ?>%"></div>
									</div>
									<div class="text-right pt-1">
										<span style="float: left;"><?php echo $lands['7days']; ?></span>
										<span>认购</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="danger"><?php echo $orders['total']; ?></h3>
											<span>总订单</span>
										</div>
										<div class="align-self-center">
											<i class="icon-basket-loaded danger font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress mt-1 mb-0" style="height: 7px;">
										<div class="progress-bar bg-danger" role="progressbar" style="width: <?php if ($orders['total'] > 0) echo (double)$orders['7days'] * 100.0 / (double)$orders['total']; else echo '0'; ?>%"></div>
									</div>
									<div class="text-right pt-1">
										<span style="float: left;"><?php echo $orders['7days']; ?></span>
										<span>过去7天</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="purple darken-2"><?php echo $tasks['total']; ?></h3>
											<span>总任务</span>
										</div>
										<div class="align-self-center">
											<i class="icon-clock purple darken-2 font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress mt-1 mb-0" style="height: 7px;">
										<div class="progress-bar bg-purple bg-darken-2" role="progressbar" style="width: <?php if ($tasks['total'] > 0) echo (double)$tasks['7days'] * 100.0 / (double)$tasks['total']; else echo '0'; ?>%"></div>
									</div>
									<div class="text-right pt-1">
										<span style="float: left;"><?php echo $tasks['7days']; ?></span>
										<span>过去7天</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6 col-12">
						<div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="blue-grey darken-2"><i class="la la-cny"></i><?php echo number_format((double)$incomes['total'], 2); ?></h3>
											<span>总收入</span>
										</div>
										<div class="align-self-center">
											<i class="icon-wallet blue-grey darken-2 font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress mt-1 mb-0" style="height: 7px;">
										<div class="progress-bar bg-blue-grey bg-darken-2" role="progressbar" style="width: <?php if ($incomes['total'] > 0) echo (double)$incomes['7days'] * 100.0 / (double)$incomes['total']; else echo '0'; ?>%"></div>
									</div>
									<div class="text-right pt-1">
										<span style="float: left;"><i class="la la-cny"></i><?php echo number_format((double)$incomes['7days'], 2); ?></span>
										<span>过去7天</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!-- END::Content -->
