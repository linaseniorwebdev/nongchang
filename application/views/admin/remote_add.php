<style>
	.preview-area {
		margin-left: auto;
		margin-right: auto;
		max-width: 750px;
	}

	video {
		width: 100%;
	}
</style>
<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header">
		</div>
		<div class="content-body">
			<div class="preview-area">
				<div class="card box-shadow-0 border-warning">
					<div class="card-header card-head-inverse bg-warning">
						<h4 class="card-title text-white">预览区域</h4>
						<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="card-content collapse show">
						<div class="card-body">
							<video id="preview" poster="public/img/thumb.jpg" controls playsInline webkit-playsinline autoplay>
								<source src="" type="" id="rtmp" />
								<source src="" type="application/x-mpegURL" id="hls" />
								<!-- <source src="" id="ws" /> -->
							</video>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header card-head-inverse bg-info">
						<h4 class="card-title text-white">频道信息</h4>
						<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="card-content collapse show">
						<div class="card-body">
							<div class="input-group mb-2">
								<input type="text" class="form-control" placeholder="频道ID" id="channel" />
								<div class="input-group-append">
									<button class="btn btn-primary" type="button" id="btn_preview">预览</button>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="频道标题" id="title" />
							</div>
							<div class="form-group mb-0 row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" value="" checked="" id="check_rtmp">
										RTMP
									</label>
									<label>
										<input type="checkbox" value="" checked="" id="check_hls">
										HLS
									</label>
									<label>
										<input type="checkbox" value="" id="check_ws">
										WS
									</label>
								</div>
								<div class="col-md-6 text-right">
									<button type="button" class="btn btn-success round btn-min-width box-shadow-1" id="submit">提交</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END::Content -->
