<style>
	label {
		padding-top: 10px;
		max-width: 200px !important;
		min-width: 200px !important;
	}

	input.form-control {
		max-width: 75px;
		text-align: right;
	}

	input.form-extend {
		max-width: 116px !important;
	}

	input.form-currency {
		max-width: 80px !important;
	}

	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
</style>
<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header">
			<h1 class="content-header-title">系统设置</h1>
		</div>
		<div class="content-body">
			<div class="card mt-3">
				<div class="card-block">
					<div class="card-body">
						<form action="<?php echo base_url('admin/system/other') ?>" method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-3" for="seller_fee">销售产品的佣金比率</label>
										<div class="col-7 input-group">
											<input type="number" class="form-control" id="seller_fee" name="seller_fee" value="<?php echo $system['seller_fee'] * 100; ?>" min="0" max="100" />
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">%</span>
											</div>
										</div>
										<p class="pl-5 mb-0 w-100" style="text-indent: 2em; color: blue; font-size: 0.8em; margin-top: 3px;">
											这个项目的说明
										</p>
									</div>
									<div class="form-group row">
										<label class="col-3" for="withdraw_fee">提款佣金率</label>
										<div class="col-7 input-group">
											<input type="number" class="form-control" id="withdraw_fee" name="withdraw_fee" value="<?php echo $system['withdraw_fee'] * 100; ?>" min="0" max="100" />
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">%</span>
											</div>
										</div>
										<p class="pl-5 mb-0 w-100" style="text-indent: 2em; color: blue; font-size: 0.8em; margin-top: 3px;">
											这个项目的说明
										</p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group mb-0">
										<button type="submit" class="btn btn-primary btn-min-width box-shadow-1 round">保存更改</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END::Content -->
