<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header">
		</div>
		<div class="content-body">
			<div class="row">
				<div class="col-md-4 col-lg-4">
					<div class="card">
						<div class="card-header card-head-inverse bg-info">
							<h4 class="card-title text-white">请选择省</h4>
							<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="card-content collapse show">
							<div class="card-body">
								<div class="form-group">
									<select class="select2 form-control" id="province">
										<?php
										$reversed = array_reverse($provinces);
										foreach ($reversed as $province) {
											if ($province['code'])
												echo '<option value="' . $province['id'] . '">' . $province['name'] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-4">
					<div class="card">
						<div class="card-header card-head-inverse bg-info">
							<h4 class="card-title text-white">请选择市</h4>
							<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
							<div class="heading-elements">
								<ul class="list-inline mb-0">
									<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="card-content collapse show">
							<div class="card-body">
								<div class="form-group">
									<select class="select2 form-control" id="city">

									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="districts">

			</div>
		</div>
	</div>
</div>
<!-- END::Content -->

<!-- BEGIN::Modal -->
<div class="modal fade text-left" id="editbox" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">编辑区名称</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset>
					<h5>请在这里输入区名称</h5>
					<div class="form-group">
						<input type="text" class="form-control" id="newName" />
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-outline-primary" onclick="confirm()">提交</button>
			</div>
		</div>
	</div>
</div>
<!-- END::Modal -->