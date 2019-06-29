<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F5F5F5;height: 100%;">
    <div class="content-wrapper" style="padding: 0;height: 100%;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;border-bottom: 2px solid #F5F5F5;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span class="top_title_text">我的</span>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="margin-top: 45px;margin-bottom: 48px;position: absolute;width: 100%;bottom: 0;top: 0;background: white;overflow-y: scroll;">
            <div style="width: 100%;height: 345px;background-image: url('public/img/myorder/person_background.png');background-size: 100% 100%;">
                <p class="m-0 text14_regular brown8B572A" style="padding: 3% 0 0 5%;"><span id="username"><?php echo $user['fullname']; ?></span>，欢迎加入</p>
                <div style="width: 100%;height: 27%;text-align: center;">
                    <?php if($user['photo']){ ?>
                        <img src="<?php echo $user['photo']; ?>" style="width: 15%;border-radius:50%;"><br>
                    <?php }
                    else{ ?>
                        <img src="uploads/avatars/default.png" style="width: 15%;border-radius:50%;"><br>
                    <?php } ?>
                    <span class="text14_medium brown8B572A"><?php echo $user['usernum']; ?></span>
                </div>
                <div style="width: 100%;height: calc(70% - 14px);padding: 5%;">
                    <div class="row m-0" style="height: 45%;border-bottom: 2px solid #F5F5F5;">
                        <div style="width: 25%;height: 100%;text-align: center;">
                            <div style="width: 100%;height: 50%;">
                                <span class="text15_medium yellowF5A623" style="position: relative;top: 25%;">
                                    <?php if ($today) echo $today; else echo "0.00"; ?>
                                </span>
                            </div>
                            <div style="width: 100%;height: 50%;">
                                <span class="text14_light">今日收益</span>
                            </div>
                        </div>
                        <div style="width: 25%;height: 100%;text-align: center;">
                            <div style="width: 100%;height: 50%;">
                                <span class="text15_medium yellowF5A623" style="position: relative;top: 25%;">
                                    <?php if ($yesterday) echo $yesterday; else echo "0.00"; ?>
                            </div>
                            <div style="width: 100%;height: 50%;">
                                <span class="text14_light">昨日收益</span>
                            </div>
                        </div>
                        <div style="width: 25%;height: 100%;text-align: center;">
                            <div style="width: 100%;height: 50%;">
                                <span class="text15_medium yellowF5A623" style="position: relative;top: 25%;">
                                    <?php if ($total) echo $total; else echo "0.00"; ?>
                            </div>
                            <div style="width: 100%;height: 50%;">
                                <span class="text14_light">累计收益</span>
                            </div>
                        </div>
                        <div style="width: 25%;height: 100%;text-align: center;">
                            <div style="width: 80%;height: 50%;background: #FA5359;border-radius: 10px;margin-top: 20%;float: right;display: table;" onclick="go_apply_withdrawal()">
                                <span class="text15_regular whiteFFF" style="display: table-cell;vertical-align: middle;">提现</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0" style="height: 55%;">
                        <div class="m-0 text15_medium green81AE46" style="width: 100%;">
                            <div style="width: 25%;text-align: center;padding-top: 4%;">
                                <span>我的粮仓</span>
                            </div>
                        </div>
                        <div class="row m-0" style="width: 100%;height: calc(100% - 15px);">
                            <div style="width: 25%;height: 100%;text-align: center;">
                                <div style="width: 100%;height: 50%;">
                                    <span class="text15_medium brown8B572A" style="position: relative;top: 25%;">
                                        <?php if ($stock_today) echo $stock_today; else echo "0.00"; ?>
                                    </span>
                                </div>
                                <div style="width: 100%;height: 50%;">
                                    <span class="text14_light">今日收益</span>
                                </div>
                            </div>
                            <div style="width: 25%;height: 100%;text-align: center;">
                                <div style="width: 100%;height: 50%;">
                                    <span class="text15_medium brown8B572A" style="position: relative;top: 25%;">
                                        <?php if ($stock_yesterday) echo $stock_yesterday; else echo "0.00"; ?>
                                    </span>
                                </div>
                                <div style="width: 100%;height: 50%;">
                                    <span class="text14_light">昨日收益</span>
                                </div>
                            </div>
                            <div style="width: 25%;height: 100%;text-align: center;">
                                <div style="width: 100%;height: 50%;">
                                    <span class="text15_medium brown8B572A" style="position: relative;top: 25%;">
                                        <?php if ($stock_total) echo $stock_total; else echo "0.00"; ?>
                                    </span>
                                </div>
                                <div style="width: 100%;height: 50%;">
                                    <span class="text14_light">累计收益</span>
                                </div>
                            </div>
                            <div style="width: 25%;height: 100%;text-align: center;">
                                <div onclick="go_manage()" style="width: 80%;height: 48%;background: #F5A623;border-radius: 10px;margin-top: 20%;float: right;display: table;">
                                    <span class="text15_regular whiteFFF" style="display: table-cell;vertical-align: middle;">管理</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text15_regular black444" style="width: 100%;">
                <?php if (isset($request)) { if ($request['status'] == 1) { ?>
                    <div class="row m-0" onclick="go_my_products()" style="height: 50px;border-top: 4px solid #F5F5F5;">
                    <div style="width: 100%;padding: 5px 5%;line-height: 36px;">
                        <div class="row m-0 p-0" style="width: 40px;height: 100%;float:left;">
                            <img src="public/img/myshop.png" style="height: 30px;margin: auto;">
                        </div>
                        <div style="float:left;">
                            <span>我的店铺</span>
                        </div>
                        <div style="float:right;width: 40px;">
                            <span class="mdi mdi-chevron-right mdi-24px" style="position: absolute;right: 3%;"></span>
                        </div>

                    </div>
                </div>
                <?php }} ?>
                <div class="row m-0" onclick="go_my_order()" style="height: 50px;border-top: 1px solid #F5F5F5;">
                    <div style="width: 100%;padding: 5px 5%;line-height: 36px;">
                        <div class="row m-0 p-0" style="width: 40px;height: 100%;float:left;">
                            <img src="public/img/myorder/order.png" style="height: 30px;margin: auto;">
                        </div>
                        <div style="float:left;">
                            <span>我的订单</span>
                        </div>
                        <div style="float:right;width: 40px;">
                            <span class="mdi mdi-chevron-right mdi-24px" style="position: absolute;right: 3%;"></span>
                        </div>

                    </div>
                </div>
                <div class="row m-0" onclick="go_bankcard_list()" style="height: 50px;border-top: 1px solid #F5F5F5;">
                    <div style="width: 100%;padding: 5px 5%;line-height: 39px;">
                        <div class="row m-0 p-0" style="width: 40px;height: 100%;float:left;">
                            <img src="public/img/myorder/bankcard.png" style="height: 22px;margin: auto;">
                        </div>
                        <div style="float:left;">
                            <span>银行卡</span>
                        </div>
                        <div style="float:right;width: 40px;">
                            <span class="mdi mdi-chevron-right mdi-24px" style="position: absolute;right: 3%;"></span>
                        </div>

                    </div>
                </div>
                <div class="row m-0" onclick="go_my_land()" style="height: 50px;border-top: 1px solid #F5F5F5;">
                    <div style="width: 100%;padding: 5px 5%;line-height: 39px;">
                        <div class="row m-0 p-0" style="width: 40px;height: 100%;float:left;">
                            <img src="public/img/myorder/land.png" style="height: 30px;margin: auto;">
                        </div>
                        <div style="float:left;">
                            <span>我的土地</span>
                        </div>
                        <div style="float:right;width: 40px;">
                            <span class="mdi mdi-chevron-right mdi-24px" style="position: absolute;right: 3%;"></span>
                        </div>

                    </div>
                </div>
                <div class="row m-0" onclick="go_my_address()" style="height: 50px;border-top: 1px solid #F5F5F5;">
                    <div style="width: 100%;padding: 5px 5%;line-height: 39px;">
                        <div class="row m-0 p-0" style="width: 40px;height: 100%;float:left;">
                            <img src="public/img/myorder/shipping_address.png" style="height: 30px;margin: auto;">
                        </div>
                        <div style="float:left;">
                            <span>收货地址</span>
                        </div>
                        <div style="float:right;width: 40px;">
                            <span class="mdi mdi-chevron-right mdi-24px" style="position: absolute;right: 3%;"></span>
                        </div>

                    </div>
                </div>
                <div class="row m-0" onclick="go_personal_info()" style="height: 50px;border-top: 1px solid #F5F5F5;">
                    <div style="width: 100%;padding: 5px 5%;line-height: 39px;">
                        <div class="row m-0 p-0" style="width: 40px;height: 100%;float:left;">
                            <img src="public/img/myorder/person_info.png" style="height: 26px;margin: auto;">
                        </div>
                        <div style="float:left;">
                            <span>个人信息</span>
                        </div>
                        <div style="float:right;width: 40px;">
                            <span class="mdi mdi-chevron-right mdi-24px" style="position: absolute;right: 3%;"></span>
                        </div>

                    </div>
                </div>
                <div class="row m-0" onclick="go_logout()" style="height: 50px;border-top: 1px solid #F5F5F5;border-bottom: 1px solid #F5F5F5;">
                    <div style="width: 100%;padding: 5px 5%;line-height: 39px;">
                        <div class="row m-0 p-0" style="width: 40px;height: 100%;float:left;">
                            <img src="public/img/myorder/safe_logout.png" style="height: 28px;margin: auto;">
                        </div>
                        <div style="float:left;">
                            <span>安全退出</span>
                        </div>
                        <div style="float:right;width: 40px;">
                            <span class="mdi mdi-chevron-right mdi-24px" style="position: absolute;right: 3%;"></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="footer" style="max-width: 37.5rem;width: 100%;height: 45px;position: fixed;bottom: 0;border-color: transparent;background-color: #ffffff;border-top: 3px solid #F5F5F5;">
            <div class="row m-0 p-0" style="height: 100%;">
                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;" onclick="go_home();">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/home_unselected.png" style="height: 90%;margin: 4px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #999999;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">首页</span>
                    </div>
                </div>

                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;" onclick="go_top_product();">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/product_unselected.png" style="height: 94%;margin: 4px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #999999;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">优品</span>
                    </div>
                </div>

                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;" onclick="go_task()">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/task_unselected.png" style="height: 89%;margin: 5px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #999999;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">任务</span>
                    </div>
                </div>

                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/person_selected.png" style="height: 88%;margin: 4px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #90C549;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">我的</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

