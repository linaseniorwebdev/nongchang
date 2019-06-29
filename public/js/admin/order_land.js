let table, curValue, curLand;

$(document).ready(function() {
	let status = ['待付款', '待发货', '待收货', '已完成', '已关闭'];
	let colors = ['secondary', 'info', 'primary', 'success', 'danger'];
	table = $('#orders').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "../../api/order/land/list",
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
				orderable: false
			},
			{
				targets: [2],
				width: '70px',
				render: function ( data, type, row ) {
					return '<a href="javascript:void(0)" onclick="showUser(this)">' + data + '</a><input type="hidden" value="' + row[10] + '" />';
				},
				orderable: false
			},
			{
				targets: [3],
				render: function ( data, type, row ) {
					return '<a href="javascript:void(0)" onclick="showLand(this)">' + data + '</a><input type="hidden" value="' + row[11] + '" />';
				},
				orderable: false
			},
			{
				targets: [4],
				render: function ( data, type, row ) {
					return '¥' + data;
				},
				orderable: false
			},
			{
				targets: [5],
				render: function ( data, type, row ) {
					return '¥' + data;
				},
				orderable: false
			},
			{
				targets: [6],
				orderable: false
			},
			{
				targets: [7],
				render: function ( data, type, row ) {
					return '<div class="badge badge-' + colors[data] + ' round"><span>' + status[data] + '</span></div>';
				},
				orderable: false
			},
			{
				targets: [8],
				width: '150px',
				orderable: false
			},
			{
				targets: [9],
				render: function ( data, type, row ) {
					let buffer = '';
					if (row[7] > 2)
						return buffer;
					buffer += '<button type="button" class="btn btn-info round box-shadow-1" onclick="update(this)">更新</button>';
					buffer += ('<input type="hidden" value="' + row[0] + '" />');
					buffer += ('<input type="hidden" value="' + row[11] + '" />');
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

function update(obj) {
	curValue = obj.nextElementSibling.value;
	curLand = obj.nextElementSibling.nextElementSibling.value;
	$.post(
		'../../api/order/land/get',
		{
			id: curValue
		},
		function (data) {
			data = JSON.parse(data);
			$("#remark").val(data.remark);
			$("#modal_status").modal({backdrop: 'static', keyboard: false});
		}
	);
}

function saveChanges() {
	$.post(
		'../../api/order/land/update',
		{
			id: curValue,
			land: curLand,
			status: $("#select_status").val(),
			remark: $("#remark").val()
		},
		function (data) {
			console.log(data);
			table.ajax.reload(null, false);
			$("#modal_status").modal('toggle');
		}
	);
}