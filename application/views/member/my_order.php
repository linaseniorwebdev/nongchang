<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <div style="width: 20px;height: 30px;position:absolute;left: 0;top: 0;margin-top: 6px;margin-left: 10px;">
                        <span onclick="go_profile()" class="mdi mdi-chevron-left mdi-24px"></span>
                    </div>
                    <span class="top_title_text">我的订单</span>
                    <div style="width: 30%;position:absolute;right: 0;height: 45px;top: 10px;">
                        <img onclick="show_searchbar()" src="public/img/find.png" style="width: 20px;">
                        <img onclick="show_main_items()" src="public/img/unie644.png" style="width: 20px;margin-left: 10px;">
                    </div>

                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;">
            <div id="searchbar" class="row m-0" style="height: 50px;padding: 0 5%;display: none;border-bottom: 4px solid #F7F7F7;">
                <div class="search" style="width: 80%;float: left;">
                    <input type="text" id="search_text" class="form-control" placeholder="搜索..." style="background: url('../public/img/find.png') no-repeat scroll 7px 11px;padding-left:30px;background-size: 17px 17px;">
                </div>
                <div style="width: 20%;float:left;text-align: center;line-height: 40px;">
                    <span onclick="cancel_search()">取消</span>
                </div>
            </div>
            <div id="main_items" class="row m-0" style="background: black;opacity: 0.5;height: 50px;display: none;">
                <div id="home" onclick="go_home()" style="width: 20%;float:left;text-align: center;line-height: 50px;">
                    <img src="public/img/bottom_icon/home_unselected.png" style="width: 35px;height: 35px;">
                </div>
                <div id="products" onclick="go_products()" style="width: 20%;float:left;text-align: center;line-height: 50px;">
                    <img src="public/img/bottom_icon/product_unselected.png" style="width: 35px;height: 35px;">
                </div>
                <div id="task" onclick="go_task()" style="width: 20%;float:left;text-align: center;line-height: 50px;">
                    <img src="public/img/bottom_icon/task_unselected.png" style="width: 35px;height: 35px;">
                </div>
                <div id="profile" onclick="go_profile()" style="width: 20%;float:left;text-align: center;line-height: 50px;">
                    <img src="public/img/bottom_icon/person_unselected.png" style="width: 35px;height: 35px;">
                </div>
                <div id="close" onclick="close_main_items()" style="width: 20%;float:left;text-align: center;line-height: 50px;">
                    <img src="public/img/close.png" style="width: 25px;height: 25px;">
                </div>
            </div>
            <div id="select_status" class="row m-0 text14_regular black999" style="width: 100%;height: 49px;line-height: 45px;padding: 0 5%;border-top: 4px solid #F7F7F7;border-bottom: 4px solid #F7F7F7;">

                <div style="width: 20%;text-align: center;cursor: pointer;float:left;" onclick="my_orders(0, 'all')">
                    <div style="width: 100%;height: 41px;">
                        <span class="green81AE46">全部</span>
                    </div>
                    <div id="all_bottom" style="width: 100%;height: 4px;padding: 0 25%;">
                        <div style="width: 100%;height: 100%;background: #81AE46;"></div>
                    </div>

                </div>
                <div style="width: 20%;text-align: center;cursor: pointer;float:left;" onclick="my_orders(1,0)">
                    <div style="width: 100%;height: 41px;">
                        <span>待付款</span>
                    </div>
                    <div id="pending_bottom" style="width: 100%;height: 4px;padding: 0 25%;display: none;">
                        <div style="width: 100%;height: 100%;background: #81AE46;"></div>
                    </div>
                    <div id="pending_badge" class="alert_badge" style="left: 37%;display: none;">
                        <span id="pb" class="text12_regular whiteFFF">10</span>
                    </div>
                </div>
                <div style="width: 20%;text-align: center;cursor: pointer;float:left;" onclick="my_orders(2,1)">
                    <div style="width: 100%;height: 41px;">
                        <span>待发货</span>
                    </div>
                    <div id="delivered_bottom" style="width: 100%;height: 4px;padding: 0 25%;display: none;">
                        <div style="width: 100%;height: 100%;background: #81AE46;"></div>
                    </div>
                    <div id="delivered_badge" class="alert_badge" style="left: 55%;display: none;">
                        <span id="db" class="text12_regular whiteFFF">10</span>
                    </div>
                </div>
                <div style="width: 20%;text-align: center;cursor: pointer;float:left;" onclick="my_orders(3,2)">
                    <div style="width: 100%;height: 41px;">
                        <span>待收货</span>
                    </div>
                    <div id="receipt_bottom" style="width: 100%;height: 4px;padding: 0 25%;display: none;">
                        <div style="width: 100%;height: 100%;background: #81AE46;"></div>
                    </div>
                    <div id="receipt_badge" class="alert_badge" style="left: 73%;display: none;">
                        <span id="rb" class="text12_regular whiteFFF">10</span>
                    </div>
                </div>
                <div style="width: 20%;text-align: center;cursor: pointer;float:left;" onclick="my_orders(4,3)">
                    <div style="width: 100%;height: 41px;">
                        <span>评价</span>
                    </div>
                    <div id="evaluation_bottom" style="width: 100%;height: 4px;padding: 0 25%;display: none;">
                        <div style="width: 100%;height: 100%;background: #81AE46;"></div>
                    </div>
                </div>
            </div>
            <div class="order_items hide_scrollbar">
