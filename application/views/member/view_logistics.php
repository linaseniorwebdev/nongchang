<!-- <div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <div style="width: 20px;height: 30px;position:absolute;left: 0;top: 0;margin-top: 6px;margin-left: 10px;">
                        <span onclick="go_profile()" class="mdi mdi-chevron-left mdi-24px"></span>
                    </div>
                    <span class="top_title_text">查看物流</span>

                </div>
            </div>
        </div> -->
        <!-- <div class="content-body" style="margin-top: 45px;"> -->
            
            
            <!-- <div class="order_items hide_scrollbar" style="top:45px;z-index: 0;"> -->
                <!-- <div class="result-top">
                    <span id="sortSpan" class="col1-down" title="切换排序" onclick="sortToggle();">时间</span>
                    <span class="col2">地点和跟踪进度</span>
                </div>
                <table id="queryResult" class="result-info" cellspacing="0">
                    <tbody>
                        <tr class="last">
                            <td class="row1">
                                <span class="day">2019.02.23</span>
                                <span class="time">21:16</span>&nbsp;&nbsp;
                                 <span class="week">星期六</span>
                            </td>
                            <td class="status status-wait">&nbsp;
                                <div class="col2">
                                    <span class="step">
                                        <span class="line1"></span>
                                        <span class="line2"></span>
                                    </span>
                                </div>
                            </td>
                            <td class="context">【学院站】的操作员【学院站】进行归班审核，联系电话【18932935605】，联系手机【】</td>
                        </tr>
                        <tr>
                            <td class="row1">
                                <span class="day">2019.02.23</span>
                                <span class="time">13:23</span>
                            </td>
                            <td class="status">&nbsp;
                                <div class="col2">
                                    <span class="step">
                                        <span class="line1"></span>
                                        <span class="line2"></span>
                                    </span>
                                </div>
                            </td>
                            <td class="context">【学院站】的小件员【学院站】领货，联系电话【18932935605】，联系手机【】</td>
                        </tr>
                        <tr>
                            <td class="row1">
                                <span class="day">2019.02.22</span>
                                <span class="time">18:24</span>&nbsp;&nbsp;
                                <span class="week">星期五</span>
                            </td>
                            <td class="status-first">&nbsp;</td>
                            <td class="context">从【总部】导入数据，操作人【总部】，联系电话【】，联系手机【】</td>
                        </tr>
                    </tbody>
                </table> -->
            <!-- </div> -->

            
              <iframe class="hide_scrollbar" scrolling="no" src="https://m.kuaidi100.com/app/query/?com=datianwuliu&nu=6176832803&coname=meizu&callbackurl=http://192.168.8.113/nongchang/member/my_order"></iframe>
            
        <!-- </div> -->
    <!-- </div> -->
    <input type="hidden" id="order_id" value="<?php echo $order_id;?>">
<!-- </div> -->

<style>
    iframe{
      height: 100%;
      width: 100%;
      position: absolute;
      top: 0;
      margin: auto ;
      left: 0;
      border:none;
      overflow:hidden;
    }
    .result-top {
      width: 100%;
      height: 43px;
      background-color: #ffffff;
      border-top: 1px solid #bbbbbb;
    }
    .result-top span, .result-top a {
      display: inline-block;
      height: 43px;
      line-height: 43px;
      vertical-align: middle;
      font-size: 14px;
    }
    .result-top a {
      padding-left: 23px;
      width: 37px;
      font-weight: bold;
      color: #3278e6;
    }
    .result-top .a-rss {
      background: url("./public/img/spider_search_v4.png") 3px -312px no-repeat;
    }
    .result-top .a-share {
      background: url("./public/img/spider_search_v4.png") 8px -342px no-repeat;
    }
    .result-top .col1 {
      background: url("./public/img/spider_search_v4.png") 80px -900px no-repeat;
      width: 90px;
      text-align: center;
      color: #323232;
      cursor: pointer;
      padding-left: 14px;
      font-size:16px;
    }
    .result-top .col1-down {
      /*background: url("./public/img/spider_search_v4.png") 80px -941px no-repeat;*/
      width: 90px;
      text-align: center;
      font-size: 16px;
      color: #5a5a5a;
      cursor: pointer;
      padding-left: 14px;
    }
    .result-top .col2 {
      width: 200px;
      text-align: left;
      font-size: 16px;
      color: #5a5a5a;
      padding-left: 50px;
    }
    .result-info {
      width: 100%;
      float: left;
    }
    .queryRight {
      float: right;
      margin-right: 10px;
    }
    .result-info td {
      padding: 7px;
      color: #828282;/*border-bottom: 1px solid #d2d2d2;
      background-color: #f5f5f5*/
    }
    .result-info .status {
      width: 30px;
      background: url("./public/img/spider_search_v4.png") 13px -764px no-repeat;
    }
    .result-info-down .status {
      width: 30px;
      background: url("./public/img/spider_search_v4.png") -30px -764px no-repeat;
    }
    .result-info .status-first {
      background: url("./public/img/spider_search_v4.png") 13px -804px no-repeat;
    }
    .result-info .status-check {
      background: url("./public/img/spider_search_v4.png") 10px -717px no-repeat;
    }
    .result-info .status-wait {
      background: url("./public/img/spider_search_v4.png") -30px -802px no-repeat;
    }
    .status .col2 {
      position: relative;
      z-index:-1;
    }
    .status .line1 {
      position: absolute;
      left: 6.4px;
      width: 0.57em;
      height: 5em;
      border-right: 0.08em solid #d2d2d2;
      top: -5px;
      z-index: -1;
    }
    .day {
      display:block;
      color:#ccc;
    }
    .time {
      font-size: 14px;
    }
    .result-info .last td,  .result-info .last td a{
      color: #ff7800;
      border-bottom: none;
    }
    .result-info td a:hover {
      color: #3278e6;
    }
    .result-info .row1 {
      width: 105px;
      text-align: center;
      padding-left: 14px;
      padding-right: 0;
    }
    .context {
      font-size: 12px;
      padding-left: 7px !important;
    }
    .context a {
      color: #828282;
    }
   



    .order_items{        
        position: absolute;
        top: 95px;
        bottom: 0;
        width: 100%;
        overflow-y: scroll;
    }
    .order_item{
        float: left;
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
        /*height: 80px;*/
        padding: 10px 0;
        text-align: right;
    }
    .item_footer .action_btn{
        width: 80px;
        height: 35px;
        margin-right: 10px;
    }
    .star-rating {
      line-height:32px;
      font-size:2em;
    }

    .star-rating .mdi-star{color: yellow;}
