var cityID, cityName;

$(document).ready(function() {
	$("#province").select2({
		placeholder: "请选择省",
		allowClear: false
	});

	$("#cities").empty();
	$.post("../../api/city/list", {province: 1}, function(data) {
		data = JSON.parse(data);
		$.each(data.cities, function (i, v) {
			var buffer = '<div class="col-md-4 col-lg-4">';
			buffer += '<div class="card pull-up">';
			buffer += '<div class="card-content">';
			buffer += '<div class="media align-items-stretch">';
			buffer += '<div class="p-1 media-body text-left">';
			buffer += ('<h3 class="mb-0">' + v.name + '</h3>');
			buffer += '</div>';
			buffer += '<div class="p-1 text-center bg-success rounded-right">';
			buffer += ('<input type="hidden" value="' + v.id + '" />');
			buffer += '<a href="javascript:;" onclick="editThis(this)">';
			buffer += '<i class="icon-pencil font-medium-5 text-white"></i>';
			buffer += '</a></div></div></div></div></div>';
			$("#cities").append(buffer);
		});
	});
});

$('#province').on('select2:select', function (e) {
	var data = e.params.data;
	var id = data.id;
	$("#cities").empty();
	$.post("../../api/city/list", {province: id}, function(data) {
		data = JSON.parse(data);
		$.each(data.cities, function (i, v) {
			var buffer = '<div class="col-md-4 col-lg-4">';
			buffer += '<div class="card pull-up">';
			buffer += '<div class="card-content">';
			buffer += '<div class="media align-items-stretch">';
			buffer += '<div class="p-1 media-body text-left">';
			buffer += ('<h3 class="mb-0">' + v.name + '</h3>');
			buffer += '</div>';
			buffer += '<div class="p-1 text-center bg-success rounded-right">';
			buffer += ('<input type="hidden" value="' + v.id + '" />');
			buffer += '<a href="javascript:;" onclick="editThis(this)">';
			buffer += '<i class="icon-pencil font-medium-5 text-white"></i>';
			buffer += '</a></div></div></div></div></div>';
			$("#cities").append(buffer);
		});
	});
});

function editThis(obj) {
	cityID = obj.previousElementSibling.value;
	cityName = obj.parentElement.previousElementSibling.firstChild;
	$("#newName").val(cityName.innerHTML);
	$("#editbox").modal('toggle');
}

function confirm() {
	var newName = $("#newName").val();
	if (newName.length < 1) {
		swal("", "请正确输入名称。", "warning");
		return;
	}
	cityName.innerHTML = newName;
	$.post("../../api/city/update", {id: cityID, name: newName}, function(data) {
		$("#editbox").modal('toggle');
	});
}