<!--                <div class="order_item">-->
<!--                    <div class="item_header text_12_regular">-->
<!--                        <div style="width: 50%;float: left;">-->
<!--                            <span class="black444">2019-04-06</span>-->
<!--                        </div>-->
<!--                        <div style="width: 50%;height: 100%;float: left;text-align: right;">-->
<!--                                <div style="width: calc(100% - 31px);padding-right: 5px;float: left;">-->
<!--                                    <span class="black999">交易成功</span>-->
<!--                                </div>-->
<!--                                <div style="width: 1px;height: 20px;background: #DDDDDD;margin-top: 10px;float: left;"></div>-->
<!--                                <div style="width: 30px;height: 100%;padding: 5px;float: left;text-align: left;line-height: 30px;">-->
<!--                                    <img src="public/img/shanchu.png" style="height: 20px;width: 18px;">-->
<!--                                </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item_body">-->
<!--                        <div class="product_img">-->
<!--                            <img src="public/img/my_order_product.png" style="width: 100%;height: 100%;">-->
<!--                        </div>-->
<!--                        <div class="product_detail">-->
<!--                            <p class="text13_regular black444">有机地瓜有机地瓜有机地瓜<span class="text12_medium" style="float: right;">¥169</span></p>-->
<!--                            <p class="text13_regular black444">有机地瓜有机地瓜<span class="text12_regular black999" style="float: right;">X2</span></p>-->
<!--                            <p class="text12_regular redFA5359" style="float: right;position: absolute; right: 10px;margin-top: 33px;">查看产品使用说明</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item_footer">-->
<!--                        <p class="text13_regular black999">共2件，应付总额：<span class="text13_medium redFA5359" style="float: right;">¥169.00</span></p>-->
<!--                        <div class="row m-0 p-0" style="float: right;">-->
<!--                            <img class="action_btn" src="public/img/view_logistics.png">-->
<!--                            <img class="action_btn" src="public/img/cancel_order.png">-->
<!--                            <img class="action_btn" src="public/img/remind_shipment.png">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->



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
                <span class="text14_regular black444">请在0小时30分钟内完成支付，金额 </span><span class="text14_regular redFB5E60">￥<span class="total_price">0.00</span></span>
            </div>
            <div style="padding: 5% 5%;">
                <img onclick="check_md_weixin()" id="md_weixin" src="public/img/check.png" style="width: 18px;height: 18px;">&nbsp;&nbsp;
                <span onclick="check_md_weixin()" class="text14_regular black444">微信</span>
            </div>
            <div style="padding: 5% 5%;">
                <img onclick="check_md_alipay()" id="md_alipay" src="public/img/tick_empty_circle.png" style="width: 18px;height: 18px;">&nbsp;&nbsp;
                <span onclick="check_md_alipay()" class="text14_regular black444">支付宝</span>
            </div>
            <div style="width: 100%; height: 45px;background: #90C549;text-align: center;line-height: 45px;bottom: 0;position: absolute;" onclick="pay_now()">
                <span class="text16_regular whiteFFF">确认支付</span>
            </div>
        </div>
    </div>
