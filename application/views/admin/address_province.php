<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header">
		</div>
		<div class="content-body">
			<div class="card">
				<div class="card-header card-head-inverse bg-success">
					<h4 class="card-title text-white">省列表</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="height-600" id="china"></div>
						<h3 class="pt-2">详情</h3>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="请输入名称..." id="detail" readonly />
							<div class="input-group-append">
								<button class="btn btn-primary" type="button" style="padding: .65rem 1rem;" onclick="doEdit(this)"><i class="la la-pencil"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END::Content -->
