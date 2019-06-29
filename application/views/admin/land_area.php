<style>
	.image-preview {
		margin-left: auto;
		margin-right: auto;
		max-width: 640px;
		background-color: white;
		-webkit-box-shadow: 0 0 20px 10px rgba(0, 0, 0, 0.1);
		-moz-box-shadow: 0 0 20px 10px rgba(0, 0, 0, 0.1);
		box-shadow: 0 0 20px 10px rgba(0, 0, 0, 0.1);
	}

	.file-container {
		width: 0.1px;
		height: 0.1px;
		opacity: 0;
		overflow: hidden;
		position: absolute;
		z-index: -1;
	}

	.progress {
		border: 1px solid #0099CC;
		padding: 1px;
		position: relative;
		height: 32px;
		border-radius: 3px;
		text-align: left;
		background: #fff;
		box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
	}

	.progress .progress-bar {
		height: 100%;
		border-radius: 3px;
		background-color: #f39ac7;
		width: 0;
		box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
	}

	.progress .status {
		top: 50%;
		left: 50%;
		position: absolute;
		display: inline-block;
		color: #000000;
		transform: translateX(-50%) translateY(-50%);
	}
	
	.progress-area {
		display: none;
	}
</style>

<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-6 col-12">
				<h1 class="content-header-title mb-0 d-inline-block">所有注册的区域</h1>
			</div>
			<div class="content-header-right col-md-6 col-12">
				<div class="btn-group float-md-right">
					<button class="btn btn-info btn-glow round" type="button">
						<i class="la la-plus" style="font-size: 1rem;"></i><span> 添加区域</span>
					</button>
				</div>
			</div>
		</div>
		<div class="content-body mt-1">
			<div id="list_area" style="width: 100%;">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<select class="select2 form-control" id="list_province">
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
				<div class="row" id="real_list">
					<?php
					if (isset($data)) {
						foreach ($data as $row) {
							echo '<div class="col-xl-4 col-md-6 col-sm-12">';
							echo '<div class="card">';
							echo '<div class="card-content">';
							echo '<img class="card-img-top img-fluid" src="../../' . $row['picture'] . '" alt="封面">';
							echo '<div class="card-body">';
							echo '<h4 class="card-title">' . $row['name'] . '</h4>';
							echo '<p class="card-text">' . $row['description'] . '</p>';
							echo '<input type="hidden" value="' . $row['id'] . '" />';
							echo '<a href="#" class="btn btn-outline-pink">修改</a>';
							echo '</div></div></div></div>';
						}
					}
					?>
				</div>
			</div>
			<div id="add_area" style="display: none;">
				<div class="row progress-area">
					<div class="col-12">
						<div class="form-group m-form__group">
							<div class="progress" id="upload_progress" style="width: 100%;">
								<div class="progress-bar"></div>
								<div class="status">正在上传... 0%</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<select class="select2 form-control" id="add_province">
								<?php
								$reversed = array_reverse($provinces);
								foreach ($reversed as $province) {
									if ($province['code'])
										echo '<option value="' . $province['id'] . '">' . $province['name'] . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="add_name" placeholder="请输入区域名称" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<textarea type="text" class="form-control" id="add_description" placeholder="请输入区域详情" style="height: 93px; resize: none;"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="img-container overflow-hidden image-preview mt-2 mb-2">
							<img src="" alt="图片" style="display: none;" />
						</div>
						<div class="text-center file-chooser">
							<input type="file" accept="image/*" class="file-container" />
							<button type="button" class="btn btn-primary btn-glow box-shadow-1">选择图片</button>
						</div>
						<div class="text-center file-confirm" style="display: none;">
							<button type="button" class="btn btn-primary btn-glow box-shadow-1">确认</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END::Content -->
