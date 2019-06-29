<style>
	body {
		margin: 0;
		padding: 0;
	}

	#stage {
		height: 120px;
		overflow: hidden;
		padding-top: 0;
	}

	#machine {
		background-image: url('public/img/slot-new.png');
		background-repeat: no-repeat;
		background-position: center center;
		height: 190px;
		padding-top: 34px;
	}

	.perspective-on {
		-webkit-perspective: 1000px;
		-moz-perspective: 1000px;
		perspective: 1000px;
	}
	.perspective-off {
		-webkit-perspective: 0;
		-moz-perspective: 0;
		perspective: 0;
	}

	#rotate {
		transform-style: preserve-3d;
	}

	.ring {
		/*margin: 0 auto;*/
		width: 100px;
		height: 120px;
		float: left;
		transform-style: preserve-3d;

	}
	.slot {
		background-size: 100% 100%;
		position: absolute;
		width: 100px;
		height: 120px;
		box-sizing: border-box;
		color: rgba(0, 0, 0, 0.9);
		border: solid 2px #000;
	}

	.go {
		display: block;
		margin: 0 auto 20px;
		font-size: 20px;
		cursor: pointer;
	}

	label {
		cursor: pointer;
		display: inline-block;
		width: 45%;
		text-align: center;
	}

	.spin-0     { transform: rotateX(-3960deg); }
	.spin-1     { transform: rotateX(-4005deg); }
	.spin-2     { transform: rotateX(-4050deg); }
	.spin-3     { transform: rotateX(-3735deg); }
	.spin-4     { transform: rotateX(-3780deg); }
	.spin-5     { transform: rotateX(-3825deg); }
	.spin-6     { transform: rotateX(-3870deg); }
	.spin-7     { transform: rotateX(-3915deg); }

	@keyframes back-spin {
		0%    { transform: rotateX(0deg); }
		100%  { transform: rotateX(45deg); }
	}

	@keyframes spin-0 {
		0%    { transform: rotateX(45deg); }
		100%  { transform: rotateX(-3960deg); }
	}
	@keyframes spin-1 {
		0%    { transform: rotateX(45deg); }
		100%  { transform: rotateX(-4005deg); }
	}

	@keyframes spin-2 {
		0%    { transform: rotateX(45deg); }
		100%  { transform: rotateX(-4050deg); }
	}

	@keyframes spin-3 {
		0%    { transform: rotateX(45deg); }
		100%  { transform: rotateX(-3735deg); }
	}

	@keyframes spin-4 {
		0%    { transform: rotateX(45deg); }
		100%  { transform: rotateX(-3780deg); }
	}

	@keyframes spin-5 {
		0%    { transform: rotateX(45deg); }
		100%  { transform: rotateX(-3825deg); }
	}

	@keyframes spin-6 {
		0%    { transform: rotateX(45deg); }
		100%  { transform: rotateX(-3870deg); }
	}

	@keyframes spin-7 {
		0%    { transform: rotateX(45deg); }
		100%  { transform: rotateX(-3915deg); }
	}
