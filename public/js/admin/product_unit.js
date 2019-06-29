var table, curID, curValue;

$(document).ready(function() {
	table = $('#product_units').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "../../api/product/unit/list",
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
				width: '40px',
				render: function ( data, type, row ) {
					if (data == '使用中')
						return '<div class="badge badge-success round"><span>' + data + '</span></div>';
					else
						return '<div class="badge badge-secondary round"><span>' + data + '</span></div>';
				},
				orderable: false
			},
			{
				targets: [3],
				width: '140px',
				render: function ( data, type, row ) {
					if (row[2] == '使用中')
						buffer = '<input type="hidden" value="' + row[0] + '" /><button type="button" class="btn btn-danger round box-shadow-1" onclick="disable(this)">禁用</button>';
					else
						buffer = '<input type="hidden" value="' + row[0] + '" /><button type="button" class="btn btn-success round box-shadow-1" onclick="enable(this)">启用</button>';
					buffer += '<button type="button" class="btn btn-info round box-shadow-1 ml-1" onclick="change(this)">修改</button>';
					buffer += ('<input type="hidden" value="' + row[1] + '" />');
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
				'../../api/product/unit/update',
				{
					id: obj.previousElementSibling.value,
					usage: 1
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
				'../../api/product/unit/update',
				{
					id: obj.previousElementSibling.value,
					usage: 0
				},
				function (data) {
					table.ajax.reload( null, false );
					swal("更改成功!", "", "success");
				}
			);
		}
	});
}

function change(obj) {
	curID = obj.previousElementSibling.previousElementSibling.value;
	curValue = obj.nextElementSibling.value;
	$("#valueInput").val(curValue);
	$("#changeModal").modal("toggle");
}

function confirm() {
	$("#changeModal").modal("toggle");
	curValue = $("#valueInput").val();
	if (curValue.length > 0) {
		$.post(
			'../../api/product/unit/update',
			{
				id: curID,
				name: curValue
			},
			function (data) {
				table.ajax.reload( null, false );
				swal("更改成功!", "", "success");
			}
		);
	}
}

function addNew() {
	var value = $("#value").val();
	if (value.length < 1) {
		swal("警告", "请检查输入是否正确", "warning");
		return;
	}
	$.post(
		'../../api/product/unit/new',
		{
			value: value
		},
		function (data) {
			table.ajax.reload( null, false );
			swal("添加成功!", "", "success");
			$("#addModal").modal("toggle");
		}
	);
}
