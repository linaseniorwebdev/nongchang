let player;

$(document).ready(function() {

});

$("#btn_preview").click(function() {
	let channel = $("#channel").val();
	$("#rtmp").attr("src", "rtmp://rtmp.open.ys7.com/openlive/" + channel);
	$("#hls").attr("src", "http://hls.open.ys7.com/openlive/" + channel + ".m3u8");
	// $("#ws").attr("src", "rtmp://rtmp.open.ys7.com/openlive/" + channel);
	player = new EZUIPlayer("preview");
});

$("#submit").click(function() {
	let rtmp = $("#check_rtmp").prop("checked");
	let hls = $("#check_hls").prop("checked");
	let ws = $("#check_ws").prop("checked");
	if (rtmp || hls) {  //  || ws
		let channel = $("#channel").val();
		if (channel.length < 1) {
			swal("", "请输入有效的频道ID", "warning");
			return;
		}
		let title = $("#title").val();
		if (title.length < 1) {
			swal("", "请输入频道标题", "warning");
			return;
		}
		let sendData = {title: title};
		if (rtmp) {
			sendData.rtmp = "rtmp://rtmp.open.ys7.com/openlive/" + channel;
		}
		if (hls) {
			sendData.hls = "http://hls.open.ys7.com/openlive/" + channel + ".m3u8";
		}
		if (ws) {
			sendData.ws = "";   // Currently empty
		}
		$.post(
			'../../api/channel/add',
			sendData,
			function (data) {
				console.log(data);
				data = JSON.parse(data);
				if (data.status == "success") {
					location.href = "channels";
				}
			}
		);
	} else {
		swal("", "必须至少选择三个项目中的一个", "warning");
	}
});