</div>

<style>
    .order_items{
        position: absolute;
        top: 95px;
        bottom: 0;
        width: 100%;
        overflow-y: scroll;
    }
    .order_item{
        width: 100%;
        padding: 5px 10px;
        border-bottom: 20px solid #F5F5F5;
    }
    .item_header{
        width: 100%;
        height: 40px;
        line-height: 40px;
        border-bottom: 1px solid #DDDDDD;
    }
    .item_body{
        width: 100%;
        height: 130px;
        border-bottom: 1px solid #DDDDDD;
    }
    .product_img{
        width: 37%;
        height: 100%;
        padding: 10px 10px 10px 0;
        float: left;
    }
    .product_detail{
        width: 63%;
        height: 100%;
        padding: 15px 0 10px 0;
        float: left;
    }
    .item_footer{
        width: 100%;
        height: 80px;
        padding: 10px 0;
        text-align: right;
    }
    .item_footer .action_btn{
        width: 80px;
        height: 35px;
        margin-right: 10px;
    }
</style>
<script>
    $(document).ready(function() {
        my_orders(0, 'all');
    } );
    function show_searchbar() {
        $('#searchbar').css('display', 'block');
        $('#select_status').css('display', 'none');
        $('#main_items').css('display', 'none');
    }
    function cancel_search() {
        $('#searchbar').css('display', 'none');
        $('#select_status').css('display', 'block');
        $('#main_items').css('display', 'none');
    }
    function show_main_items() {
        $('#searchbar').css('display', 'none');
        $('#select_status').css('display', 'none');
        $('#main_items').css('display', 'block');
    }
    function close_main_items() {
        $('#searchbar').css('display', 'none');
        $('#select_status').css('display', 'block');
        $('#main_items').css('display', 'none');
    }
    function go_home() {
        location.href = '<?php echo base_url ('front'); ?>';
    }
    function go_products() {
        location.href = '<?php echo base_url ('front/top_product'); ?>';
    }
    function go_task() {
        location.href = '<?php echo base_url ('front/task'); ?>';
    }
    function my_orders(id, status) {
        selected_bottom_line(id);
        $.post("<?php echo base_url('member/my_order') ?>", {status: status},
            function (data) {
                var result = JSON.parse(data);
                if (result.state == "success") {
                    var orders = result['orders'];
                    var products = result['products'];
                    var pt_ids_amounts = result['pt_ids_amounts'];
                    console.log(orders);
                    if (orders.length > 0) {
                        if (status == 0) {

                        }
                        else if (status == 1){

                        }
                        else if (status == 2){

                        }
                        var html = '';
                        for (var i = 0; i< orders.length; i++) {

                            var order = orders[i];
                            var product = products[i];
                            var pt_cnt = 0;
                            var total_price = 0;
                            html += '<div class="order_item">';
                            html += '<div class="item_header text_12_regular">';
                            html += '<div style="width: 50%;float: left;">';
                            html += '<span class="black444">'+ order['created_at'] +'</span>';
                            html += '</div>';
                            html += '<div style="width: 50%;height: 100%;float: left;text-align: right;">';
                            if (order['status'] == 0){
                                html += '<div style="width: 100%;padding-right: 5px;float: left;">';
                                html += '<span class="black999">待付款</span>';
                                html += '</div>';
                            }
                            else if (order['status'] == 1) {
                                html += '<div style="width: 100%;padding-right: 5px;float: left;">';
                                html += '<span class="black999">待发货</span>';
                                html += '</div>';
                            }
                            else if (order['status'] == 2) {
                                html += '<div style="width: 100%;padding-right: 5px;float: left;">';
                                html += '<span class="black999">已发货</span>';
                                html += '</div>';
                            }
                            else if (order['status'] == 3) {
                                html += '<div style="width: calc(100% - 31px);padding-right: 5px;float: left;">';
                                html += '<span class="black999">已完成</span>';
                                html += '</div>';
                                html += '<div style="width: 1px;height: 20px;background: #DDDDDD;margin-top: 10px;float: left;"></div>';
                                html += '<div style="width: 30px;height: 100%;padding: 5px;float: left;text-align: left;line-height: 30px;">';
                                html += '<img onclick="delete_order('+ order['id'] +')" src="public/img/shanchu.png" style="height: 20px;width: 18px;">';
                                html += '</div>';
                            }
                            else if (order['status'] == 4) {
                                html += '<div style="width: 100%;padding-right: 5px;float: left;">';
                                html += '<span class="black999">已关闭</span>';
                                html += '</div>';
                            }
                            html += '</div>';
                            html += '</div>';

                            for(var j=0; j < pt_ids_amounts[i].length; j++) {
                                html += '<div class="item_body">';
                                html += '<div class="product_img">';
                                html += '<img src="../' + product[j]['image'] + '" style="width: 100%;height: 100%;">';
                                html += '</div>';
                                html += '<div class="product_detail">';
                                html += '<p class="text13_regular black444">' + product[j]['name'] + '<span class="text12_medium" style="float: right;">¥' + product[j]['price'] + '</span></p>';
                                html += '<p class="text13_regular black444">订单编号：<span class="text12_regular black999" style="float: right;">' + order['orderno'] + '</span></p>';
                                html += '<p onclick="show_description('+i+','+j+')" class="text12_regular redFA5359" style="float: right;position: absolute; right: 10px;margin-top: 33px;">查看产品使用说明</p>';
                                html += '</div>';
                                html += '</div>';
                                html += '<div id="description'+i+'_'+j+'" class="row m-0" style="padding: 5px 10px;display: none;">';
                                html += '<span class="text13_regular black444">'+ product[j]['description'] +'</span>';
                                html += '</div>';
                                pt_cnt += pt_ids_amounts[i][j]['amount'];
                                total_price += pt_cnt * product[j]['price'] + 5; // 运费：￥5
                            }
                            html += '<div class="item_footer">';
                            html += '<p class="text13_regular black999">共'+ pt_cnt +'件，应付总额：<span class="text13_medium redFA5359" style="float: right;">¥'+ total_price +'</span></p>';
                            html += '<div class="row m-0 p-0" style="float: right;">';
                            if (order['status'] == 0) {
                                html += '<img onclick="cancel_order('+ order['id'] +', 0)" class="action_btn" src="public/img/cancel_order.png">';
                                html += '<img onclick="show_pay_modal('+ order['id'] +', '+total_price+')" class="action_btn" src="public/img/pay_now.png">';
                            }
                            else if (order['status'] == 1) {
                                html += '<img class="action_btn" src="public/img/view_logistics.png">';
                                html += '<img onclick="cancel_order('+ order['id'] +', 1)" class="action_btn" src="public/img/cancel_order.png">';
                                html += '<img onclick="remind_shipment('+ order['id'] +')" class="action_btn" src="public/img/remind_shipment.png">';
                            }
                            else if (order['status'] == 2) {
                                html += '<img class="action_btn" src="public/img/event_logistics.png">';
                                html += '<img onclick="cancel_order('+ order['id'] +', 2)" class="action_btn" src="public/img/cancel_order.png">';
                                html += '<img onclick="complete_order('+ order['id'] +')" class="action_btn" src="public/img/confirm_delivery.png">';
                            }
                            else if (order['status'] == 3) {
                                html += '<img class="action_btn" src="public/img/view_logistics.png">';
                                html += '<img onclick="buy_again('+ order['id'] +')" class="action_btn" src="public/img/buy_btn_again.png">';
                                if (order['review'] == 0) 
                                    html += '<img onclick="give_evaluation('+ order['id'] +')" class="action_btn" src="public/img/feedback.png">';
                                

                            }
                            else if (order['status'] == 4) {
                                html += '<img onclick="delete_order('+ order['id'] +')" class="action_btn" src="public/img/delete_order.png">';
                            }
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        }
                        $('.order_items').html(html);
                    }
                    else{
                        var html = '';
                        html += '<div style="width: 100%;text-align: center;margin-top: 30%;"><h3>没有订单</h3></div>';
                        $('.order_items').html(html);
                    }

                }
                else{
                    swal("提示", result.reason, "warning");
                }

            }
        );
        // if (status == 0)
    }
    function show_description(i , j) {
        $('#description'+i+'_'+j).css('display', 'block');
    }
    function cancel_order(order_id, status) {
        $.post("<?php echo base_url('member/cancel_order') ?>", {status: status, order_id:order_id},
            function (data) {
                var result = JSON.parse(data);
                if (result.state == "success") {
                    my_orders(0, "all");
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    }
    var order_id = 0;
    var payment_type = 1;

    function show_pay_modal(orderid, price) {
        $('#modal_background').css('display', 'block');
        $('#pay_modal').animate({bottom: 0},'normal');
        $('.total_price').text(price);
        order_id = orderid;

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
    function pay_now() {
        $.post("<?php echo base_url('member/pay_order') ?>", {order_id:order_id},
            function (data) {
                var result = JSON.parse(data);
                if (result.state == "success") {
                    my_orders(2, 1);
                    hide_pay_modal();
                    payment_type = 1;
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    }
    function remind_shipment(order_id) {
        $.post("<?php echo base_url('member/remind_shipment') ?>", {order_id:order_id},
            function (data) {
                var result = JSON.parse(data);
                if (result.state == "success") {
                    my_orders(3, 2);
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    }
    function complete_order(order_id) {
        $.post("<?php echo base_url('member/complete_order') ?>", {order_id:order_id},
            function (data) {
                var result = JSON.parse(data);
                if (result.state == "success") {
                    my_orders(4, 3);
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    }
    function give_evaluation(order_id){
        location.href = '<?php echo base_url ('member/go_evaluation?order_id='); ?>' + order_id;
    }
    function buy_again(order_id){

    }
    function delete_order(order_id) {
        $.post("<?php echo base_url('member/delete_order') ?>", {order_id:order_id},
            function (data) {
                var result = JSON.parse(data);
                if (result.state == "success") {
                    my_orders(0, 'all');
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    }
    // function evaluation(id) {
    //     selected_bottom_line(id);
    //     var html = '';
    //     html += '';
    // }
    function selected_bottom_line(id) {
        $('#all_bottom').css('display', 'none');
        $('#pending_bottom').css('display', 'none');
        $('#delivered_bottom').css('display', 'none');
        $('#receipt_bottom').css('display', 'none');
        $('#evaluation_bottom').css('display', 'none');
        if (id == 0) $('#all_bottom').css('display', 'block');
        else if (id == 1) $('#pending_bottom').css('display', 'block');
        else if (id == 2) $('#delivered_bottom').css('display', 'block');
        else if (id == 3) $('#receipt_bottom').css('display', 'block');
        else $('#evaluation_bottom').css('display', 'block');
    }
    function go_profile() {
        location.href = '<?php echo base_url ('member'); ?>';
    }

</script>