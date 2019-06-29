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
</style>

<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-body">
			<div class="card">
				<div class="card-header card-head-inverse bg-blue">
					<h4 class="card-title text-white">认购订单</h4>
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
					<div class="card-body">
						<table class="table table-striped table-bordered" id="orders">
							<thead>
							<tr>
								<th>ID</th>
								<th>订单号</th>
								<th>买家</th>
								<th>土地编号</th>
								<th>价格</th>
								<th>支付</th>
								<th>订单日期</th>
								<th>状态</th>
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

<div class="modal fade text-left" id="modal_status" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">更新状态</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<h5>所有通道</h5>
					<select class="form-control" id="select_status">
						<!-- 0 - 待付款, 1 - 待发货, 2 - 待收货, 3 - 已完成, 4 - 已关闭 -->
						<option value="3">已完成</option>
						<option value="4">已关闭</option>
					</select>
				</div>
				<div class="form-group">
					<p class="text-muted">Textarea description text.</p>
					<textarea class="form-control" id="remark" rows="5" placeholder="Textarea with description"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-outline-primary" onclick="saveChanges()">保存</button>
			</div>
		</div>
	</div>
</div>