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
		<div class="content-header row">
			<div class="content-header-right col-12">
				<div class="btn-group float-right">
					<a href="<?php echo base_url('admin/product/new') ?>" class="btn btn-info btn-glow round"><i class="la la-plus" style="font-size: 1rem;"></i><span> 添加优品</span></a>
				</div>
			</div>
		</div>
		<div class="content-body pt-2">
			<div class="card">
				<div class="card-content">
					<div class="card-body">
						<table class="table table-striped table-bordered" id="product_all">
							<thead>
							<tr>
								<th>#</th>
								<th>图片</th>
								<th>优品类型</th>
								<th>优品名称</th>
								<th>更新日期</th>
								<th>所有者</th>
								<th>状态</th>
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

<div class="modal animated zoomIn text-left" id="viewModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-xs" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">修改名称</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="text" class="form-control" id="valueInput" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-outline-primary" onclick="confirm()">确认</button>
			</div>
		</div>
	</div>
</div>
