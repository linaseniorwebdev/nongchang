<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_back()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">发布任务</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-bottom: 60px;margin-top: 45px;">
            <div class="row m-0 p-0">
                <img id="header-img1" src="public/img/task/publish_task_header.png" class="home_header_img">
            </div>
            <input type="hidden" id="categories_cnt" value="<?php echo count($categories);?>"/>
            <div class="row m-0" style="height: 45px;padding: 0 7%;overflow-y: hidden;overflow-x: auto;border-bottom: 4px solid #F7F7F7;">
                <?php if(count($categories)>0) { foreach ($categories as $key => $category){?>
                <div onclick="select_task_category(<?php echo $key;?>, <?php echo $category['id'];?>)" style="width: 10%;text-align: center;margin: 0 5%;line-height: 42px;">
                    <?php if ($key == 0){?>
                        <input type="hidden" id="first_cate_id" value="<?php echo $category['id'];?>"/>
                        <span id="category_name<?php echo $key;?>" class="text14_regular black999 green81AE46"><?php echo $category['name'] ?></span>
                        <div id="selected_line<?php echo $key;?>" style="width: 9%;height: 4px;background: #90C549;position: absolute;"></div>
                    <?php } else { ?>
                        <span id="category_name<?php echo $key;?>" class="text14_regular black999"><?php echo $category['name'] ?></span>
                        <div id="selected_line<?php echo $key;?>" style="width: 9%;height: 4px;background: #999999;position: absolute;"></div>
                    <?php } ?>

                </div>
                <?php } }?>

            </div>
            <div id="task_types" class="row m-0" style="padding: 5% 4%;">

<!--                <div class="col-sm-4" style="width: 33.333%;padding: 2% 2%;">-->
<!--                    <div style="width: 100%;height: 44px;background: #8B572A;border-radius: 8px;text-align: center;line-height: 44px;">-->
<!--                        <span class="text14_medium whiteFFF">浇水</span>-->
<!--                        <img src="public/img/task/check_white.png" style="height: 30%;position: absolute;top: 14px;right: 14px;">-->
<!--                    </div>-->
<!--                </div>-->

            </div>
            <div style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;border-bottom: 3px solid #F7F7F7;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black444">备注：</span>
                    <input type="text" class="text14_regular" id="description" placeholder="填写备注" style="width: 80%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;border-bottom: 3px solid #F7F7F7;">
                <div class="row m-0 text15_regular" style="height: 50px;line-height: 50px;padding-top: 5px;">
                    <div style="width: 25%;height: 40px;line-height: 40px;text-align: center;">
                        <span class="text15_regular black444" style="line-height: 40px">我的土地</span>
                    </div>
                    <div style="width: 75%;height: 40px;text-align: center;">
                        <select name="lands" id="lands" class="form-control" style="width: 80%;height: 40px;vertical-align: middle;margin-left: auto;margin-right: auto;">
                            <?php
                            if (count($lands) > 0) {
                                foreach ($lands as $key => $land) {
                                    echo '<option value="' . $land['id'] . '">' . $land['landnum'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;">
                <div style="height: 40px;width: 100%;border-bottom: 1px solid #DDDDDD;line-height: 40px;">
                    <span class="text14_medium black444">费用清单</span>
                </div>
                <div class="text14_regular" style="height: 40px;width: 100%;line-height: 50px;">
                    <span class="black444">土地面积</span>
                    <span style="color: #FA5359;float: right;height: 40px;"><span id="area"><?php echo $lands[0]['area']; ?></span>亩</span>
                </div>
                <div class="text14_regular" style="height: 40px;width: 100%;line-height: 30px;border-bottom: 1px solid #DDDDDD;">
                    <span class="black444">人工单价</span>
                    <span style="color: #FA5359;float: right;"><span id="cost">0</span>元</span>
                </div>
                <div class="text14_regular" style="height: 40px;width: 100%;line-height: 30px;">
                    <span class="black444">合计费用</span>
                    <span style="color: #FA5359;float: right;"><span id="labour_unit_price">0</span>元</span>
                </div>
            </div>
        </div>
        <div class="footer" style="max-width: 37.5rem;width: 100%;height: 60px;position: fixed;bottom: 0;border-color: transparent;background: #F7F7F7;border-top: 3px solid #F5F5F5;line-height: 54px;text-align: center;">
            <button onclick="publish_task()" class="text16_regular whiteFFF" style="width: 90%;height: 42px;background: #90C549;border-radius: 8px;border: none;">发布</button>
        </div>
    </div>
    <div id="payment_div" style="max-width: 37.5rem;width: 100%;padding: 4% 4% 0 4%;position: fixed;bottom:-280px;z-index: 9;background: white;">
        <p class="black_text14 p-0" style="font-size: 15px;margin: 5%;">支付方式<span id="div_down_btn" class="mdi mdi-arrow-down" style="float: right;font-size: 18px;"></span></p>
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
        <div style="width: 100%;height: 60px;line-height: 60px;text-align: center;">
            <button onclick="pay_now()" class="text16_regular whiteFFF" style="width: 100%;height: 42px;background: #90C549;border-radius: 8px;border: none;">支付</button>
        </div>
    </div>

    <form id="agent_alipay" action="<?php echo base_url('alipay/do_pay/wap'); ?>" method="post">
        <input type="hidden" name="ordertp" value="product" />
        <input type="hidden" name="title" />
        <input type="hidden" name="amount" />
        <input type="hidden" name="orderid" />
    </form>
</div>
<style>
    #remark::placeholder {
        color: #AAAAAA;
        opacity: 1; /* Firefox */
    }

    #remark:-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: #AAAAAA;
    }

    #remark::-ms-input-placeholder { /* Microsoft Edge */
        color: #AAAAAA;
    }
