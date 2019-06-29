<style>
	div.dataTables_wrapper div.dataTables_filter label {
		margin-top: 0;
	}

	table.dataTable tbody td, th {
		vertical-align: middle;
	}

	.badge[class*='badge-'] span {
		bottom: 0;
		font-size: 1rem;
	}

	.table td {
		padding: 0.75rem 1.5rem;
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
					<button class="btn btn-info btn-glow round" type="button">
						<i class="la la-plus" style="font-size: 1rem;"></i><span> 添加</span>
					</button>
				</div>
			</div>
		</div>
		<div class="content-body pt-2">
			<div class="card">
				<div class="card-header card-head-inverse bg-blue">
					<h4 class="card-title text-white">所有土地</h4>
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
						<table class="table table-striped table-bordered" id="lands">
							<thead>
							<tr>
								<th>ID</th>
								<th>地图</th>
								<th>编号</th>
								<th>类型</th>
								<th>区域</th>
								<th>详情</th>
								<th>所有者</th>
								<th>出售日期</th>
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

<div class="modal fade text-left" id="channels" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">选择频道</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<h5>所有通道</h5>
					<select class="selectize-junk" id="select">
						<option value="" selected>Start Typing...</option>
						<?php
						foreach ($channels as $channel) {
							echo '<option value="' . $channel['id'] . '">' . $channel['title'] . '</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-outline-primary" onclick="saveChanges()">保存</button>
			</div>
		</div>
	</div>
</div>