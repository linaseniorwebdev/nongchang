<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F5F5F5;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #f8f8f8;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_back()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">确认支付</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-bottom: 60px;margin-top: 45px;background: white;">
            <div class="row" style="border-bottom: 6px solid #F5F5F5;padding: 5% 0 5% 0;margin: 0 1%;">
                <div class="col-sm-5" style="text-align: center;width: 41.66667%;">
                    <img src="<?php echo base_url($land['map']); ?>" style="width: 100%;">
<!--                    <p class="text14_regular black444" style="margin: 10% 0;text-align: left;">购买数量</p>-->
                </div>
                <div class="col-sm-7" style="width: 58.33333%;">
                    <p class="text14_regular black444">土地编号: <?php echo $land['landnum']?></p>
                    <p class="text14_regular black999" style="margin: 10% 0;">土地面积：<span style="float: right;"><?php echo $land['area']?>亩</span></p>
                    <p class="red_text15" style="margin: 12% 0;">￥<?php echo $land['price']?></p>
<!--                    <p style="float:right;">-->
<!--                        <img onclick="minus_cnt()" src="public/img/minus.png" style="width: 25px;">&nbsp;&nbsp;-->
<!--                        <span id="product_cnt" class="black_text14">1</span>&nbsp;&nbsp;-->
<!--                        <img onclick="plus_cnt()" src="public/img/plus.png" style="width: 25px;">-->
<!--                    </p>-->
                </div>
            </div>

            <p class="black_text14 p-0" style="font-size: 15px;margin: 5%;">支付方式</p>
            <div style="width: 100%;height: 1px;background-color: #F5F5F5;"></div>
            <p style="margin: 4% 5%;" onclick="check_weixin()">
                <img id="weixin" src="public/img/check.png" style="width: 18px;vertical-align: middle">&nbsp;&nbsp;
                <span class="black_text14">微信</span>
            </p>
            <div style="width: 100%;height: 1px;background-color: #F5F5F5;"></div>
            <p style="margin: 4% 5%;" onclick="check_alipay()">
                <img id="alipay" src="public/img/tick_empty_circle.png" style="width: 18px;vertical-align: middle">&nbsp;&nbsp;
                <span class="black_text14">支付宝</span>
            </p>
            <div style="width: 100%;height: 6px;background-color: #F5F5F5;"></div>
<!--            <p class="black_text14 p-0" style="font-size: 15px;margin: 5%;">-->
<!--                <span style="width: 25%;">买家留言：</span>-->
<!--                <input class="black_text14 text_placeholder" placeholder="选填：对本次交易的说明" style="border: none;outline: 0;width: 75%;"/>-->
<!--            </p>-->
<!--            <div style="width: 100%;height: 3px;background-color: #F5F5F5;"></div>-->
<!--            <p class="black_text14 p-0" style="margin: 4% 5%;">总价：￥52</p>-->
<!--            <p class="black_text14 p-0" style="margin: 4% 5%;">运费：￥5</p>-->
<!--            <p class="black_text14 p-0" style="margin: 4% 5%;">优惠券：-￥2</p>-->
<!--            <p class="black_text14 p-0" style="margin: 5% 5% 3% 5%;">现金券：￥0-->
<!--                <div style="width: 100%;height: 1px;background-color: #F5F5F5;"></div>-->
<!--            </p>-->
<!--            <p class="black_text14 p-0" style="margin: 5%;">应付：<span class="red_text15" style="font-size: 14px;">￥450</span></p>-->
<!--            <div style="width: 100%;height: 3px;background-color: #F5F5F5;"></div>-->
        </div>
        <div class="footer" style="max-width: 37.5rem;width: 100%;height: 45px;position: fixed;bottom: 0;border-color: transparent;background-color: #ffffff;">
            <div class="row m-0 p-0" style="height: 100%;">
                <div style="width: 70%;height: 100%;text-align: center;">
                    <p class="red_text15 p-0" style="line-height: 45px;"><span style="color: #444444;">实际支付：</span>￥<span id="land_price"><?php echo $land['price']?></span></p>
                </div>

                <div onclick="go_payment(<?php echo $land['id']; ?>)" style="width: 30%;height: 100%;background: #90C549;text-align: center;line-height: 45px;">
                    <span class="text16_regular whiteFFF">结算</span>
                </div>

            </div>
        </div>
    </div>
    <form id="agent_alipay" action="<?php echo base_url('alipay/do_pay/wap'); ?>" method="post">
        <input type="hidden" name="ordertp" value="land" />
        <input type="hidden" name="title" />
        <input type="hidden" name="amount" />
        <input type="hidden" name="orderid" />
    </form>
</div>

<script>

    // $(document).ready(function(){
    //     // adjustImage();
    // });
    // $( window ).resize(function() {
    //     adjustImage();
    // });
    // function adjustImage(){
    // }
    function plus_cnt() {
        var cnt = $('#product_cnt').text();
        var int_cnt = parseInt(cnt);
        int_cnt += 1;
        $('#product_cnt').text(int_cnt);
    }
    function minus_cnt() {
        var cnt = $('#product_cnt').text();
        var int_cnt = parseInt(cnt);
        if(int_cnt != 1 ){
            int_cnt -= 1;
            $('#product_cnt').text(int_cnt);
        }
    }
    var pay_method = 1;
    function check_weixin() {
        $('#weixin').attr('src', 'public/img/check.png');
        $('#alipay').attr('src', 'public/img/tick_empty_circle.png');
        pay_method = 1;
    }
    function check_alipay() {
        $('#weixin').attr('src', 'public/img/tick_empty_circle.png');
        $('#alipay').attr('src', 'public/img/check.png');
        pay_method = 2;
    }
    function go_payment(land_id) {
        var land_price = $('#land_price').text();
        land_price = parseFloat(land_price);
        if (land_price) {
            
        } else {
            swal('提示', '请选择土地', 'warning');
            return;
        }

        if (pay_method == 1)
            return;

        $.post("<?php echo base_url('front/order_land') ?>/" + land_id + '/' + land_price, function (data) {
            var result = JSON.parse(data);
            if (result.status == "success") {
                console.log(data);
                if (pay_method == 0) {
                    // Weixin
                } else {
                    // Alipay
                    $('input[name="title"]').val("Payment Confirmation");
                    $('input[name="amount"]').val(land_price);
                    $('input[name="orderid"]').val(result.orderid);
                    $('#agent_alipay').submit();
                }
            } else {
                swal("提示", "请再试一次。", "warning");
            }
        });
    }

</script>