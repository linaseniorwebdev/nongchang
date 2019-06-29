<style>
	div.dataTables_wrapper div.dataTables_filter label {
		margin-top: 0;
	}

	table.dataTable tbody td, th {
		vertical-align: middle;
		text-align: center;
	}

	.badge[class*='badge-'] span {
		bottom: 0;
		font-size: 1rem;
	}

	.content-wrapper table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before, .content-wrapper table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child:before {
		top: 50%;
		transform: translateY(-50%);
	}

	.rotate_180 {
		-moz-transform: rotate(180deg);
		-webkit-transform: rotate(180deg);
		-o-transform: rotate(180deg);
		-ms-transform: rotate(180deg);
		transform: rotate(180deg);
	}

	.png-arrow {
		width: 75%;
		position:absolute;
		left: 50%;
		top: 50%;
		-webkit-transform: translateX(-50%) translateY(-50%);
		-moz-transform:translateX(-50%) translateY(-50%);
		-ms-transform:translateX(-50%) translateY(-50%);
		-o-transform:translateX(-50%) translateY(-50%);
		transform:translateX(-50%) translateY(-50%);
	}

	.selected {
		border: 1px solid #1EB549 ;
	}
</style>

<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-body">
			<div class="card">
				<div class="card-header card-head-inverse bg-blue">
					<h4 class="card-title text-white">购买订单</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
							<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-header">
						<div class="row">
							<button class="order_status_btn" data-status="" style="background: #6b6f82;margin-left: 10px;border-radius: 5px;color: white;">全部</button>
							<button class="order_status_btn" data-status="0" id="pending_payment" style="background: #6b6f82;margin-left: 10px;border-radius: 5px;color: white;">待付款</button>
							<button class="order_status_btn" data-status="1" id="pending_delivery" style="background: #1e9ff2;margin-left: 10px;border-radius: 5px;color: white;">待发货</button>
							<button class="order_status_btn" data-status="2" id="pending_receipt" style="background: #666ee8;margin-left: 10px;border-radius: 5px;color: white;">待收货</button>
							<button class="order_status_btn" data-status="3" id="completed" style="background: #28d094;margin-left: 10px;border-radius: 5px;color: white;">已完成</button>
							<button class="order_status_btn" data-status="4" id="closed" style="background: #ff9149;margin-left: 10px;border-radius: 5px;color: white;">已关闭</button>
							<button class="order_status_btn" data-status="5" id="cancelled" style="background: #ff4961;margin-left: 10px;border-radius: 5px;color: white;">已取消</button>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-striped table-bordered" id="orders">
							<thead>
							<tr>
								<th>ID</th>
								<th>订单号</th>
								<th>买家</th>
								<th>商品列表</th>
								<th>支付</th>
								<th>运费</th>
								<th>优惠</th>
								<th class="order_status_column">状态</th>
								<th>订单日期</th>
								<th>发货地址</th>
								<th>备注</th>
								<th>操作</th>
							</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END::Content -->

<div class="modal animated slideInDown text-left" id="updateModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">更新订单状态</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div id="option1" class="selected p-1">
						<div class="row no-gutters">
							<div class="col-5">
								<div class="card mb-0">
									<div class="card-content">
										<div class="media align-items-stretch">
											<div class="p-2 bg-gradient-x-danger text-white media-body rounded-right text-center">
												<h5 class="text-white mb-0">New Users</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-2">
								<img class="png-arrow" src="public/img/arrow-green.png" draggable="false" />
							</div>
							<div class="col-5">
								<div class="card mb-0">
									<div class="card-content">
										<div class="media align-items-stretch">
											<div class="p-2 bg-gradient-x-danger text-white media-body rounded-left text-center rotate_180">
												<h5 class="text-white mb-0 rotate_180">New Users</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="option2" class="p-1">
						<div class="row no-gutters">
							<div class="col-5">
								<div class="card mb-0">
									<div class="card-content">
										<div class="media align-items-stretch">
											<div class="p-2 bg-gradient-x-danger text-white media-body rounded-right text-center">
												<h5 class="text-white mb-0">New Users</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-2">
								<img class="png-arrow" src="public/img/arrow-green.png" draggable="false" />
							</div>
							<div class="col-5">
								<div class="card mb-0">
									<div class="card-content">
										<div class="media align-items-stretch">
											<div class="p-2 bg-gradient-x-danger text-white media-body rounded-left text-center rotate_180">
												<h5 class="text-white mb-0 rotate_180">New Users</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group mb-0">
					<label for="remark">备注:</label>
					<textarea class="form-control" id="remark" rows="6" placeholder="请在这里留言" style="resize: none;"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-outline-primary" onclick="confirmUpdate()">确认</button>
			</div>
		</div>
	</div>
</div>

<div class="modal animated slideInDown text-left" id="logisticModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">更新订单状态</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group" style="padding: 15px;">
					<div class="row">
						<span style="line-height: 30px;">物流单号：</span>
						<input id="orderno" style="width: 60%;height: 30px;">
					</div>
					<div class="row mt-1">
						<span style="line-height: 30px;">订单号：</span>&emsp;
						<input id="orderno" style="width: 60%;height: 30px;">
					</div>
					<div class="row mt-1">
						<div class="col-sm-6">
							<div class="row">
								<span style="line-height: 30px;">支付：</span>
								<input id="total" style="width: 60%;height: 30px;">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<span style="line-height: 30px;">运费：</span>
								<input id="delivery" style="width: 60%;height: 30px;">
							</div>
						</div>						
					</div>
					<div class="row mt-1">
						<div class="col-sm-6">
							<div class="row">
								<span style="line-height: 30px;">优惠：</span>
								<input id="coupon" style="width: 60%;height: 30px;">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<span style="line-height: 30px;">状态：</span>
								<input id="status" style="width: 60%;height: 30px;">
							</div>
						</div>						
					</div>
				</div>
				<div class="form-group mb-0">
					<label for="remark">备注:</label>
					<textarea class="form-control" id="remark" rows="6" placeholder="请在这里留言" style="resize: none;"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-outline-primary" onclick="confirmLogistic()">确认</button>
			</div>
		</div>
	</div>
</div>

<div class="new_order_alarm" style="width: 56px;height: 56px;position: fixed;z-index: 999;right: 50px;bottom: 50px;background: #c5c0c0;border-radius: 50%;text-align: center;padding: 6px;cursor: pointer;">
	<i class="icon-bell purple font-large-2 float-right"></i>
	<div class="new_order_cnt" style="width: 20px;height: 20px;border-radius: 50%;position: absolute;top: -5px;right: 0px;background: red;text-align: center;color: white;">
		<span>1</span>
	</div>
</div>