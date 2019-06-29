let prims, secos;
let types;

$(document).ready(function() {
	types = [parseInt($("#a_type").val()), parseInt($("#b_type").val()), parseInt($("#c_type").val()), parseInt($("#d_type").val())];
	console.log(types);
	prims = [null, "_product_id", "_freespin_amount", "_coupon_amount", "_point_amount"];
	secos = [null, "_product_amount", null, "_coupon_expire", null];
});

function getDateOffset(offset) {
	let date = new Date();
	date.setDate(date.getDate() + offset);
	let month = '' + (date.getMonth() + 1),
		day = '' + date.getDate(),
		year = date.getFullYear();

	if (month.length < 2) month = '0' + month;
	if (day.length < 2) day = '0' + day;

	return [year, month, day].join('-');
}

$("#a_type").change(function() {
	let new_type = $(this).val();
	let $prim = $("#a" + prims[types[0]]);
	let $seco = (types[0] % 2 === 1)?$("#a" + secos[types[0]]):null;
	$prim.fadeOut(0);
	if ($seco !== null)
		$seco.fadeOut(0);
	if (new_type > 0) {
		types[0] = new_type;
		$prim = $("#a" + prims[types[0]]);
		$prim.fadeIn("fast");
		$seco = (types[0] % 2 === 1)?$("#a" + secos[types[0]]):null;
		if ($seco !== null)
			$seco.fadeIn("fast");
	}
});

$("#b_type").change(function() {
	let new_type = $(this).val();
	let $prim = $("#b" + prims[types[1]]);
	let $seco = (types[1] % 2 === 1)?$("#b" + secos[types[1]]):null;
	$prim.fadeOut(0);
	if ($seco !== null)
		$seco.fadeOut(0);
	if (new_type > 0) {
		types[1] = new_type;
		$prim = $("#b" + prims[types[1]]);
		$prim.fadeIn("fast");
		$seco = (types[1] % 2 === 1)?$("#b" + secos[types[1]]):null;
		if ($seco !== null)
			$seco.fadeIn("fast");
	}
});

$("#c_type").change(function() {
	let new_type = $(this).val();
	let $prim = $("#c" + prims[types[2]]);
	let $seco = (types[2] % 2 === 1)?$("#c" + secos[types[2]]):null;
	$prim.fadeOut(0);
	if ($seco !== null)
		$seco.fadeOut(0);
	if (new_type > 0) {
		types[2] = new_type;
		$prim = $("#c" + prims[types[2]]);
		$prim.fadeIn("fast");
		$seco = (types[2] % 2 === 1)?$("#c" + secos[types[2]]):null;
		if ($seco !== null)
			$seco.fadeIn("fast");
	}
});

$("#d_type").change(function() {
	let new_type = $(this).val();
	let $prim = $("#d" + prims[types[3]]);
	let $seco = (types[3] % 2 === 1)?$("#d" + secos[types[3]]):null;
	$prim.fadeOut(0);
	if ($seco !== null)
		$seco.fadeOut(0);
	if (new_type > 0) {
		types[3] = new_type;
		$prim = $("#d" + prims[types[3]]);
		$prim.fadeIn("fast");
		$seco = (types[3] % 2 === 1)?$("#d" + secos[types[3]]):null;
		if ($seco !== null)
			$seco.fadeIn("fast");
	}
});

$(".btn-outline-success").click(function() {
	let config0, config1, config2, config3;
	let id, amount, expire;
	config0 = {
		type: "none",
		product: 0,
		amount: 0,
		expires: 0
	};
	config1 = {
		type: "none",
		product: 0,
		amount: 0,
		expires: 0
	};
	config2 = {
		type: "none",
		product: 0,
		amount: 0,
		expires: 0
	};
	config3 = {
		type: "none",
		product: 0,
		amount: 0,
		expires: 0
	};

	if (types[0] < 0) {

	} else if (types[0] == 1) {
		id = parseInt($("#a_product_id select").val());
		if (id < 0) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		amount = parseInt($("#a_product_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config0.type = "product";
		config0.product = id;
		config0.amount = amount;
	} else if (types[0] == 2) {
		amount = parseInt($("#a_freespin_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config0.type = "freespin";
		config0.amount = amount;
	} else if (types[0] == 3) {
		amount = parseFloat($("#a_coupon_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		amount = Math.floor(amount * 100.0) / 100.0;
		expire = parseInt($("#a_coupon_expire input").val());
		config0.type = "coupon";
		config0.amount = amount;
		config0.expires = expire;
	} else if (types[0] == 4) {
		amount = parseInt($("#a_point_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config0.type = "point";
		config0.amount = amount;
	}

	if (types[1] < 0) {

	} else if (types[1] == 1) {
		id = parseInt($("#b_product_id select").val());
		if (id < 0) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		amount = parseInt($("#b_product_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config1.type = "product";
		config1.product = id;
		config1.amount = amount;
	} else if (types[1] == 2) {
		amount = parseInt($("#b_freespin_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config1.type = "freespin";
		config1.amount = amount;
	} else if (types[1] == 3) {
		amount = parseFloat($("#b_coupon_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		amount = Math.floor(amount * 100.0) / 100.0;
		expire = parseInt($("#b_coupon_expire input").val());
		config1.type = "coupon";
		config1.amount = amount;
		config1.expires = expire;
	} else if (types[1] == 4) {
		amount = parseInt($("#b_point_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config1.type = "point";
		config1.amount = amount;
	}

	if (types[2] < 0) {

	} else if (types[2] == 1) {
		id = parseInt($("#c_product_id select").val());
		if (id < 0) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		amount = parseInt($("#c_product_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config2.type = "product";
		config2.product = id;
		config2.amount = amount;
	} else if (types[2] == 2) {
		amount = parseInt($("#c_freespin_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config2.type = "freespin";
		config2.amount = amount;
	} else if (types[2] == 3) {
		amount = parseFloat($("#c_coupon_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		amount = Math.floor(amount * 100.0) / 100.0;
		expire = parseInt($("#c_coupon_expire input").val());
		config2.type = "coupon";
		config2.amount = amount;
		config2.expires = expire;
	} else if (types[2] == 4) {
		amount = parseInt($("#c_point_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config2.type = "point";
		config2.amount = amount;
	}

	if (types[3] < 0) {

	} else if (types[3] == 1) {
		id = parseInt($("#d_product_id select").val());
		if (id < 0) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		amount = parseInt($("#d_product_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config3.type = "product";
		config3.product = id;
		config3.amount = amount;
	} else if (types[3] == 2) {
		amount = parseInt($("#d_freespin_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config3.type = "freespin";
		config3.amount = amount;
	} else if (types[3] == 3) {
		amount = parseFloat($("#d_coupon_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		amount = Math.floor(amount * 100.0) / 100.0;
		expire = $("#d_coupon_expire input").val();
		config3.type = "coupon";
		config3.amount = amount;
		config3.expires = expire;
	} else if (types[3] == 4) {
		amount = parseInt($("#d_point_amount input").val());
		if (isNaN(amount)) {
			swal("", "您的选择有一些错误。 请再检查一次。", "warning");
			return;
		}
		config3.type = "point";
		config3.amount = amount;
	}

	$.post(
		'../../api/game/save',
		{
			v1: JSON.stringify(config0),
			v2: JSON.stringify(config1),
			v3: JSON.stringify(config2),
			v4: JSON.stringify(config3)
		},
		function () {
			location.reload();
		}
	);
});