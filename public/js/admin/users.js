var table;

$(document).ready(function() {
	table = $('#users').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "../api/user/list",
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
				width: '44px',
				render: function ( data, type, row ) {
					if (data == null)
						return '<img src="../uploads/avatars/default.png" style="width: 40px; height: 40px;" />';
					else
						return '<img src="../' + data + '" style="width: 40px; height: 40px;" />';
				},
				orderable: false
			},
			{
				targets: [6],
				width: '44px',
				render: function ( data, type, row ) {
					if (data == '有效')
						return '<div class="badge badge-success round"><span>' + data + '</span></div>';
					else
						return '<div class="badge badge-secondary round"><span>' + data + '</span></div>';
				},
				orderable: false
			},
			{
				targets: [7],
				width: '44px',
				render: function ( data, type, row ) {
					if (row[6] == '有效')
						return '<input type="hidden" value="' + row[0] + '" /><button type="button" class="btn btn-danger round box-shadow-1" onclick="disable(this)">禁用</button>';
					else
						return '<input type="hidden" value="' + row[0] + '" /><button type="button" class="btn btn-success round box-shadow-1" onclick="enable(this)">启用</button>';
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
				'../api/user/update',
				{
					id: obj.previousElementSibling.value,
					status: 1
				},
				function (data) {
					table.ajax.reload( null, false );
					swal("更改成功!", "", "success");
				}
			);
		}
	});
}

function disable(obj) {
	swal({
		title: "确定吗？",
		text: "此用户将被禁用，无法使用。",
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
				'../api/user/update',
				{
					id: obj.previousElementSibling.value,
					status: 0
				},
				function (data) {
					table.ajax.reload( null, false );
					swal("更改成功!", "", "success");
				}
			);
		}
	});
}

// app.js, ln 114
$('a[data-action="reload"]').on('click',function() {
	var block_ele = $(this).closest('.card');

	table.ajax.reload( null, false );

	// Block Element
	block_ele.block({
		message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
		timeout: 2000, //unblock after 2 seconds
		overlayCSS: {
			backgroundColor: '#FFF',
			cursor: 'wait',
		},
		css: {
			border: 0,
			padding: 0,
			backgroundColor: 'none'
		}
	});
});