</style>
<script>
    var task_types_cnt = 0;
    var selected_type_id = 0;
    var land_id = 0;
    $(document).ready(function(){
        var first_cate_id = $('#first_cate_id').val();
        select_task_category(0, first_cate_id);
        land_id = $('#lands').val();
    });
    function go_select_area() {
        location.href = '<?php echo base_url ('front/select/area'); ?>';
    }

    function select_task_category(key, category_id) {
        var categories_cnt = $('#categories_cnt').val();
        for (var i=0; i < categories_cnt; i++) {
            $('#category_name'+i).removeClass('green81AE46');
            $('#selected_line'+i).css('background', '#999999');
        }
        $('#category_name'+key).addClass('green81AE46');
        $('#selected_line'+key).css('background', '#90C549');

        $.post("<?php echo base_url('front/publish_task') ?>", {category_id: category_id},
            function (data) {
                var result = JSON.parse(data);
                if (result.status == "success") {
                    var task_types = result['task_types'];
                    var html = '';
                    if (task_types.length > 0) {
                        task_types_cnt = task_types.length;
                        for (var i=0; i<task_types.length; i++){
                            var task_type = task_types[i];
                            if (i==0){
                                html += '<div onclick="click_task_type('+ i +','+task_type['id']+', '+ task_type['cost'] + ')" class="col-sm-4" style="width: 33.333%;padding: 2% 2%;">';
                                html += '<div id="task_type_item'+i+'" style="width: 100%;height: 44px;background: #8B572A;border-radius: 8px;text-align: center;line-height: 44px;">';
                                html += '<span id="task_type_name'+i+'" class="text14_medium whiteFFF">'+ task_type['name'] +'</span>';
                                html += '<img id="selected_type_item'+i+'" src="public/img/task/check_white.png" style="height: 30%;position: absolute;top: 14px;right: 14px;">';
                                html += '</div>';
                                html += '</div>';
                                $('#cost').text(task_type['cost']);
                                selected_type_id = task_type['id'];
                            }
                            else{
                                html += '<div onclick="click_task_type('+ i +','+task_type['id']+', '+ task_type['cost'] +')" class="col-sm-4" style="width: 33.333%;padding: 2% 2%;">';
                                html += '<div id="task_type_item'+i+'" style="width: 100%;height: 44px;background: #F5A623;border-radius: 8px;text-align: center;line-height: 44px;">';
                                html += '<span id="task_type_name '+i+'" class="text14_medium whiteFFF">'+ task_type['name'] +'</span>';
                                html += '<img id="selected_type_item'+i+'" src="public/img/task/check_white.png" style="height: 30%;position: absolute;top: 14px;right: 14px;display: none;">';
                                html += '</div>';
                                html += '</div>';
                            }

                        }
                        $('#task_types').html(html);
                    }
                    else{
                        html += '<div style="width: 100%;text-align: center;margin-top: 20px;"><h3>没有任务</h3></div>';
                        $('#task_types').html(html);
                        $('#cost').text(0);
                        selected_type_id = 0;
                    }
                    compute_total_price();
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    }
    function click_task_type(key, task_type_id, cost) {
        for(var i=0 ;i<task_types_cnt; i++){
            $('#task_type_item'+i).css('background' , '#F5A623');
            $('#selected_type_item'+i).css('display' , 'none');
        }
        $('#task_type_item'+key).css('background' , '#8B572A');
        $('#selected_type_item'+key).css('display' , 'block');
        $('#cost').text(cost);
        selected_type_id = task_type_id;
        compute_total_price();
    }
    function compute_total_price(){
        var area = $('#area').text();
        var cost = $('#cost').text();
        var labour_unit_price = parseFloat(area) * parseFloat(cost);
        $('#labour_unit_price').text(labour_unit_price.toFixed(2));
    }
    $("#lands").change(function() {
        land_id = $('#lands').val();
        $.post("<?php echo base_url('front/publish_task_area') ?>", {land_id: land_id},
            function (data) {
                var result = JSON.parse(data);
                if (result.status == "success") {
                    var land_area = result['land']['area'];
                    $('#area').text(land_area);
                    compute_total_price();
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    });
    function publish_task() {
        $("#payment_div").animate({bottom:"0"});       
    }
    $("#div_down_btn").click(function(){
      $("#payment_div").animate({bottom:"-280px"});
    });
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
    function pay_now() {
        if (weixin_or_alipay == 0)
            return;
        if (selected_type_id == 0) {
            swal("警告", "请选择任务的类别。", "warning");
            return;
        }
        if (land_id == 0) {
            swal("警告", "请选择土地。", "warning");
            return;
        }
        var description = $('#description').val();
        var price = parseFloat($('#labour_unit_price').text());
        $.post("<?php echo base_url('front/publish_my_task') ?>", {type: selected_type_id, land_id: land_id, description: description, price:price},
            function (data) {
                var result = JSON.parse(data);
                if (result.status == "success") {
                    if (weixin_or_alipay == 0) {
                            // Weixin
                    } else {
                        // Alipay
                        // console.log(result.task_id);
                        $('input[name="title"]').val("支付确认：发饰任务");
                        $('input[name="amount"]').val(price);
                        $('input[name="orderid"]').val(result.task_id);
                        $('#agent_alipay').submit();
                        $("#payment_div").animate({bottom:"-280px"});
                    }
                    // location.href = '<?php echo base_url ('front/mission_plan'); ?>';
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    }
</script>