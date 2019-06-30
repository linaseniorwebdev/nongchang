<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;">
    <div class="content-wrapper" style="padding: 0;background: white;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_task()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">申请入驻</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body" style="margin-bottom: 60px;margin-top: 45px;">
            <form id="apply_entry_form" action="<?php echo base_url('front/apply_entry')?>" method="post">
                <div style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444">负责人：</span>
                        <input type="text" class="text14_regular text_placeholder" id="principal" name="principal" value="<?php echo $apply['charger']; ?>" placeholder="请输入负责人姓名" style="width: 80%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-bottom: 6px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444">电话：</span>
                        <input type="number" class="text14_regular text_placeholder" id="telephone" name="telephone" value="<?php echo $apply['phone']; ?>" placeholder="请输入联系电话" style="width: 80%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div class="text14_regular" style="width: 100%;padding: 4%;">
                    <p style="color: #000000">入驻说明</p>
                    <span class="black444" style="line-height: 28px">这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明这是入驻说明</span>
                </div>
                <div style="width: 100%;padding: 8% 5%;background: #F7F7F7;">
                    <img onclick="check_agree()" id="agree" check="0" src="public/img/tick_empty_circle.png" style="width: 18px;height: 18px;">&nbsp;&nbsp;
                    <span onclick="check_agree()" class="text14_regular" style="color: #F5A623;">同意入驻协议</span>
                </div>
            </div>
            <div class="footer" style="max-width: 37.5rem;width: 100%;height: 60px;position: fixed;bottom: 0;border-color: transparent;background: #F7F7F7;border-top: 3px solid #F5F5F5;line-height: 54px;text-align: center;">
                <button type="button" onclick="apply_entry()" class="text16_regular whiteFFF" style="width: 90%;height: 42px;background: #90C549;border-radius: 8px;border: none;">申请入驻</button>
            </div>
        </form>
        <input type="hidden" id="return_submit" value="<?php if (isset($result)) echo $result; ?>">
        <input type="hidden" id="apply_status" value="<?php echo $apply['status']; ?>">
    </div>
    <div id="back_modal" style="display: none;width: 100%; height: 100%;background-color: grey;"></div>
</div>
<style>

</style>
<script>
    $(document).ready(function () {
        var apply_status = $('#apply_status').val();
        var return_submit = $('#return_submit').val();
        if (apply_status == '0') {
            $('#back_modal').css('display', 'block');
            swal({title: "提示",text: "正在审核中。",type: "error", confirmButtonText: "确认"})
                .then(function(e) {
                    if (e) {
                        $('#back_modal').css('display', 'none');
                        go_task();
                    }
                });
        }

    });
    function go_task() {
        location.href = '<?php echo base_url ('front/task'); ?>';
    }
    function check_agree() {
        if ($('#agree').attr('check') == 1) {
            $('#agree').attr('src', 'public/img/tick_empty_circle.png');
            $('#agree').attr('check', 0);
        }
        else{
            $('#agree').attr('src', 'public/img/check.png');
            $('#agree').attr('check', 1);
        }
    }
    function apply_entry() {
        var principal = $('#principal').val();
        var telephone = $('#telephone').val();
        var agree = $('#agree').attr('check');
        if (principal.length < 1) {
            swal({title: "警告",text: "请输入负责人姓名。",type: "error", confirmButtonText: "确认"});
            return;
        }
        if (telephone.length < 1){
            swal({title: "警告",text: "请输入联系电话。",type: "error", confirmButtonText: "确认"});
            return;
        }
        if (agree == '0'){
            swal({title: "警告",text: "你必须同意达成协议。",type: "error", confirmButtonText: "确认"});
            return;
        }

        $('#apply_entry_form').submit();


    }

</script>