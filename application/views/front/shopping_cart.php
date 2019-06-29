<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #FFFFFF;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_top_product()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">购物车</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-bottom: 60px;margin-top: 45px;background: white;">
            <div class="row m-0 p-0" style="border-bottom: 2px solid #F7F7F7;">
                <p class="black_text14 p-0" style="margin: 5%;">我选的商品</p>
            </div>

            <input type="hidden" id="checked_all" value="<?php echo count($products);?>">
            <?php if (count($products)>0){ foreach ($products as $key => $product){?>
                <input type="hidden" id="product_id<?php echo $key;?>" value="<?php echo $product['product_id']; ?>">
                <div class="row" style="border-bottom: 1px solid #F7F7F7;padding: 5% 0;margin: 0 1%;">
                <div class="col-sm-5" style="text-align: center;width: 41.66667%;padding-right: 0;">
                    <img onclick="check_product(<?php echo $key; ?>)" check_status="1" id="check_icon<?php echo $key;?>" src="public/img/check.png" style="width: 18px;vertical-align: middle">&nbsp;&nbsp;
                    <img src="<?php echo base_url($product['image']) ?>" style="width: 75%;">
                </div>
                <div class="col-sm-7 " style="width: 58.33333%;">
                    <div class="row m-0 p-0">
                        <div style="width: 40px;height: 22px;background: #F74832;border-radius: 5px;float: left;line-height: 22px;text-align: center">
                            <span class="text12_medium whiteFFF">特价</span>
                        </div>
                        <div style="width: 70%;height: 22px;float: left;line-height: 22px;margin-left: 10px;">
                            <div style="float: left;text-align: left;">
                                <span class="text12_regular black444"><?php echo $product['name'] ?></span>
                            </div>
                            <div style="right: 6%;position: absolute;">
                                <span class="text12_medium black444">￥<span id="pt_price<?php echo $key;?>" class="pt_price"><?php echo $product['price'] ?></span></span>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span class="text12_regular black999">库存：<span id="pt_amount<?php echo $key;?>" class="pt_amount"><?php echo $product['amount'] ?></span>件</span>
                    </div>
<!--                    <div style="text-align: right;">-->
<!--                        <span class="text12_regular black999">邮费:¥-->
<!--                            <span>24.00</span>-->
<!--                        </span>-->
<!--                        <span onclick="show_price_detail()" class="mdi mdi-chevron-down" style="font-size: 21px;color: #AAAAAA;"></span>-->
<!--                    </div>-->
                </div>
            </div>
            <?php } ?>
                <div class="row" style="border-bottom: 1px solid #F7F7F7;padding: 5% 0;margin: 0 1%;">
                    <p class="pt-1 m-0 text12_regular black444" style="text-align: right;width: 100%">运费：￥<span id="delivery">5.00</span></p>
                    <p class="pt-1 m-0 text12_regular black444" style="text-align: right;width: 100%">活动优惠：-￥<span>0.00</span></p>
                    <p class="pt-1 mb-1 text12_regular black444" style="text-align: right;width: 100%">本单总计（不含税）：￥<span class="total_price">0.00</span></p>
                </div>
            <?php } else {?>
                <div style="width: 100%;text-align: center;margin-top: 20%;"><h3>没有选的产品。</h3></div>
            <?php } ?>

        </div>
        <div class="footer" style="max-width: 37.5rem;width: 100%;height: 45px;position: fixed;bottom: 0;border-color: transparent;background-color: #ffffff;border-top: 4px solid #F7F7F7;">
            <div class="row m-0 p-0" style="height: 100%;">
                <div onclick="check_all()" style="width: 20%;height: 100%;text-align: right;line-height: 37px;">
                    <img id="all_checked" check_status="1" src="public/img/check.png" style="width: 18px;">&nbsp;&nbsp;
                    <span class="text12_regular black999">全选</span>
                </div>
                <div class="text12_regular" style="width: 50%;height: 100%;text-align: right;padding-right: 10px;">
                    <div style="width: 100%;height: 50%;line-height: 25px">
                        <span class="black444">总计（不含税）：</span>&nbsp;&nbsp;<span class="redFB5E60">￥<span class="total_price">0.00</span></span>
                    </div>
                    <div style="width: 100%;height: 50%;line-height: 20px;">
                        <span class="black999">运费:￥<span id="delivery_price">5.00</span></span>
                    </div>
                </div>
                <div onclick="cart_buy()" style="width: 30%;height: 100%;background: #90C549;text-align: center;line-height: 45px;">
                    <span class="text16_regular whiteFFF">结算（<span id="total_amount">0</span>）</span>
                </div>

            </div>
        </div>

        <div id="modal_background" style="display: none;position: fixed;width: 100%;max-width: 37.5rem;height: 100%;top: 0;opacity: 0.48;background: #797474;margin-left: auto;margin-right: auto;"></div>

        <div id="pay_modal" style="width: 100%;max-width: 37.5rem;height: 50%;position: fixed;bottom: -50%;background: white;margin-left: auto;margin-right: auto;">
            <div style="width: 100%;padding: 3%;">
                <div style="border-bottom: 1px solid #DDDDDD;padding-bottom: 10px;">
                    <span class="text14_regular black444">请选择支付方式</span>
                    <span onclick="hide_pay_modal()" class="mdi mdi-close" style="font-size: 21px;color: #AAAAAA;float: right;margin-top: -6px;"></span>
                </div>
            </div>
            <div class="row m-0" style="padding: 8% 12%;">
                <span class="text14_regular black444">请在0小时30分钟内完成支付，金额 </span><span class="text14_regular redFB5E60">￥<span class="total_price">169.00</span></span>
            </div>
            <div style="padding: 5% 5%;">
                <img onclick="check_md_weixin()" id="md_weixin" src="public/img/check.png" style="width: 18px;height: 18px;">&nbsp;&nbsp;
                <span onclick="check_md_weixin()" class="text14_regular black444">微信</span>
            </div>
            <div style="padding: 5% 5%;">
                <img onclick="check_md_alipay()" id="md_alipay" src="public/img/tick_empty_circle.png" style="width: 18px;height: 18px;">&nbsp;&nbsp;
                <span onclick="check_md_alipay()" class="text14_regular black444">支付宝</span>
            </div>
            <div style="width: 100%; height: 45px;background: #90C549;text-align: center;line-height: 45px;bottom: 0;position: absolute;" onclick="order_pay()">
                <span class="text16_regular whiteFFF">确认支付</span>
            </div>
        </div>
    </div>
