var table;

$(document).ready(function() {
	table = $('#requests').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "../../api/product/request/all",
			type: "POST",
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
			}
		},
		columnDefs: [
			{
				targets: [0],
				width: '32px',
				orderable: false
			},
			{
				targets: [1],
				width: '100px',
				render: function ( data, type, row ) {
					return '<img src="../../' + row[7] + '" style="width: 40px; height: 40px;"><span style="margin-left: 5px;">' + data + '</span>';
				},
				orderable: false
			},
			{
				targets: [2],
				orderable: false
			},
			{
				targets: [3],
				orderable: false
			},
			{
				targets: [4],
				orderable: false
			},
			{
				targets: [5],
				width: '40px',
				render: function ( data, type, row ) {
					if (data == '批准的') {
						return '<div class="badge badge-success round"><span>' + data + '</span></div>';
					} else if (data == '拒绝了') {
						return '<div class="badge badge-danger round"><span>' + data + '</span></div>';
					} else {
						return '<div class="badge badge-secondary round"><span>' + data + '</span></div>';
					}
				},
				orderable: false
			},
			{
				targets: [6],
				width: '97px',
				render: function ( data, type, row ) {
					let buffer = '<input type="hidden" value="' + row[0] + '" />';
					if (row[5] == '待定') {
						buffer += '<button type="button" class="btn btn-info round box-shadow-1" style="margin-left: -15px;" onclick="approve(this)">批准</button>';
						buffer += '<button type="button" class="btn btn-secondary round box-shadow-1" style="margin-right: -15px; margin-left: 10px;" onclick="reject(this)">拒绝</button>';
					}
					return buffer;
				},
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
});

function approve(obj) {
	let id = obj.previousElementSibling.value;
	$.post(
		'../../api/product/request/update',
		{
			id: id,
			status: 1
		},
		function (data) {
			console.log(data);
			data = JSON.parse(data);
			if (data.status == "success") {
				table.ajax.reload( null, false );
				swal("操作成功", "", "success");
			}
		}
	);
}

function reject(obj) {
	let id = obj.previousElementSibling.previousElementSibling.value;
	$.post(
		'../../api/product/request/update',
		{
			id: id,
			status: 2
		},
		function (data) {
			console.log(data);
			data = JSON.parse(data);
			if (data.status == "success") {
				table.ajax.reload( null, false );
				swal("操作成功", "", "success");
			}
		}
	);
}