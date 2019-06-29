
$(document).ready(function() {
    table = $('#sell').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [],
        ajax: {
            url : "../../api/income/list",
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
                width: '52px',
                orderable: false
            },
            {
                targets: [2],
                width: '44px',
                render: function ( data, type, row ) {
                    return '¥' + row[5];
                },
                orderable: false
            },
            {
                targets: [3],
                width: '54px',
                render: function ( data, type, row ) {
                    return row[6];
                },
                orderable: false
            },
            {
                targets: [4],
                width: '44px',
                render: function ( data, type, row ) {
                    return '';
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
    table = $('#withdraw').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [],
        ajax: {
            url : "../../api/withdraw/list/1",
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
                orderable: false
            },
            // {
            //     targets: [8],
            //     width: '140px',
            //     render: function ( data, type, row ) {
            //         if (row[7] == 0){
            //             buffer = '<input type="hidden" value="' + row[0] + '" /><button type="button" class="btn btn-success round box-shadow-1" onclick="change(this)">同意</button>';
            //             buffer += '<button type="button" class="btn btn-danger round box-shadow-1 ml-1" onclick="disable(this)">拒绝</button>';
            //             buffer += ('<input type="hidden" value="' + row[1] + '" />');
            //         }
            //         return buffer;
            //     },
            //     orderable: false
            // }
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
