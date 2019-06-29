var imageURL, videoFile, typeID, blockID;
var landnum, price, description, area;

$(document).ready(function() {
	imageURL = null;
	videoFile = null;

	$.post(
		"../../api/block/list",
		function(data) {
			data = JSON.parse(data);
			blockID = -1;
			$.each(data.blocks, function (i, v) {
				if (blockID < 0) blockID = v.id;
				var buffer = '<option value="' + v.id + '">' + v.name + '</option>';
				$("#select_block").append(buffer);
			});
			$("#select_block").select2({
				placeholder: "请选择区域",
				allowClear: false
			});
		}
	);

	$.post(
		"../../api/land/type/available",
		function(data) {
			data = JSON.parse(data);
			typeID = -1;
			$.each(data.types, function (i, v) {
				if (typeID < 0) typeID = v.id;
				var buffer = '<option value="' + v.id + '">' + v.value + '</option>';
				$("#select_type").append(buffer);
			});
			$("#select_type").select2({
				placeholder: "请选择类型",
				allowClear: false
			});
		}
	);
});

var Upload = function() {};

Upload.prototype.doUpload = function() {
	var that = this;
	var formData = new FormData();

	formData.append("image", imageURL);
	formData.append("video", videoFile);
	formData.append("landnum", landnum);
	formData.append("type", typeID);
	formData.append("block", blockID);
	formData.append("detail", description);
	formData.append("price", price);
	formData.append("area", area);

	$(".progress-area").fadeIn("fast");

	$.ajax({
		type: "POST",
		url: "../../api/upload/land",
		xhr: function () {
			var myXhr = $.ajaxSettings.xhr();
			if (myXhr.upload) {
				myXhr.upload.addEventListener('progress', that.progressHandling, false);
			}
			return myXhr;
		},
		success: function (data) {
			$(".progress-area").fadeOut("fast");
			console.log(data);
			data = JSON.parse(data);
			if (data.status == "success") {
				location.href = "all";
			} else {
				swal({
					title: "错误",
					text: "出了点问题。 请稍后再试。",
					type: "error",
					confirmButtonText: "确认"
				}).then(function(e) {
					location.reload();
				});
			}
		},
		error: function (error) {
			console.log('error');
		},
		async: true,
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	});
};

Upload.prototype.progressHandling = function (event) {
	var percent = 0;
	var position = event.loaded || event.position;
	var total = event.total;
	if (event.lengthComputable)
		percent = Math.ceil(position / total * 100);
	$("#upload_progress .progress-bar").css("width", percent + "%");
	$("#upload_progress .status").text(percent + "%");
};

$('.file-chooser-1').on('click', 'button', function () {
	$(".file-chooser-1 > .file-container").click();
	return false;
});

$('.file-chooser-1 > .file-container').on('change', function() {
	var file = $(this).prop('files')[0];
	var url = URL.createObjectURL(file);
	$(".img-container img").fadeIn().prop('src', url).cropper({
		viewMode: 1,
		aspectRatio: 4 / 3
	});
	$(".file-chooser-1").fadeOut("fast", function() {
		$(".file-confirm-1").fadeIn("fast");
	});
});

$(".file-confirm-1 button").click(function() {
	var cropper = $(".img-container img").data('cropper');
	var imageCanvas = cropper.getCroppedCanvas();
	imageURL = imageCanvas.toDataURL();
	$(".file-confirm-1").fadeOut("fast");
});

$('.file-chooser-2').on('click', 'button', function () {
	$(".file-chooser-2 > .file-container").click();
	return false;
});

$('.file-chooser-2 > .file-container').on('change', function() {
	videoFile = $(this).prop('files')[0];
	var url = URL.createObjectURL(videoFile);
	var buffer = '<source src="' + url + '" type="video/mp4">';
	$(".vid-container > video").empty().append(buffer);
});

$('#select_type').on('select2:select', function (e) {
	var data = e.params.data;
	typeID = data.id;
});

$('#select_block').on('select2:select', function (e) {
	var data = e.params.data;
	blockID = data.id;
});

function startUpload() {
	landnum = $("#landnum").val();
	if (landnum.length < 1) {
		swal("警告", "请输土地编号", "warning");
		return;
	}
	price = parseFloat($("#price").val());
	if (isNaN(price)) {
		swal("警告", "价格不正确", "warning");
		return;
	}
	description = $("#description").val();
	if (description.length < 1) {
		swal("警告", "请输入土地介绍", "warning");
		return;
	}
	area = parseFloat($("#area").val());
	if (isNaN(price)) {
		swal("警告", "面积不正确", "warning");
		return;
	}
	var upload = new Upload();
	upload.doUpload();
}