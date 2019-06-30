let table, status, colors, curID, curState, curOption;

$(document).ready(function() {
	status = ['待付款', '待发货', '待收货', '已完成', '已关闭', '已取消'];
	colors = ['secondary', 'info', 'primary', 'success', 'warning', 'danger'];
	status[51] = '请求取消(待发货)';
	status[52] = '请求取消(待收货)';
	colors[51] = 'warning';
	colors[52] = 'warning';
	table = $('#orders').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		ajax: {
			url : "../../api/order/product/list",
			type: "POST",
			data:{"status": ""},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
			}
		},
		columnDefs: [
			{
				targets: [0],
				orderable: false
			},
			{
				targets: [1],
				orderable: false
			},
			{
				targets: [2],
				render: function ( data, type, row ) {
					return '<a href="javascript:void(0)" onclick="showUser(this)">' + data + '</a><input type="hidden" value="' + row[12] + '" />';
				},
				orderable: false
			},
			{
				targets: [3],
				width: '150px',
				render: function ( data, type, row ) {
					return '<a href="javascript:void(0)" onclick="showProduct(this)">' + data + '</a><input type="hidden" value="' + row[13] + '" />';
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
				render: function ( data, type, row ) {
					return '¥' + data;
				},
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
				orderable: false
			},
			{
				targets: [9],
				orderable: false
			},
			{
				targets: [10],
				orderable: false
			},
			{
				targets: [11],
				render: function ( data, type, row ) {
					let buffer = '';
					buffer += '<button type="button" class="btn btn-warning round box-shadow-1" onclick="order_detail(' + row[0] + ')">详情</button>';
					if (row[7] > 2 && row[7] < 6)
						return buffer;
					if (row[7] == 0)
						return buffer;
					buffer += '<button type="button" class="btn btn-info round box-shadow-1" onclick="update(this)" style="margin-left: 10px;">更新</button>';
					buffer += ('<input type="hidden" value="' + row[0] + '" />');
					buffer += ('<input type="hidden" value="' + row[7] + '" />');
					buffer += ('<input type="hidden" value="' + row[10] + '" />');
					if (row[7] == 1) {
						buffer += '<button type="button" class="btn btn-success round box-shadow-1" onclick="logistic_order(' + row[0] + ')" style="margin-left: 10px;">物流</button>';
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

	$(".order_status_btn").on("click", get_order_by_status );

});

function get_order_by_status(){
	var status = $(this).data("status");

	table.columns('.order_status_column').every(function() {
	    var that = this;
	    that.search(status).draw();
	});
}

function order_detail(order_id) {
	location.href = '../order/detail/' + order_id;
}

function update(obj) {
	curID = parseInt(obj.nextElementSibling.value);
	curState = parseInt(obj.nextElementSibling.nextElementSibling.value);
	$("#remark").val(obj.nextElementSibling.nextElementSibling.nextElementSibling.value);
	curOption = curState + 1;

	if (curState > 5) {
		$("#option1").fadeOut("fast");
		$("#option2").click();
	} else {
		$("#option1").fadeIn("fast").click();
	}

	let $st_div_1 = $("#option1 .media:eq(0) > div");
	let $st_div_2 = $("#option1 .media:eq(1) > div");
	let $st_txt_1 = $("#option1 .media:eq(0) > div > h5");
	let $st_txt_2 = $("#option1 .media:eq(1) > div > h5");
	let $ed_div_1 = $("#option2 .media:eq(0) > div");
	let $ed_div_2 = $("#option2 .media:eq(1) > div");
	let $ed_txt_1 = $("#option2 .media:eq(0) > div > h5");
	let $ed_txt_2 = $("#option2 .media:eq(1) > div > h5");
	let classes   = null;

	switch (curState) {
		case 0:
			classes = $st_div_1.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$st_div_1.removeClass(v);
			});
			$st_div_1.addClass('bg-gradient-x-blue-grey');
			$st_txt_1.html(status[0]);

			classes = $st_div_2.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$st_div_2.removeClass(v);
			});
			$st_div_2.addClass('bg-gradient-x-' + colors[1]);
			$st_txt_2.html(status[1]);

			classes = $ed_div_1.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_1.removeClass(v);
			});
			$ed_div_1.addClass('bg-gradient-x-blue-grey');
			$ed_txt_1.html(status[0]);

			classes = $ed_div_2.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_2.removeClass(v);
			});
			$ed_div_2.addClass('bg-gradient-x-' + colors[5]);
			$ed_txt_2.html(status[5]);
			break;
		case 1:
			classes = $st_div_1.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$st_div_1.removeClass(v);
			});
			$st_div_1.addClass('bg-gradient-x-' + colors[1]);
			$st_txt_1.html(status[1]);

			classes = $st_div_2.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$st_div_2.removeClass(v);
			});
			$st_div_2.addClass('bg-gradient-x-' + colors[2]);
			$st_txt_2.html(status[2]);

			classes = $ed_div_1.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_1.removeClass(v);
			});
			$ed_div_1.addClass('bg-gradient-x-' + colors[1]);
			$ed_txt_1.html(status[1]);

			classes = $ed_div_2.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_2.removeClass(v);
			});
			$ed_div_2.addClass('bg-gradient-x-' + colors[5]);
			$ed_txt_2.html(status[5]);
			break;
		case 2:
			classes = $st_div_1.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$st_div_1.removeClass(v);
			});
			$st_div_1.addClass('bg-gradient-x-' + colors[2]);
			$st_txt_1.html(status[2]);

			classes = $st_div_2.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$st_div_2.removeClass(v);
			});
			$st_div_2.addClass('bg-gradient-x-' + colors[3]);
			$st_txt_2.html(status[3]);

			classes = $ed_div_1.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_1.removeClass(v);
			});
			$ed_div_1.addClass('bg-gradient-x-' + colors[2]);
			$ed_txt_1.html(status[2]);

			classes = $ed_div_2.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_2.removeClass(v);
			});
			$ed_div_2.addClass('bg-gradient-x-' + colors[5]);
			$ed_txt_2.html(status[5]);
			break;
		case 51:
			classes = $ed_div_1.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_1.removeClass(v);
			});
			$ed_div_1.addClass('bg-gradient-x-' + colors[1]);
			$ed_txt_1.html(status[1]);

			classes = $ed_div_2.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_2.removeClass(v);
			});
			$ed_div_2.addClass('bg-gradient-x-' + colors[5]);
			$ed_txt_2.html(status[5]);
			break;
		case 52:
			classes = $ed_div_1.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_1.removeClass(v);
			});
			$ed_div_1.addClass('bg-gradient-x-' + colors[2]);
			$ed_txt_1.html(status[2]);

			classes = $ed_div_2.attr("class").split(" ");
			$.each(classes, function(i, v) {
				if (v.indexOf('bg-') >= 0)
					$ed_div_2.removeClass(v);
			});
			$ed_div_2.addClass('bg-gradient-x-' + colors[5]);
			$ed_txt_2.html(status[5]);
			break;
		default:
			break;
	}
	$("#updateModal").modal({backdrop: 'static', keyboard: false});
}