</style>
<script>
    $(document).ready(function() {
        var order_id = $('#order_id').val();
        // my_order(order_id);    
        let elem = document.querySelector("iframe");
        // elem.requestFullscreen();  
        elem.style.height = $(window).height() + 'px'; 
    } );
    var selected_order_again = 0;
    var global_orders, global_products, global_pt_ids_amounts;
    function my_order(order_id) {        
        $.post("<?php echo base_url('member/load_logistics') ?>", {order_id: order_id},
            function (data) {
            	// console.log(data);
                var result = JSON.parse(data);
                if (result.state == "success") {
                    var order = result['order'];
                    
                    var products = result['products'];
                    
                    var pt_ids_amounts = result['pt_ids_amounts'];
                    
                    
                    
                       
                        var html = '';
                        for (var i = 0; i< 1; i++) {

                            
                            
                            
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

                            for(var j=0; j < pt_ids_amounts.length; j++) {
                                var product = products[j];
                                html += '<div class="item_body">';
                                html += '<div class="product_img">';
                                html += '<img src="../../' + product['image'] + '" style="width: 100%;height: 100%;">';
                                html += '</div>';
                                html += '<div class="product_detail">';
                                html += '<p class="text13_regular black444">' + product['name'] + '<span class="text12_medium" style="float: right;">¥' + product['price'] + '</span></p>';
                                html += '<p class="text13_regular black444">订单编号：<span class="text12_regular black999" style="float: right;">' + order['orderno'] + '</span></p>';
                                if(order['status'] > 0){
                                    if(order['delivery_no'] != null){
                                        html += '<p class="text13_regular black444">物流单号：<span class="text12_regular black999" style="float: right;">' + order['delivery_no'] + '</span></p>';
                                    }
                                    else{
                                        html += '<p class="text13_regular black444">物流单号：<span class="text12_regular black999" style="float: right;"></span></p>';
                                    }
                                    html += '<p onclick="show_description('+i+','+j+')" class="text12_regular redFA5359" style="float: right;position: absolute; right: 10px;margin-top: 7px;">查看产品使用说明</p>';
                                }
                                else {
                                    html += '<p onclick="show_description('+i+','+j+')" class="text12_regular redFA5359" style="float: right;position: absolute; right: 10px;margin-top: 33px;">查看产品使用说明</p>';
                                }
                                html += '</div>';
                                html += '</div>';
                                html += '<div id="description'+i+'_'+j+'" class="row m-0" style="padding: 5px 10px;display: none;">';
                                html += '<span class="text13_regular black444">'+ product['description'] +'</span>';
                                html += '</div>';
                                pt_cnt += pt_ids_amounts[j]['amount'];
                                total_price += pt_ids_amounts[j]['amount'] * parseFloat(product['price']); // 运费：￥5
                            }
                            total_price += parseFloat(order['delivery']);
                            html += '<div class="item_footer">';
                            html += '<p class="text13_regular black999">共'+ pt_cnt +'件，应付总额：<span class="text13_medium redFA5359" style="float: right;">¥'+ total_price +'</span></p>';                            
                            html += '</div>';
                            html += '</div>';
                        }
                        $('.order_items').html(html);
                    

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
    
    function go_profile() {
        location.href = '<?php echo base_url ('member/my_order'); ?>';
    }

</script>