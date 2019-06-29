<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;height: 100%;">
    <div class="content-wrapper" style="padding: 0;height: 100%;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span class="top_title_text">任务</span>
                </div>
            </div>
        </div>
        <div class="content-body" style="width: 100%;position: absolute;top: 45px;bottom: 0;">
            <img src="public/img/task/task_background.png" style="width: 100%;height: 100%;">
        </div>
        <div style="width: 100%;height: 40%;position: absolute;bottom: 0;min-height: 230px;">
            <div class="row m-0 p-0" style="width: 100%;height: 40%;">
                <div onclick="go_my_land()" style="width: 20%;">
                    <div style="width: 100%;padding: 15% 15% 5% 15%;text-align: center;">
                        <img src="public/img/task/real_scene_icon.png" style="width: 100%;
                                 -webkit-animation:spin 2s linear infinite;
                                 -moz-animation:spin 2s linear infinite;
                                 animation:spin 2s linear infinite;">
                    </div>
                    <div style="width: 100%;padding: 0 15% 5% 15%;text-align: center;">
                        <span class="text14_medium whiteFFF">实景</span>
                    </div>
                </div>
                <div style="width: 53%;">
                    <div style="width: 70%;height: 30px;line-height: 30px; opacity: 0.74;background: #FFFFFF;border-radius: 21px;text-align: center;
                            margin-left: auto;
                            margin-right: auto;
                            margin-top: 25%">
                        <span class="text14_medium brown8B572A"><?php echo $user['fullname'];?>农场</span>
                    </div>
                </div>
                <div style="width: 27%;">
                    <img src="public/img/task/fertilization.png" style="width: 60%;margin-top: 13%;">
                    <div style="width: 60%;text-align: center;margin-top: -30%;">
                        <p class="m-0 text12_medium brown8B572A">编号001</p>
                        <p class="m-0 text12_medium brown8B572A">已施肥</p>
                    </div>
                </div>
            </div>
            <div class="row m-0" style="width: 100%;height: 45%;padding: 4% 3%;">
                <div style="width: 100%;height: 85%;background: rgba(255,255,255, 0.7);border-radius: 8px;padding: 0 5%;">
                    <div onclick="go_publish_task()" style="width: 28%;height: 100%;float: left;">
                        <div class="row m-0" style="width: 100%;height: 80%;">
                            <img src="public/img/task/publish_task.png" style="height: 100%;margin-left: auto;margin-right: auto;">
                        </div>
                        <div class="row" style="display: table;width: 75%;height: 36%;text-align: center;margin-left: auto;margin-right: auto;">
                            <div style="display: table-cell;vertical-align: middle;background: #CB7616;border-radius: 8px;margin-left: auto;margin-right: auto;width: 80%;height: 100%;line-height: 2rem;">
                                <span class="text14_regular whiteFFF">发布任务</span>
                            </div>
                        </div>
                    </div>
                    <div onclick="go_mission_plan()" style="width: 28%;height: 100%;float: left">
                        <div class="row m-0" style="width: 100%;height: 80%;">
                            <img src="public/img/task/farm_plan.png" style="height: 100%;margin-left: auto;margin-right: auto;">
                        </div>
                        <div class="row" style="display: table;width: 75%;height: 36%;text-align: center;margin-left: auto;margin-right: auto;">
                            <div style="display: table-cell;vertical-align: middle;background: #41C7FD;border-radius: 8px;margin-left: auto;margin-right: auto;width: 80%;height: 100%;line-height: 2rem;">
                                <span class="text14_regular whiteFFF">农场计划</span>
                            </div>
                        </div>
                    </div>
                    <div onclick="go_apply_entry()" style="width: 28%;height: 100%;float: left">
                        <div class="row m-0" style="width: 100%;height: 80%;">
                            <img src="public/img/task/entering_excellent_product.png" style="height: 100%;margin-left: auto;margin-right: auto;">
                        </div>
                        <div class="row" style="display: table;width: 75%;height: 36%;text-align: center;margin-left: auto;margin-right: auto;">
                            <div style="display: table-cell;vertical-align: middle;background: #9E6BE8;border-radius: 8px;margin-left: auto;margin-right: auto;width: 80%;height: 100%;line-height: 2rem;">
                                <span class="text14_regular whiteFFF">入驻优品</span>
                            </div>
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

                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/task_selected.png" style="height: 89%;margin: 5px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #90C549;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">任务</span>
                    </div>
                </div>

                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;" onclick="go_profile()">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/person_unselected.png" style="height: 88%;margin: 4px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #999999;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">我的</span>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="land_buyer" value="<?php echo $land_buyer;?>">
    </div>
</div>
<style>
    @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
    @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
    @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
</style>
<script>
    $(document).ready(function(){
        var land_buyer = $('#land_buyer').val();
        if(land_buyer == 0)
        swal({
            title: "提示",
            text: "你必须买土地。",
            icon: "warning",
            buttons: ["取消", "确认"],

        })
            .then((willDelete) => {
                if (willDelete) {
                    location.href = '<?php echo base_url ('front/select/area'); ?>';
                } else {
                    location.href = '<?php echo base_url ('front'); ?>';
                }
            });
    });
    function go_my_land() {
        location.href = '<?php echo base_url ('member/my_land'); ?>';
    }
    function go_top_product() {
        location.href = '<?php echo base_url ('front/top_product'); ?>';
    }
    function go_home() {
        location.href = '<?php echo base_url ('front/index'); ?>';
    }
    function go_profile() {
        location.href = '<?php echo base_url ('member'); ?>';
    }
    function go_publish_task() {
        location.href = '<?php echo base_url ('front/publish_task'); ?>';
    }
    function go_mission_plan() {
        location.href = '<?php echo base_url ('front/mission_plan'); ?>';
    }
    function go_apply_entry() {
        location.href = '<?php echo base_url ('front/apply_entry'); ?>';
    }
</script>