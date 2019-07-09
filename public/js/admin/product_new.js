var imageURL, categoryID, unitID;
var pname, pscale, price, delivery, stock, description, curObj, imageArray;

$(document).ready(function() {
	imageURL = null;
	videoFile = null;

	$.post(
		"../../api/product/unit/list",
		{
			search: {value: null},
			length: -1,
			draw: null
		},
		function(data) {
			data = JSON.parse(data);
			unitID = -1;
			$.each(data.data, function (i, v) {
				if (v[2] === "使用中") {
					if (unitID < 0) unitID = v[0];
					var buffer = '<option value="' + v[0] + '">' + v[1] + '</option>';
					$("#select_scale").append(buffer);
				}
			});
			$("#select_scale").select2({
				placeholder: "请选择规模",
				allowClear: false
			});
		}
	);

	$.post(
		"../../api/product/type/list",
		{
			search: {value: null},
			length: -1,
			draw: null
		},
		function(data) {
			data = JSON.parse(data);
			categoryID = -1;
			$.each(data.data, function (i, v) {
				if (v[2] === "使用中") {
					if (categoryID < 0) categoryID = v[0];
					var buffer = '<option value="' + v[0] + '">' + v[1] + '</option>';
					$("#select_category").append(buffer);
				}
			});
			$("#select_category").select2({
				placeholder: "请选择类别",
				allowClear: false
			});
		}
	);
});

var Upload = function() {};

Upload.prototype.doUpload = function() {
	var that = this;
	var formData = new FormData();

	formData.append("type", categoryID);
	formData.append("name", pname);
	formData.append("description", description);
	formData.append("scale", pscale);
	formData.append("unit", unitID);
	formData.append("price", price);
	formData.append("delivery", delivery);
	formData.append("stock", stock);
	formData.append("images", imageArray.join("%"));

	$(".progress-area").fadeIn("fast");

	$.ajax({
		type: "POST",
		url: "../../api/upload/product",
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
				location.href = "all";
			} else {
				swal({
					title: "错误",
					text: "出了点问题。 请稍后再试。",
					type: "error",
					confirmButtonText: "确认"
				}).then(function(e) {
					// location.reload();
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
	$(this).replaceWith($(this).val('').clone(true));
});

$(".file-confirm-1 button").click(function() {
	var cropper = $(".img-container img").data('cropper');
	var imageCanvas = cropper.getCroppedCanvas();
	imageURL = imageCanvas.toDataURL();
	$(".file-confirm-1").fadeOut("fast");
});

$('#select_category').on('select2:select', function (e) {
	var data = e.params.data;
	categoryID = data.id;
});

$('#select_scale').on('select2:select', function (e) {
	var data = e.params.data;
	unitID = data.id;
});

function startUpload() {
	pname = $("#name").val();
	if (pname.length < 1) {
		swal("警告", "请输入名称", "warning");
		return;
	}
	price = parseFloat($("#price").val());
	if (isNaN(price)) {
		swal("警告", "请输入价格", "warning");
		return;
	}
	description = $("#description").val();
	if (description.length < 1) {
		swal("警告", "请输入介绍", "warning");
		return;
	}
	delivery = parseFloat($("#delivery").val());
	if (isNaN(delivery)) {
		swal("警告", "请输入邮费", "warning");
		return;
	}
	pscale = parseFloat($("#scale").val());
	if (isNaN(pscale)) {
		swal("警告", "请输入规模", "warning");
		return;
	}
	stock = parseInt($("#stock").val());
	if (isNaN(stock)) {
		swal("警告", "请输入库存", "warning");
		return;
	}

	imageArray = [];
	let $images = $(".image-holder input:hidden");
	$images.each(function(index) {
		let blob = $(this).val();
		if (blob.length > 4) {
			imageArray.push(blob);
		}
	});

	if (imageArray.length < 1) {
		swal("警告", "请选择图片", "warning");
		return;
	}

	var upload = new Upload();
	upload.doUpload();
}

function addNewImage(obj) {
	if ($(obj).hasClass("image-full")) {
		let elem = obj.parentElement;
		swal({
			title: "确定吗？",
			icon: "warning",
			buttons: {
				cancel: {
					text: "取消",
					value: null,
					visible: true,
					className: "",
					closeModal: true,
				},
				confirm: {
					text: "确定",
					value: true,
					visible: true,
					className: "",
					closeModal: false
				}
			}
		}).then(isConfirm => {
			if (isConfirm) {
				$(elem).remove();
				swal("操作成功!", "", "success");
			}
		});
	} else {
		curObj = obj; imageURL = null;
		$(".img-container img").fadeOut().prop('src', '');
		$(".file-chooser-1").fadeIn("fast");
		$("#imageModal").modal({backdrop: 'static', keyboard: false});
	}
}

function useCurrent() {
	if (imageURL != null) {
		let buffer = '<div class="col-md-3 mb-2 image-holder">';
		buffer += '<div class="image-frame image-empty" onclick="addNewImage(this)">';
		buffer += '<div class="add-button">';
		buffer += '<img src="../public/img/add.png" alt="Add Button" draggable="false" style="width: 100%;" />';
		buffer += '</div>';
		buffer += '<div class="delete-button">';
		buffer += '<img src="../public/img/delete.png" alt="Delete Button" draggable="false" style="width: 100%;" />';
		buffer += '</div>';
		buffer += '</div>';
		buffer += '<input type="hidden" value="" />';
		buffer += '</div>';
		$(".images-area").append(buffer);
		$("#imageModal").modal("toggle");
		$(curObj).removeClass("image-empty").addClass("image-full");
		curObj.nextElementSibling.value = imageURL;
		$(curObj).css("background-image", "url('" + imageURL + "')");
		// $(".cropper-container").remove();
		$(".img-container img").cropper('destroy');
	} else {
		swal("请选择图片!", "", "warning");
	}
}