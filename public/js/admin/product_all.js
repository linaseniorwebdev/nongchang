var table;

$(document).ready(function() {
	table = $('#product_all').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "../../api/product/all",
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
				render: function ( data, type, row ) {
					return '<img src="../../' + data + '" style="width: 48px; height: 40px;" />';
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
				render: function ( data, type, row ) {
					if (row[8] == null) {
						return '<span style="margin-left: 5px;">' + data + '</span>';
					}
					return '<img src="../../' + row[8] + '" style="width: 40px; height: 40px; border-radius: 50%;"><span style="margin-left: 5px;">' + data + '</span>';
				},
				orderable: false
			},
			{
				targets: [6],
				width: '40px',
				render: function (data, type, row) {
					if (data == 1) {
						return '<div class="badge badge-success round"><span>已启用</span></div>';
					} else {
						return '<div class="badge badge-secondary round"><span>已禁用</span></div>';
					}
				},
				orderable: false
			},
			{
				targets: [7],
				width: '130px',
				render: function (data, type, row) {
					var buffer = '<input type="hidden" value="' + row[0] + '" />';
					if (row[6] == 1)
						buffer += '<button type="button" class="btn btn-danger round box-shadow-1" onclick="disable(this)">禁用</button>';
					else
						buffer += '<button type="button" class="btn btn-success round box-shadow-1" onclick="enable(this)">启用</button>';
					buffer += '<button type="button" class="btn btn-secondary round box-shadow-1" onclick="remove(this)" style="margin-left: 10px;">删除</button>';
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

function enable(obj) {
	swal({
		title: "确定吗？",
		icon: "info",
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
				'../../api/product/update',
				{
					id: obj.previousElementSibling.value,
					status: 1
				},
				function (data) {
					table.ajax.reload( null, false );
					swal("更改成功!", "", "success");
				},
			);
		}
	});
}

function disable(obj) {
	swal({
		title: "确定吗？",
		text: "此优品将被禁用，无法使用。",
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
				'../../api/product/update',
				{
					id: obj.previousElementSibling.value,
					status: 0
				},
				function (data) {
					table.ajax.reload( null, false );
					swal("更改成功!", "", "success");
				},
			);
		}
	});
}

function remove(obj) {
	swal({
		title: "确定吗？",
		text: "此优品将被删除。",
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
				'../../api/product/update',
				{
					id: obj.previousElementSibling.previousElementSibling.value,
					status: 2
				},
				function (data) {
					table.ajax.reload( null, false );
					swal("更改成功!", "", "success");
				},
			);
		}
	});
}