</style>
<script>
    var url = '';
    function go_top_product() {
        location.href = '<?php echo base_url ('front/top_product'); ?>';
    }
    function go_home() {
        location.href = '<?php echo base_url ('front/index'); ?>';
    }
    function go_task() {
        location.href = '<?php echo base_url ('front/task'); ?>';
    }

    function go_my_products() {
        location.href = '<?php echo base_url ('member/my_products'); ?>';
    }
    function go_my_order() {
        location.href = '<?php echo base_url ('member/my_order'); ?>';
    }
    function go_apply_withdrawal() {
        location.href = '<?php echo base_url ('member/apply_withdrawal'); ?>';
    }
    function go_manage() {
        location.href = '<?php echo base_url ('member/warehouse'); ?>';
    }
    function go_bankcard_list() {
        var url = 'member';
        location.href = '<?php echo base_url ('member/bankcard_list/'); ?>' + url;
    }
    function go_my_land() {
        location.href = '<?php echo base_url ('member/my_land'); ?>';
    }
    function go_personal_info() {
        location.href = '<?php echo base_url ('member/personal_info'); ?>';
    }
    function go_my_address() {
        url = 'member';
        location.href = '<?php echo base_url ('member/my_address/'); ?>' + url;
    }
    function go_logout() {
        location.href = '<?php echo base_url ('member/logout'); ?>';
    }
</script>