</style>
<div class="app-content content hide_scrollbar" style="max-width: 37.5rem; margin-left: auto; margin-right: auto; background: white; height: 100%; overflow-y: scroll;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem; width:100%; height: 45px;position: fixed; top: 0; z-index: 999; color: #101010; font-size: 18px; background-color: #ffffff;">
            <div style="display: table; width: 100%; height: 100%;">
                <div style="display: table-cell; vertical-align: middle; text-align: center;">
                    <span onclick="go_index()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">偷菜</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="margin-top: 45px;">
            <input type="hidden" id="is_login" value="<?php echo $is_login; ?>">

	        <div id="game_area">
		        <div id="machine">
			        <div id="stage" class="perspective-off">
				        <div id="rotate">
					        <div id="ring1" class="ring"></div>
					        <div id="ring2" class="ring"></div>
					        <div id="ring3" class="ring"></div>
				        </div>
			        </div>
		        </div>
		        <div class="mt-2 mb-2" role="group" style="text-align: center;">
			        <button id="spin" type="button" class="btn btn-primary btn-lg go">开始 (免费)</button>
		        </div>
		        <div class="col-sm-12 mb-1 pl-1 pr-1" style="border-top: 4px solid #f7f7f7;">
			        <div class="text15_medium black444" style="width: 100%;height: 45px;line-height: 45px;border-bottom: 2px solid #f7f7f7">
				        <span>我的奖品</span>
			        </div>
			        <div class="text14_regular blackAAA" style="width: 100%;height: 42px;line-height: 42px;text-align: center;">
				        <span>暂无</span>
			        </div>
		        </div>
		        <div class="col-sm-12 mb-1 pl-1 pr-1" style="border-top: 4px solid #f7f7f7;">
			        <div class="text15_medium black444" style="width: 100%;height: 45px;line-height: 45px;border-bottom: 2px solid #f7f7f7">
				        <span>游戏说明</span>
			        </div>
			        <div class="text14_regular blackAAA" style="width: 100%;text-align: left;padding-top: 10px;">
				        <span style="height: 25px;line-height: 25px;">这里是游戏说明这里是游戏说明这里是游戏说明这里是游戏说明这里是游戏说明这里是游戏说明</span>
                        <?php $reward = json_decode($rewards[1], false); ?>
                        <div class="row m-0" style="height: 54px;line-height: 54px;font-size: 16px;">
                            <img src="../public/slot/img/01-alt.png" style="width: 45px;height: 100%;"> X 3  ===>
                            <?php
                                if ($reward->type == 'none') echo '【未分配】：';
                                else if ($reward->type == 'product'){
                                    echo '优品：';
                                    foreach ($products as $product) {
                                        if ($product['id'] == $reward->product) { ?>
                                            <img src="<?php echo base_url($product['image']);?>" style="width: 57px;height: 47px;"/>
                                            &nbsp;
                                            <span><?php echo $product['name'];?></span>
                                            &nbsp;
                                        <?php }
                                    }

                                    echo ' ： ';
                                    echo $reward->amount;
                                }
                                else if ($reward->type == 'freespin') {
                                    echo '免费旋转：';
                                    echo $reward->amount;
                                }
                                else if ($reward->type == 'coupon') {
                                    echo '优惠券：';
                                    echo $reward->amount;
                                    echo ' 终止期：';
                                    echo $reward->expires;
                                }
                                else if ($reward->type == 'point') {
                                    echo '积分：';
                                    echo $reward->amount;
                                }
                            ?>
                        </div>
                        <?php $reward = json_decode($rewards[2], false); ?>
                        <div class="row m-0" style="height: 54px;line-height: 54px;font-size: 16px;">
                            <img src="../public/slot/img/02-alt.png" style="width: 45px;height: 100%;"> X 3  ===>
                            <?php
                            if ($reward->type == 'none') echo '【未分配】：';
                            else if ($reward->type == 'product'){
                                echo '优品：';
                                foreach ($products as $product) {
                                    if ($product['id'] == $reward->product) { ?>
                                        <img src="<?php echo base_url($product['image']);?>" style="width: 57px;height: 47px;"/>
                                        &nbsp;
                                        <span><?php echo $product['name'];?></span>
                                        &nbsp;
                                    <?php }
                                }

                                echo ' ： ';
                                echo $reward->amount;
                            }
                            else if ($reward->type == 'freespin') {
                                echo '免费旋转：';
                                echo $reward->amount;
                            }
                            else if ($reward->type == 'coupon') {
                                echo '优惠券：';
                                echo $reward->amount;
                                echo ' 终止期：';
                                echo $reward->expires;
                            }
                            else if ($reward->type == 'point') {
                                echo '积分：';
                                echo $reward->amount;
                            }
                            ?>
                        </div>
                        <?php $reward = json_decode($rewards[3], false); ?>
                        <div class="row m-0" style="height: 54px;line-height: 54px;font-size: 16px;">
                            <img src="../public/slot/img/03-alt.png" style="width: 45px;height: 100%;">水果 X 3  ===>
                            <?php
                            if ($reward->type == 'none') echo '【未分配】：';
                            else if ($reward->type == 'product'){
                                echo '优品：';
                                foreach ($products as $product) {
                                    if ($product['id'] == $reward->product) { ?>
                                        <img src="<?php echo base_url($product['image']);?>" style="width: 57px;height: 47px;"/>
                                        &nbsp;
                                        <span><?php echo $product['name'];?></span>
                                        &nbsp;
                                    <?php }
                                }

                                echo ' ： ';
                                echo $reward->amount;
                            }
                            else if ($reward->type == 'freespin') {
                                echo '免费旋转：';
                                echo $reward->amount;
                            }
                            else if ($reward->type == 'coupon') {
                                echo '优惠券：';
                                echo $reward->amount;
                                echo ' 终止期：';
                                echo $reward->expires;
                            }
                            else if ($reward->type == 'point') {
                                echo '积分：';
                                echo $reward->amount;
                            }
                            ?>
                        </div>
                        <?php $reward = json_decode($rewards[4], false); ?>
                        <div class="row m-0" style="height: 54px;line-height: 54px;font-size: 16px;float:left;">
                            <img src="../public/slot/img/04-alt.png" style="width: 45px;height: 100%;">
                            任何卡 X 2  ===>
                            <?php
                            if ($reward->type == 'none') echo '【未分配】：';
                            else if ($reward->type == 'product'){
                                echo '优品：';
                                foreach ($products as $product) {
                                    if ($product['id'] == $reward->product) { ?>
                                        <img src="<?php echo base_url($product['image']);?>" style="width: 57px;height: 47px;"/>
                                        &nbsp;
                                        <span><?php echo $product['name'];?></span>
                                        &nbsp;
                                    <?php }
                                }

                                echo ' ： ';
                                echo $reward->amount;
                            }
                            else if ($reward->type == 'freespin') {
                                echo '免费旋转：';
                                echo $reward->amount;
                            }
                            else if ($reward->type == 'coupon') {
                                echo '优惠券：';
                                echo $reward->amount;
                                echo ' 终止期：';
                                echo $reward->expires;
                            }
                            else if ($reward->type == 'point') {
                                echo '积分：';
                                echo $reward->amount;
                            }
                            ?>
                        </div>
			        </div>
		        </div>
	        </div>
	        <div id="error_area" style="display: none;">
				<span style="font-size: 24px;">
					不好意思，你不能在横向模式下玩这个游戏。
				</span>
	        </div>
        </div>
        <div id="celebration" style="display: none;max-width: 37.5rem;width: 100%;height: 100%;position: fixed;top: 0;background: url('../public/img/animated-stars.gif')">
            <img src="../public/img/fall_stars.gif" style="width: 100%;height: 100%;"/>
        </div>
    </div>