</div>

<script>
    function go_top_product() {
        location.href = '<?php echo base_url ('front/top_product'); ?>';
    }

    var checked_all = $('#checked_all').val();
    var origin_total_price = 0;
    var origin_total_amount = 0
    var checked_cnt = checked_all;
    var total_price = 0;
    var total_amount = 0;
    var product_ids = [];
    var payment_type = 1;
    $(document).ready(function(){
        for (var i=0; i<checked_all; i++) {
            var product_id = $('#product_id' + i).val();
            product_ids.push(product_id);
            var product_price = parseFloat($('#pt_price'+i).text());
            var product_amount = parseInt($('#pt_amount'+i).text());
            origin_total_amount += product_amount;
            origin_total_price += product_price * product_amount;
        }
        var delivery_price = $('#delivery').text();
        origin_total_price += parseFloat(delivery_price);

        total_price = origin_total_price;
        total_amount = origin_total_amount;
        $('.total_price').text(total_price);
        $('#total_amount').text(total_amount);
        payment_type = 1; // 1 - weixin , 2 - alipay
    });


    function checked() {
        if (checked_cnt == checked_all) {
            $('#all_checked').attr('src', 'public/img/check.png');
            $('#all_checked').attr('check_status', "1");
        }
        else{
            $('#all_checked').attr('src', 'public/img/tick_empty_circle.png');
            $('#all_checked').attr('check_status', "0");
        }
    }
    function check_all() {
        if ($('#all_checked').attr('check_status') == 0) {
            checked_cnt = checked_all;
            checked();
            for (var i=0; i<checked_all; i++) {
                $('#check_icon'+i).attr('src', 'public/img/check.png');
                $('#check_icon' + i).attr('check_status', "1");
                var product_id = $('#product_id' + i).val();
                product_ids.push(product_id);
            }
            total_price = origin_total_price;
            total_amount = origin_total_amount;
        }
        else{
            checked_cnt = 0;
            checked();
            for (var i=0; i<checked_all; i++) {
                $('#check_icon'+i).attr('src', 'public/img/tick_empty_circle.png');
                $('#check_icon' + i).attr('check_status', "0");
            }
            total_price = 0;
            total_amount = 0;
            product_ids = [];
        }
        $('#total_amount').text(total_amount);
        $('.total_price').text(total_price);
    }
    function check_product(key) {
        var product_amount = parseInt($('#pt_amount'+key).text());
        var product_price = parseFloat($('#pt_price'+key).text());
        if ($('#check_icon' + key).attr('check_status') == 0) {
            $('#check_icon'+key).attr('src', 'public/img/check.png');
            $('#check_icon' + key).attr('check_status', "1");
            total_amount += product_amount;
            if (checked_cnt == 0) {
                var delivery_price = $('#delivery').text();
                total_price = total_price * 100 + product_price * product_amount * 100 + parseFloat(delivery_price) * 100;
            }
            else{
                total_price = total_price * 100 + product_price * product_amount * 100;
            }
            total_price = total_price/100;
            $('.total_price').text(total_price);
            $('#total_amount').text(total_amount);
            checked_cnt++;
            checked();
            var product_id = $('#product_id' + key).val();
            product_ids.push(product_id);
        }
        else{
            $('#check_icon'+key).attr('src', 'public/img/tick_empty_circle.png');
            $('#check_icon' + key).attr('check_status', "0");
            checked_cnt--;
            checked();
            if (checked_cnt == 0) {
                total_price = 0;
                total_amount = 0;
            }
            else{
                total_price = total_price * 100 - product_price * product_amount * 100;
                total_price = total_price/100;
                total_amount -= product_amount;
            }
            $('.total_price').text(total_price);
            $('#total_amount').text(total_amount);
            var product_id = $('#product_id' + key).val();
            product_ids = jQuery.grep(product_ids, function(value) {
                return value != product_id;
            });
        }
    }
    function set_default_address(){
        if($('#default_address').attr('set') == 0){
            $('#default_address').attr('src', 'public/img/check.png');
            $('#default_address').attr('set', 1);
        }
        else{
            $('#default_address').attr('src', 'public/img/tick_empty_circle.png');
            $('#default_address').attr('set', 0);
        }
    }

    function show_pay_modal() {
        $('#modal_background').css('display', 'block');
        $('#pay_modal').animate({bottom: 0},'normal');
    }
    function hide_pay_modal() {
        $('#modal_background').css('display', 'none');
        $('#pay_modal').animate({bottom: '-50%'}, 'normal');
    }
    function check_md_weixin() {
        $('#md_weixin').attr('src', 'public/img/check.png');
        $('#md_alipay').attr('src', 'public/img/tick_empty_circle.png');
        payment_type = 1;
    }
    function check_md_alipay() {
        $('#md_weixin').attr('src', 'public/img/tick_empty_circle.png');
        $('#md_alipay').attr('src', 'public/img/check.png');
        payment_type = 2;
    }
    function cart_buy() {
        if (product_ids.length < 1) {
            swal("警告", "请选择产品。", "warning");
            return;
        }
        var pids = product_ids.join("_");
        var url = "shopping_cart";
        location.href = '<?php echo base_url ('front/confirm_order/'); ?>' + url + '/' + pids;
    }
</script>