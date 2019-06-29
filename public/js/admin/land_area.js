var dataURL, name, description, province, city, district;
var list_province, list_city;

var Upload = function() {};

Upload.prototype.doUpload = function() {
	var that = this;
	var formData = new FormData();

	formData.append("picture", dataURL);
	formData.append("name", name);
	formData.append("description", description);
	formData.append("province", province);

	$(".progress-area").fadeIn("fast");

	$.ajax({
		type: "POST",
		url: "../../api/upload/block",
		xhr: function () {
			var myXhr = $.ajaxSettings.xhr();
			if (myXhr.upload) {
				myXhr.upload.addEventListener('progress', that.progressHandling, false);
			}
			return myXhr;
		},
		success: function (data) {
			$(".progress-area").fadeOut("fast");
			data = JSON.parse(data);
			if (data.status == "success") {
				location.reload();
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

$(document).ready(function() {
	dataURL = '';

	$("#add_province").select2({
		placeholder: "请选择省",
		allowClear: false
	});

	$("#list_province").select2({
		placeholder: "请选择省",
		allowClear: false
	});

	province = 1, list_province = 1;

	$(window).resize();
});

$('#add_province').on('select2:select', function (e) {
	var data = e.params.data;
	var id = data.id;
	province = id;
});

$('#list_province').on('select2:select', function (e) {
	var data = e.params.data;
	var id = data.id;
	console.log(id);
	list_province = id;
	list_blocks();
});

function list_blocks() {
	$("#real_list").empty();
	$.post(
		"../../api/block/list",
		{
			province: list_province,
			city: -1
		},
		function(data) {
			data = JSON.parse(data);
			console.log(data);
			$.each(data.blocks, function (i, v) {
				var buffer = '<div class="col-xl-4 col-md-6 col-sm-12">';
				buffer += ('<div class="card">');
				buffer += ('<div class="card-content">');
				buffer += ('<img class="card-img-top img-fluid" src="../../' + v.picture + '" alt="封面">');
				buffer += ('<div class="card-body">');
				buffer += ('<h4 class="card-title">' + v.name + '</h4>');
				buffer += ('<p class="card-text">' + v.description + '</p>');
				buffer += ('<input type="hidden" value="' + v.id + '" />');
				buffer += ('<a href="#" class="btn btn-outline-pink">修改</a>');
				buffer += ('</div></div></div></div>');
				$("#real_list").append(buffer);
			});
		}
	);
}

$(window).resize(function() {
	var width = parseInt($(".image-preview").css("width"));
	var height = parseInt(width * 3.0 / 4.0);
	$(".image-preview").css("height", height + "px");
});

$('.file-chooser').on('click', 'button', function () {
	$(".file-container").click();
	return false;
});

$('.file-container').on('change', function() {
	var file = $(this).prop('files')[0];
	var url = URL.createObjectURL(file);
	$(".img-container img").fadeIn().prop('src', url).cropper({
		viewMode: 1,
		aspectRatio: 16 / 9
	});
	$(".file-chooser").fadeOut("fast", function() {
		$(".file-confirm").fadeIn("fast");
	});
});

$(".file-confirm button").click(function() {
	var cropper = $(".img-container img").data('cropper');
	var imageCanvas = cropper.getCroppedCanvas();
	dataURL = imageCanvas.toDataURL();
	$(".file-confirm").fadeOut("fast");
});

$(".content-header-right .btn").click(function() {
	var itag = $(this).children("i").get(0);
	var spantag = $(this).children("span").get(0);
	if ($(itag).hasClass("la-plus") == true) {
		$(this).removeClass("btn-info");
		$(this).addClass("btn-success");
		$(itag).removeClass("la-plus");
		$(itag).addClass("la-check");
		$(spantag).text(" 提交");
		$("#list_area").fadeOut("fast", function() {
			$("#add_area").fadeIn("fast");
		});
	} else {
		name = $("#add_name").val();
		if (name.length < 1) {
			swal("警告", "请输入区域名称！", "warning");
			return;
		}
		description = $("#add_description").val();
		if (description.length < 1) {
			swal("警告", "请输入区域详情！", "warning");
			return;
		}
		if (dataURL.length < 1) {
			swal("警告", "请选择封面！", "warning");
			return;
		}
		var upload = new Upload();
		upload.doUpload();
		$(this).removeClass("btn-success");
		$(this).addClass("btn-info");
		$(itag).removeClass("la-check");
		$(itag).addClass("la-plus");
		$(spantag).text(" 添加区域");
		$("#add_area").fadeOut("fast", function() {
			$("#list_area").fadeIn("fast");
		});
	}
});