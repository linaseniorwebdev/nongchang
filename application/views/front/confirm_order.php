<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F5F5F5;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #f8f8f8;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_product_detail('<?php echo $url; ?>','<?php echo $pids; ?>')" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">确认订单</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-bottom: 60px;margin-top: 45px;background: white;">
            <input id="destination_id" type="hidden" value="<?php echo $destination['id']; ?>">
            <div onclick="go_select_address('<?php echo $url; ?>','<?php echo $pids; ?>')" class="row m-0 p-0" style="border-top: 4px solid #F7F7F7;border-bottom: 4px solid #F7F7F7;">
                <div class="p-0 black_text14" style="font-size: 15px;margin: 3% 5%;width: 100%;">
                   
                    <div style="width: 6%;float: left;">
                        <img src="public/img/target.png" style="width: 20px;height: 25px;vertical-align: middle;">
                    </div>
                    <div style="width: 80%;float: left;margin-left: 2%;line-height: 25px;">
                        <?php if ($destination['id']) { ?>
                            <span>送至：<?php echo $destination['province'];echo $destination['city'];echo $destination['district'];echo $destination['detail'];?></span>
                        <?php } else{?>
                            <span>选择送货地址。</span>
                        <?php }?>
                    </div>
                    <div style="width: 6%;float: left;line-height: 25px;margin-left: 6%;">
                        <span class="mdi mdi-chevron-right" style="float: right;font-size: 35px;color: #AAAAAA;"></span>
                    </div>
                    
                </div>
            </div>
            <input type="hidden" id="pt_cnt" value="<?php echo count($products); ?>">
            <?php $product_names = ''; foreach ($products as $key => $product) { if (strlen($product_names) < 1) $product_names = $product['name']; else $product_names .= ('，' . $product['name']);?>
                <div class="row" style="border-bottom: 4px solid #F5F5F5;padding-top: 5%;margin: 0 1%;">
                    <input id="product_id<?php echo $key; ?>" type="hidden" value="<?php echo $product['id']; ?>">
                    <div class="col-sm-5" style="text-align: center;width: 41.66667%;">
                        <img src="<?php echo base_url($product['image']); ?>" style="width: 100%;">
                    </div>
                    <div class="col-sm-7" style="width: 58.33333%;">
                        <p class="text14_regular black444"><?php echo $product['name']; ?></p>
                        <p class="text14_regular black999" style="margin: 10% 0;">库存：<span id="stock<?php echo $key; ?>" style="float: right;"><?php echo $product['stock']; ?><span>件</span></span></p>
                        <p class="red_text15" style="margin: 10% 0;">￥<span id="price<?php echo $key; ?>"><?php echo $product['price']; ?></span></p>
                    </div>
                    <p style="width: 100%;padding: 1% 5%;">
                        <span class="text14_regular black444" style="margin: 10% 0;text-align: left;">购买数量</span>
                        <span style="float: right">
                            <img onclick="minus_cnt(<?php echo $key; ?>)" src="public/img/minus.png" style="width: 25px;">&nbsp;&nbsp;

                            <?php if ($url == "product_detail") { ?>
                                <span id="product_cnt<?php echo $key; ?>" class="black_text14">1</span>&nbsp;&nbsp;
                            <?php } else{ ?>
                                <span id="product_cnt<?php echo $key; ?>" class="black_text14"><?php echo $amounts[$key]; ?></span>&nbsp;&nbsp;
                            <?php } ?>
                            <img onclick="plus_cnt(<?php echo $key; ?>)" src="public/img/plus.png" style="width: 25px;">
                        </span>
                    </p>
                </div>
            <?php } ?>
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
            <p class="black_text14 p-0" style="font-size: 15px;margin: 0 5%;">买家留言：
                <input class="black_text14 text_placeholder" placeholder="选填：对本次交易的说明" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
            </p>
            <div style="width: 100%;height: 3px;background-color: #F5F5F5;"></div>
            <p class="black_text14 p-0" style="margin: 4% 5%;">总价：￥<span id="total_price"><?php echo $product['price']; ?></span></p>
            <p class="black_text14 p-0" style="margin: 4% 5%;">运费：￥<span id="delivery_price">5.00</span></p>
            <p class="black_text14 p-0" style="margin: 4% 5%;">优惠券：-￥<span id="coupon">0.00</span></p>
            <p class="black_text14 p-0" style="margin: 5% 5% 3% 5%;">现金券：￥<span id="cash_coupon">0.00</span>
            <div style="width: 100%;height: 1px;background-color: #F5F5F5;"></div>
            </p>
            <p class="black_text14 p-0" style="margin: 5%;">应付：<span class="red_text15" style="font-size: 14px;">￥<span id="handle_price">0.00</span></span></p>
            <div style="width: 100%;height: 3px;background-color: #F5F5F5;"></div>
        </div>
        <div class="footer" style="max-width: 37.5rem;width: 100%;height: 45px;position: fixed;bottom: 0;border-top: 4px solid #F5F5F5;background-color: #ffffff;">
            <div class="row m-0 p-0" style="height: 100%;">
                <div style="width: 70%;height: 100%;text-align: center;">
                    <p class="red_text15 p-0" style="line-height: 45px;"><span style="color: #444444;">实际支付：</span>￥<span id="actual_price">0.00</span></p>
                </div>

                <div style="width: 30%;height: 100%;background: #90C549;text-align: center;line-height: 45px;" onclick="now_pay('<?php echo $url; ?>')">
                    <span style="font-family: PingFangSC-Regular;
                            font-size: 16px;
                            color: #FFFFFF;
                            letter-spacing: 0;
                            line-height: 16px;
                            vertical-align: middle;">结算</span>
                </div>

            </div>
        </div>
        <div id="modal_background" style="display: none;position: fixed;width: 100%;max-width: 37.5rem;height: 100%;top: 0;opacity: 0.48;background: #797474;margin-left: auto;margin-right: auto;"></div>
        <div id="address_form" style="width: 100%;max-width: 37.5rem;height: 50%;position: fixed;bottom: -50%;background: white;margin-left: auto;margin-right: auto;">
            <div style="width: 100%;padding: 3%;">
                <div style="border-bottom: 1px solid #DDDDDD;padding-bottom: 10px;">
                    <span class="text14_regular black444">新建地址</span>
                    <span onclick="hide_address_form()" class="mdi mdi-chevron-down" style="font-size: 21px;color: #AAAAAA;float: right;margin-top: -6px;"></span>
                </div>
            </div>
            <div class="row m-0" style="padding: 2% 5%;">
                <input type="text" class="text14_regular address_form_input" id="receiver_name" placeholder="收货人姓名（请使用真实姓名">
            </div>
            <div class="row m-0" style="padding: 2% 5%;">
                <input type="text" class="text14_regular address_form_input" id="phone" placeholder="手机号码">
            </div>
            <div class="row m-0" style="padding: 2% 5%;">
                <input type="text" class="text14_regular address_form_input" id="area" placeholder="所在地区">
            </div>
            <div class="row m-0" style="padding: 2% 5%;">
                <input type="text" class="text14_regular address_form_input" id="detailed_address" placeholder="街道、小区、门拍等详细地址">
            </div>
            <div onclick="set_default_address()" style="padding: 2% 5%;">
                <img id="default_address" set="0" src="public/img/tick_empty_circle.png" style="width: 18px;height: 18px;vertical-align: middle">&nbsp;&nbsp;
                <span class="text12_regular black444">设为默认地址</span>
            </div>
            <div style="width: 100%; height: 45px;background: #90C549;text-align: center;line-height: 45px;bottom: 0;position: absolute;">
                <span class="text16_regular whiteFFF">提交订单</span>
            </div>
        </div>
    </div>
    <form id="agent_alipay" action="<?php echo base_url('alipay/do_pay/wap'); ?>" method="post">
        <input type="hidden" name="ordertp" value="product" />
        <input type="hidden" name="title" />
        <input type="hidden" name="amount" />
        <input type="hidden" name="orderid" />
    </form>
