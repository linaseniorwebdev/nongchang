<style>
	.image-preview {
		background-color: rgba(0, 0, 0, 0.0);
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
			<div class="content-header-left">
				<h1 class="content-header-title mb-0 d-inline-block ml-1">新增土地</h1>
			</div>
		</div>
		<div class="content-body pt-2">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">土地信息</h4>
				</div>
				<div class="card-body pt-1 pb-1">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row mb-0">
								<div class="col-md-6 mb-1">
									<input type="text" class="form-control" id="landnum" placeholder="编号" />
								</div>
								<div class="input-group col-md-6 mb-1">
									<div class="input-group-prepend">
										<span class="input-group-text">¥</span>
									</div>
									<input type="text" class="form-control" id="price" placeholder="价格" />
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="input-group col-md-6 mb-1">
									<div class="input-group-prepend">
										<span class="input-group-text">亩</span>
									</div>
									<input type="text" class="form-control" id="area" placeholder="面积" />
								</div>
								<div class="col-md-6 mb-1">
									<select class="select2 form-control" id="select_type">

									</select>
								</div>
							</div>
							<div class="form-group">
								<select class="select2 form-control" id="select_block">

								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<textarea type="text" class="form-control" id="description" placeholder="土地介绍" style="height: 148px; resize: none;"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">土地图</h4>
				</div>
				<div class="card-body pt-0 pb-1">
					<div class="img-container overflow-hidden image-preview mb-2">
						<img src="" alt="图片" style="display: none;" />
					</div>
					<div class="text-center file-chooser-1">
						<input type="file" accept="image/*" class="file-container" />
						<button type="button" class="btn btn-primary btn-glow box-shadow-1">选择图片</button>
					</div>
					<div class="text-center file-confirm-1" style="display: none;">
						<button type="button" class="btn btn-primary btn-glow box-shadow-1">确认</button>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">介绍视频</h4>
				</div>
				<div class="card-body pt-0 pb-1">
					<div class="vid-container mb-2">
						<video width="100%" controls>
							Your browser does not support the video tag.
						</video>
					</div>
					<div class="text-center file-chooser-2">
						<input type="file" accept="video/*" class="file-container" />
						<button type="button" class="btn btn-primary btn-glow box-shadow-1">选择视频</button>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body pt-2 pb-2">
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
					<div class="text-center">
						<button type="button" class="btn btn-primary btn-glow box-shadow-1" onclick="startUpload()">开始上传</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END::Content -->
