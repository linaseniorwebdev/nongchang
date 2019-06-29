<style>
	.border-primary label {
		padding-top: 10px;
		max-width: 200px !important;
		min-width: 200px !important;
	}

	.border-primary input.form-control {
		max-width: 75px;
		text-align: right;
	}

	.border-primary input.form-extend {
		max-width: 116px !important;
	}

	.border-primary input.form-currency {
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
		</div>
		<div class="content-body">
			<div class="card" style="width: 972px; margin-left: auto; margin-right: auto;">
				<div class="card-header card-head-inverse bg-blue">
					<h4 class="card-title text-white">在游戏中使用的卡</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="row">
							<?php
							$captions = array(null, '钻石', '四叶草', '水果1', '水果2', '水果3', '水果4', '水果5', '水果6');
							for ($i = 1; $i < 9; $i++) {
								echo '<div class="col text-center">';
								echo '<img draggable="false" style="width: 100%;" src="../../public/slot/img/0' . $i . '-alt.png"/>';
								echo '<span class="text-bold-700" ">“' . $captions[$i] .'”</span>';
								echo '</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="card border-danger" style="width: 972px; margin-left: auto; margin-right: auto;">
				<div class="card-header card-head-inverse bg-danger">
					<h4 class="card-title text-white">游戏奖金</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<?php $reward = json_decode($rewards[1], false); ?>
						<div class="row no-gutters">
							<div class="col-md-4">
								<h3 class="red">一 A级</h3>
								<p style="padding-left: 25px; color: blue;">（<b>“钻石”</b> X 3， 中奖概率：0.185％）</p>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<select class="form-control" id="a_type">
										<option value="-1"<?php if ($reward->type === 'none') echo ' selected=""'; ?>>【未分配】</option>
										<option value="1"<?php if ($reward->type === 'product') echo ' selected=""'; ?>>优品</option>
										<option value="2"<?php if ($reward->type === 'freespin') echo ' selected=""'; ?>>免费旋转</option>
										<option value="3"<?php if ($reward->type === 'coupon') echo ' selected=""'; ?>>优惠券</option>
										<option value="4"<?php if ($reward->type === 'point') echo ' selected=""'; ?>>积分</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 pl-2">
								<div class="form-group" id="a_product_id"<?php if ($reward->type !== 'product') echo ' style="display: none;"'; ?>>
									<select class="form-control">
										<option value="-1">【没有选择】</option>
										<?php
										foreach ($products as $product) {
											if ($product['id'] == $reward->product) {
												echo '<option value="' . $product['id'] . '" selected="">' . $product['name'] . '</option>';
											} else {
												echo '<option value="' . $product['id'] . '">' . $product['name'] . '</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="form-group" id="a_freespin_amount"<?php if ($reward->type !== 'freespin') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="a_coupon_amount"<?php if ($reward->type !== 'coupon') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="a_point_amount"<?php if ($reward->type !== 'point') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
							</div>
							<div class="col-md-3 pl-2">
								<div class="form-group" id="a_product_amount"<?php if ($reward->type !== 'product') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="a_coupon_expire"<?php if ($reward->type !== 'coupon') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" value="<?php echo $reward->expires; ?>" />
								</div>
							</div>
						</div>
						<?php $reward = json_decode($rewards[2], false); ?>
						<div class="row no-gutters">
							<div class="col-md-4">
								<h3 class="purple">一 B级</h3>
								<p style="padding-left: 25px; color: blue;">（<b>“四叶草”</b> X 3， 中奖概率：0.926％）</p>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<select class="form-control" id="b_type">
										<option value="-1"<?php if ($reward->type === 'none') echo ' selected=""'; ?>>【未分配】</option>
										<option value="1"<?php if ($reward->type === 'product') echo ' selected=""'; ?>>优品</option>
										<option value="2"<?php if ($reward->type === 'freespin') echo ' selected=""'; ?>>免费旋转</option>
										<option value="3"<?php if ($reward->type === 'coupon') echo ' selected=""'; ?>>优惠券</option>
										<option value="4"<?php if ($reward->type === 'point') echo ' selected=""'; ?>>积分</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 pl-2">
								<div class="form-group" id="b_product_id"<?php if ($reward->type !== 'product') echo ' style="display: none;"'; ?>>
									<select class="form-control">
										<option value="-1">【没有选择】</option>
										<?php
										foreach ($products as $product) {
											if ($product['id'] == $reward->product) {
												echo '<option value="' . $product['id'] . '" selected="">' . $product['name'] . '</option>';
											} else {
												echo '<option value="' . $product['id'] . '">' . $product['name'] . '</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="form-group" id="b_freespin_amount"<?php if ($reward->type !== 'freespin') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="b_coupon_amount"<?php if ($reward->type !== 'coupon') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="b_point_amount"<?php if ($reward->type !== 'point') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
							</div>
							<div class="col-md-3 pl-2">
								<div class="form-group" id="b_product_amount"<?php if ($reward->type !== 'product') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="b_coupon_expire"<?php if ($reward->type !== 'coupon') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" value="<?php echo $reward->expires; ?>" />
								</div>
							</div>
						</div>
						<?php $reward = json_decode($rewards[3], false); ?>
						<div class="row no-gutters">
							<div class="col-md-4">
								<h3 class="cyan">一 C级</h3>
								<p style="padding-left: 25px; color: blue;">（<b>“水果*”</b> X 3， 中奖概率：5.56％）</p>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<select class="form-control" id="c_type">
										<option value="-1"<?php if ($reward->type === 'none') echo ' selected=""'; ?>>【未分配】</option>
										<option value="1"<?php if ($reward->type === 'product') echo ' selected=""'; ?>>优品</option>
										<option value="2"<?php if ($reward->type === 'freespin') echo ' selected=""'; ?>>免费旋转</option>
										<option value="3"<?php if ($reward->type === 'coupon') echo ' selected=""'; ?>>优惠券</option>
										<option value="4"<?php if ($reward->type === 'point') echo ' selected=""'; ?>>积分</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 pl-2">
								<div class="form-group" id="c_product_id"<?php if ($reward->type !== 'product') echo ' style="display: none;"'; ?>>
									<select class="form-control">
										<option value="-1">【没有选择】</option>
										<?php
										foreach ($products as $product) {
											if ($product['id'] == $reward->product) {
												echo '<option value="' . $product['id'] . '" selected="">' . $product['name'] . '</option>';
											} else {
												echo '<option value="' . $product['id'] . '">' . $product['name'] . '</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="form-group" id="c_freespin_amount"<?php if ($reward->type !== 'freespin') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="c_coupon_amount"<?php if ($reward->type !== 'coupon') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="c_point_amount"<?php if ($reward->type !== 'point') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
							</div>
							<div class="col-md-3 pl-2">
								<div class="form-group" id="c_product_amount"<?php if ($reward->type !== 'product') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="c_coupon_expire"<?php if ($reward->type !== 'coupon') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" value="<?php echo $reward->expires; ?>" />
								</div>
							</div>
						</div>
						<?php $reward = json_decode($rewards[4], false); ?>
						<div class="row no-gutters">
							<div class="col-md-4">
								<h3 class="amber">一 D级</h3>
								<p style="padding-left: 25px; color: blue;">（<b>任何卡</b> X 2， 中奖概率：20.7％）</p>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<select class="form-control" id="d_type">
										<option value="-1"<?php if ($reward->type === 'none') echo ' selected=""'; ?>>【未分配】</option>
										<option value="1"<?php if ($reward->type === 'product') echo ' selected=""'; ?>>优品</option>
										<option value="2"<?php if ($reward->type === 'freespin') echo ' selected=""'; ?>>免费旋转</option>
										<option value="3"<?php if ($reward->type === 'coupon') echo ' selected=""'; ?>>优惠券</option>
										<option value="4"<?php if ($reward->type === 'point') echo ' selected=""'; ?>>积分</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 pl-2">
								<div class="form-group" id="d_product_id"<?php if ($reward->type !== 'product') echo ' style="display: none;"'; ?>>
									<select class="form-control">
										<option value="-1">【没有选择】</option>
										<?php
										foreach ($products as $product) {
											if ($product['id'] == $reward->product) {
												echo '<option value="' . $product['id'] . '" selected="">' . $product['name'] . '</option>';
											} else {
												echo '<option value="' . $product['id'] . '">' . $product['name'] . '</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="form-group" id="d_freespin_amount"<?php if ($reward->type !== 'freespin') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="d_coupon_amount"<?php if ($reward->type !== 'coupon') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="d_point_amount"<?php if ($reward->type !== 'point') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
							</div>
							<div class="col-md-3 pl-2">
								<div class="form-group" id="d_product_amount"<?php if ($reward->type !== 'product') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" placeholder="请输入数量" value="<?php echo $reward->amount; ?>" />
								</div>
								<div class="form-group" id="d_coupon_expire"<?php if ($reward->type !== 'coupon') echo ' style="display: none;"'; ?>>
									<input type="text" class="form-control" value="<?php echo $reward->expires; ?>" />
								</div>
							</div>
						</div>
						<div class="form-group mb-0 text-center">
							<button type="button" class="btn btn-outline-success round btn-min-width">保存</button>
						</div>
					</div>
				</div>
			</div>
			<div class="card border-primary" style="width: 972px; margin-left: auto; margin-right: auto;">
				<div class="card-header card-head-inverse bg-primary">
					<h4 class="card-title text-white">中奖概率乘数</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<form action="<?php echo base_url('admin/system/game') ?>" method="post">
							<div class="row no-gutters">
								<div class="col-6">
									<div class="form-group row">
										<label class="col-3" for="probability_common">中奖概率乘数（普通）</label>
										<div class="col-7 input-group">
											<input type="number" class="form-control" id="probability_common" name="probability_common" value="<?php echo $system['probability_common'] * 100; ?>" min="0" max="100" />
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">%</span>
											</div>
										</div>
										<p class="pl-5 mb-0 w-100" style="text-indent: 2em; color: blue; font-size: 0.8em; margin-top: 3px;">
											仅适用于普通会员
										</p>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group row">
										<label class="col-3" for="probability_special">中奖概率乘数（特别）</label>
										<div class="col-7 input-group">
											<input type="number" class="form-control" id="probability_special" name="probability_special" value="<?php echo $system['probability_special'] * 100; ?>" min="0" max="100" />
											<div class="input-group-append">
												<span class="input-group-text" id="basic-addon2">%</span>
											</div>
										</div>
										<p class="pl-5 mb-0 w-100" style="text-indent: 2em; color: blue; font-size: 0.8em; margin-top: 3px;">
											仅适用于购买土地的会员
										</p>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group mb-0 text-center">
										<button type="submit" class="btn btn-primary btn-min-width box-shadow-1 round">保存</button>
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