</div>

<script>

    $(document).ready(function(){
        computation_price();
    });
    // $( window ).resize(function() {
    //     adjustImage();
    // });
    // function adjustImage(){
    // }

    function show_address_form() {
        $('#modal_background').css('display', 'block');
        $('#address_form').animate({bottom: 0},'normal');
    }

    function hide_address_form() {
        $('#modal_background').css('display', 'none');
        $('#address_form').animate({bottom: '-50%'}, 'normal');
    }

    function go_select_address(url, product_id) {
        var url = 'confirm_order/'+ url + '/' + product_id;
        location.href = '<?php echo base_url ('member/my_address/'); ?>'+url;
    }

    function computation_price() {
        var pt_cnt = $('#pt_cnt').val();
        var total_price = 0;
        for (var i=0; i<pt_cnt; i++) {
            var cnt = parseInt($('#product_cnt'+i).text());
            var price = parseFloat($('#price'+i).text());
            total_price += price * 100 * cnt;
        }
        $('#total_price').text(total_price/100);
        var delivery_price = $('#delivery_price').text();
        var coupon = $('#coupon').text();
        var cash_coupon = $('#cash_coupon').text();
        // var handle_price = $('#handle_price').text();
        var handle_price = total_price + parseFloat(delivery_price)*100 - parseFloat(coupon)*100 - parseFloat(cash_coupon)*100;
        $('#handle_price').text(handle_price/100);
        $('#actual_price').text(handle_price/100);
    }

    function plus_cnt(key) {
        var cnt = $('#product_cnt'+key).text();
        var int_cnt = parseInt(cnt);
        var str_stock = $('#stock'+key).text();
        var stock = parseInt(str_stock);
        if (int_cnt < stock){
            int_cnt += 1;
            $('#product_cnt'+key).text(int_cnt);
            computation_price();
        }

    }

    function minus_cnt(key) {
        var cnt = $('#product_cnt'+key).text();
        var int_cnt = parseInt(cnt);
        if(int_cnt != 1 ){
            int_cnt -= 1;
            $('#product_cnt'+key).text(int_cnt);
            computation_price();
        }
    }

    var weixin_or_alipay = 0;
    function check_weixin() {
        $('#weixin').attr('src', 'public/img/check.png');
        $('#alipay').attr('src', 'public/img/tick_empty_circle.png');
        weixin_or_alipay = 0;
    }

    function check_alipay() {
        $('#weixin').attr('src', 'public/img/tick_empty_circle.png');
        $('#alipay').attr('src', 'public/img/check.png');
        weixin_or_alipay = 1;
    }

    function now_pay(url) {
        if (weixin_or_alipay == 0)
            return;
        var destination = $('#destination_id').val();
        if (destination.length < 1) {
            swal("警告", "选择送货地址。", "warning");
        } else {
            var pt_cnt = $('#pt_cnt').val();
            var product = [];
            for (var i = 0; i < pt_cnt; i++) {
                var product_id = $('#product_id'+i).val();
                var amount = parseInt($('#product_cnt'+i).text());
                product[i] = {
                    id: product_id,
                    amount: amount
                }
            }
            var product_str = JSON.stringify(product);
            var price = parseFloat($('#actual_price').text());
            var delivery_price = parseFloat($('#delivery_price').text());
            var coupon = parseFloat($('#coupon').text());

            var cart = 0;
            if (url == "shopping_cart") cart = 1;
            $.post("<?php echo base_url('front/product_pay') ?>", {
                    product: product_str,
                    total: price,
                    delivery: delivery_price,
                    coupon: coupon,
                    cart: cart
                },
                function (data) {
                    var result = JSON.parse(data);
                    if (result.status == "success") {
                        console.log(data);
                        if (weixin_or_alipay == 0) {
                            // Weixin
                        } else {
                            // Alipay
                            $('input[name="title"]').val("<?php echo $product_names; ?>");
                            $('input[name="amount"]').val(price);
                            $('input[name="orderid"]').val(result.orderid);
                            $('#agent_alipay').submit();
                        }
                    } else {
                        swal("提示", "请再试一次。", "warning");
                    }
                }
            );
        }
        
    }
    function go_product_detail(url, pids) {
        var product_ids = pids.split("_");
        if (url == "shopping_cart") location.href = '<?php echo base_url ('front/shopping_cart'); ?>';
        else if (url == "product_detail") location.href = '<?php echo base_url ('front/product_detail/'); ?>' + product_ids[0];
    }
</script>