</div>

<div class="modal animated bounceIn text-left" id="result" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<h5>Check First Paragraph</h5>
				<p>Oat cake ice cream candy chocolate cake chocolate cake cotton candy dragée apple pie. Brownie carrot cake candy canes bonbon fruitcake topping halvah. Cake sweet roll cake cheesecake cookie chocolate cake liquorice. Apple pie sugar plum powder donut soufflé.</p>
				<p>Sweet roll biscuit donut cake gingerbread. Chocolate cupcake chocolate bar ice cream. Danish candy cake.</p>
				<hr>
				<h5>Some More Text</h5>
				<p>Cupcake sugar plum dessert tart powder chocolate fruitcake jelly. Tootsie roll bonbon toffee danish. Biscuit sweet cake gummies danish. Tootsie roll cotton candy tiramisu lollipop candy cookie biscuit pie.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-secondary" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-success">立即索赔</button>
			</div>
		</div>
	</div>
</div>

<script>
	const SLOTS_PER_REEL = 8;
	let REEL_RADIUS = 144;
	let isMobile, isPortrait, isSeed, isCurrent, isMiddle, timer;

	function checkDevice() {
		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
			let wd = window.innerWidth;
			let ht = window.innerHeight;
			if (ht > wd) {
				isPortrait = 1;
				$("#error_area").fadeOut("fast", function() {
					$("#game_area").fadeIn("fast");
					wd = parseInt($(".content").css("width"));
					$("#machine").css("padding-left", ((wd - 364) / 2 + 32.0) + "px");
				});
			} else {
				isPortrait = 0;
				$("#game_area").fadeOut("fast", function() {
					$("#error_area").fadeIn("fast");
				});
			}
			isMobile = 1;
		} else {
			isMobile = 0;
			let wd = parseInt($(".content").css("width"));
			$("#machine").css("padding-left", ((wd - 364) / 2 + 32.0) + "px");
		}
	}

	function createSlots(ring) {
		let slotAngle = 360 / SLOTS_PER_REEL;
		for (let i = 0; i < SLOTS_PER_REEL; i++) {
			let slot = document.createElement('div');
			slot.className = 'slot';
			slot.style.transform = 'rotateX(' + (slotAngle * i) + 'deg) translateZ(' + REEL_RADIUS + 'px)';
			$(slot).css('background-image', 'url(\'../public/slot/img/0' + (i + 1) + '.jpg\')');
			ring.append(slot);
		}
	}

	function spin(timer, flag) {
		for (let i = 1; i < 4; i ++) {
			// let oldSeed = -1;
			//
			// let oldClass = $('#ring' + i).attr('class');
			// if(oldClass.length > 4) {
			// 	oldSeed = parseInt(oldClass.slice(10));
			// }
			//
			// let seed = getSeed();
			// while (oldSeed === seed) {
			// 	seed = getSeed();
			// }

			let seed = null;
			if (flag > 0)
				seed = parseInt(isSeed.substr(i - 1, 1)) - 1;
			else
				seed = parseInt(isMiddle.substr(i - 1, 1)) - 1;

			$('#ring' + i)
				.css('animation','back-spin 1s, spin-' + seed + ' ' + (timer + i * 0.5) + 's')
				.attr('class','ring spin-' + seed);
		}
	}

	$(document).ready(function() {
		isCurrent = "111"; timer = 2;

		isPortrait = 1; isMobile = 0; checkDevice();
		if (isMobile + isPortrait === 0) return;

		createSlots($('#ring1'));
		createSlots($('#ring2'));
		createSlots($('#ring3'));

        $('.go').on('click', function () {
            var is_login = $('#is_login').val();
            if (is_login == 1) {
                $.post(
                    '../api/secret',
                    function (data) {
                        data = JSON.parse(data);
                        if (data.status == "ok") {
                            isSeed = data.seed;
                            isMiddle = "";
                            for (let i = 1; i < 4; i++) {
                                let n = getSeed() + 1;
                                for (; ;) {
                                    if (n != parseInt(isSeed.substr(i - 1, 1)) && n != parseInt(isCurrent.substr(i - 1, 1)))
                                        break;
                                    n = getSeed() + 1;
                                }
                                isMiddle += n.toString();
                            }
                            spin(timer, 0);
                            setTimeout(function () {
                                isCurrent = isSeed;
                                spin(timer, 1);
                                setTimeout(function () {
                                    // Treatment
                                    // alert('Completed');
                                }, timer * 1000 + 1500);
                            }, timer * 1000);
                        } else {
                            swal("告知", "你没有任何免费旋转。 请明天再试。", "info");
                        }
                    }
                );
            }
            else{
                location.href = '<?php echo base_url ('member/login'); ?>';
            }
        });

	});

	window.onresize = function(event) {
		checkDevice();
	};

	function getSeed() {
		return Math.floor(Math.random() * (SLOTS_PER_REEL));
	}
</script>

<script>
    function go_index() {
        location.href = '<?php echo base_url ('front'); ?>';
    }
</script>