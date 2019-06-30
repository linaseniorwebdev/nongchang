let table, selectize, land;

$(document).ready(function() {
	table = $('#lands').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "../../api/land/list",
			type: "POST",
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
			}
		},
		columnDefs: [
			{
				targets: [0],
				width: '20px',
				className: 'text-center',
				orderable: false
			},
			{
				targets: [1],
				width: '32px',
				render: function ( data, type, row ) {
					return '<img src="../../' + data + '" style="width: 80px;" />';
				},
				className: 'text-center',
				orderable: false
			},
			{
				targets: [2],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [3],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [4],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [5],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [6],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [7],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [8],
				width: '32px',
				className: 'text-center',
				render: function ( data, type, row ) {
					return data;
				},
				orderable: false
			},
			{
				targets: [9],
				width: '140px',
				render: function ( data, type, row ) {
					let buffer = '<button type="button" class="btn btn-info round box-shadow-1" onclick="linkto(this)">链接通道</button>';
					buffer += ('<input type="hidden" value="' + row[0] + '" />');
					buffer += ('<button type="button" class="btn btn-danger round box-shadow-1" onclick="remove(this)" style="margin-left: 10px;">删除</button>');
					return buffer;
				},
				className: 'text-center',
				orderable: false
			}
		],
		language: {
			"decimal":        "",
			"emptyTable":     "没有数据",
			"info":           "显示_START_到_END_的_TOTAL_个条目",
			"infoEmpty":      "显示0个条目中的0到0",
			"infoFiltered":   "(从_MAX_总条目中过滤掉)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "显示_MENU_条目",
			"loadingRecords": "载入中...",
			"processing":     "处理中...",
			"search":         "搜索:",
			"zeroRecords":    "没有找到匹配的记录",
			"paginate": {
				"first":      "最初",
				"last":       "最后",
				"next":       "下一页",
				"previous":   "上一页"
			},
			"aria": {
				"sortAscending":  ": 激活以对列升序进行排序",
				"sortDescending": ": 激活以按列降序排序"
			}
		}
	});

	let $select = $(".selectize-junk").selectize({
		maxItems: null,
		maxOptions: 50,
		valueField: 'id',
		labelField: 'title',
		searchField: 'title',
		sortField: 'title',
		// options: options,
		create: false
	});

	selectize = $select[0].selectize;
});

$(".content-header-right .btn").click(function() {
	location.href = "new";
});

function linkto(obj) {
	land = obj.nextElementSibling.value;
	$.post(
		'../../api/binding/list',
		{
			land: land
		},
		function (data) {
			data = JSON.parse(data);
			selectize.setValue(data);
			$("#channels").modal({backdrop: 'static', keyboard: false});
		}
	);
}

function saveChanges() {
	let sels = selectize.getValue();
	let ids = sels.join(",");
	$.post(
		'../../api/binding/update',
		{
			land: land,
			ids: ids
		},
		function (data) {
			$("#channels").modal('toggle');
		}
	);
}

function remove(obj) {
	swal({
		title: "确定吗？",
		text: "此土地将被删除。",
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
			$.post(
				'../../api/land/update',
				{
					id: obj.previousElementSibling.value,
					status: 0
				},
				function (data) {
					data = JSON.parse(data);
					if (data.status === "success") {
						table.ajax.reload( null, false );
						swal("更改成功!", "", "success");
					} else {
						swal(data.reason, "", "warning");
					}
				},
			);
		}
	});
}