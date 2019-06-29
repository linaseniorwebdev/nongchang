var provData, selCode, child;

$(document).ready(function() {
	selCode = null;

	provData = [];
	$.getJSON("../../api/province/all", function(data) {
		for (var i = 0; i < data.length; i++) {
			if (data[i].code != null)
				provData[data[i].code] = data[i].name;
		}
	});

	$('#china').vectorMap({
		map: 'cn_merc',
		zoomOnScroll: false,
		regionsSelectable: true,
		regionsSelectableOne: true,
		regionStyle: {
			initial: {
				fill: 'white',
				"fill-opacity": 1,
				stroke: 'none',
				"stroke-width": 0,
				"stroke-opacity": 1
			},
			hover: {
				"fill-opacity": 0.8,
				cursor: 'pointer'
			},
			selected: {
				fill: '#88AA88',
				"fill-opacity": 0.75
			},
			selectedHover: {
			}
		},
		regionLabelStyle: {
			initial: {
				'font-family': 'NSimSun',
				'font-size': '24',
				'font-weight': 'bold',
				cursor: 'default',
				fill: 'black'
			},
			hover: {
				cursor: 'pointer'
			}
		},
		onRegionTipShow: function(e, el, code) {
			el.html(provData[code]);
		},
		onRegionClick: function (e, code) {
			selCode = code;
			$("#detail").val(provData[code]);
		}
	});
});

function doEdit(obj) {
	child = obj.firstChild;
	if ($(child).hasClass("la-pencil")) {
		if (selCode == null)
			return;
		$(child).removeClass("la-pencil");
		$(child).addClass("la-check");
		$("#detail").removeAttr("readonly");
	} else {
		var title = $("#detail").val();
		if (title.length < 1) {
			swal("", "请正确输入省名。", "warning");
			return;
		}
		$.post("../../api/province/update", {code: selCode, name: title}, function(data) {
			$(child).removeClass("la-check");
			$(child).addClass("la-pencil");
			$("#detail").attr("readonly", "readonly");
		});
	}
}