function logistic_order(row){
	$("#logisticModal").modal({backdrop: 'static', keyboard: false});
	console.log(row[1]);
}

function confirmUpdate() {
	$.post(
		'../../api/order/product/update',
		{
			id: curID,
			prev: curState,
			status: curOption,
			remark: $("#remark").val()
		},
		function (data) {
			table.ajax.reload( null, false );
			swal("处理成功!", "", "success");
			$("#updateModal").modal("toggle");
		}
	);
}

function confirmLogistic() {
	// $.post(
	// 	'../../api/order/product/create_trade_no',
	// 	{
	// 		id: order_id
	// 	},
	// 	function (data) {
	// 		swal("成功!", "", "success");
	// 	}
	// );
	// $.post(
	// 	'../../api/order/product/update',
	// 	{
	// 		id: curID,
	// 		prev: curState,
	// 		status: curOption,
	// 		remark: $("#remark").val()
	// 	},
	// 	function (data) {
	// 		table.ajax.reload( null, false );
	// 		swal("处理成功!", "", "success");
			$("#updateModal").modal("toggle");
		// }
	// );
}

$("#option1").click(function() {
	curOption = curState + 1;
	if ($(this).hasClass("selected"))
		return;
	$("#option2").removeClass("selected");
	$("#option1").addClass("selected");
});

$("#option2").click(function() {
	curOption = 5;
	if ($(this).hasClass("selected"))
		return;
	$("#option1").removeClass("selected");
	$("#option2").addClass("selected");
});

function showProduct() {

}