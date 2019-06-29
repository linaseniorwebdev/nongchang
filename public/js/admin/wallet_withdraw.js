var table;

$(document).ready(function() {
	table = $('#users').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "../../api/withdraw/list",
			type: "POST",
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
			}
		},
		columnDefs: [
			{
				targets: [3],
				width: '32px',
                render: function ( data, type, row ) {
					return '<span>￥' + Number.parseFloat(data).toFixed(2) + '</span>';
                },
				orderable: false
			},
			{
				targets: [4],
				width: '44px',
                render: function ( data, type, row ) {
                    return '<span>￥' + Number.parseFloat(data).toFixed(2) + '</span>';
                },
				orderable: false
			},
            {
                targets: [5],
                width: '44px',
                render: function ( data, type, row ) {
                    return '<span>￥' + Number.parseFloat(data).toFixed(2) + '</span>';
                },
                orderable: false
            },
			{
				targets: [7],
				width: '44px',
				render: function ( data, type, row ) {
					if (data == 0)
						return '<div class="badge badge-warning round"><span>' + '正在审查中' + '</span></div>';
					else if (data == 1)
						return '<div class="badge badge-success round"><span>' + '提現' + '</span></div>';
					else
                        return '<div class="badge badge-secondary round"><span>' + '取消' + '</span></div>';
				},
				orderable: false
			},
			{
				targets: [8],
				width: '140px',
				render: function ( data, type, row ) {
                    let buffer = '';
                    if (row[7] == 0){
                        buffer = '<input type="hidden" value="' + row[0] + '" /><button type="button" class="btn btn-success round box-shadow-1" onclick="approve(this)">同意</button>';
                    	buffer += '<button type="button" class="btn btn-danger round box-shadow-1 ml-1" onclick="reject(this)">拒绝</button>';
                    	buffer += ('<input type="hidden" value="' + row[1] + '" />');
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
        '../../api/withdraw/update',
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
        '../../api/withdraw/update',
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