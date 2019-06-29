<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Test Page</title>
</head>

<body>
	<span>Width:</span>
	<input type="text" id="wd" />px<br/>
	<span>Height:</span>
	<input type="text" id="ht" />px
	<button type="button" onclick="show()">Click</button>
</body>
<script>
	window.onresize = function(event) {
		let wd = document.getElementById('wd');
		let ht = document.getElementById('ht');
		wd.value = window.innerWidth;// || document.documentElement.clientWidth || document.body.clientWidth;
		ht.value = window.innerHeight;// || document.documentElement.clientHeight || document.body.clientHeight;
	};

	window.onload = function(event) {
		let wd = document.getElementById('wd');
		let ht = document.getElementById('ht');
		wd.value = window.innerWidth;// || document.documentElement.clientWidth || document.body.clientWidth;
		ht.value = window.innerHeight;// || document.documentElement.clientHeight || document.body.clientHeight;
	};

	function show() {
		let wd = document.getElementById('wd');
		let ht = document.getElementById('ht');
		wd.value = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
		ht.value = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
		alert('ok');
	}
</script>
</html>