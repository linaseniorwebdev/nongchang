<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_bankcard_list('<?php echo $url; ?>')" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">绑定银行卡</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;">
            <div style="width: 100%;height: 30px;text-align: center;background: #F1EDB0;line-height: 30px;">
                <span class="text14_regular redFA5359">温馨提示：请绑定本人的银行卡信息</span>
            </div>
            <form action="<?php echo base_url ('member/bankcard') ?>" method="post" style="width: 100%;">
                <input type="hidden" name="url" value="<?php echo $url; ?>">
                <div style="width: 100%;padding: 0 4%;border-top: 6px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">持卡人</span>
                        <input type="text" class="text14_regular text_placeholder" id="cardholder" name="cardholder" placeholder="请输入真实姓名" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">身份证号码</span>
                        <input type="number" class="text14_regular text_placeholder" id="identification" name="identification" placeholder="请输入真实身份证号码" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>

                <div class="mt-1" style="width: 100%;padding: 0 4%;background: white;border-bottom: 2px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">开户行</span>
                        <input type="text" class="text14_regular text_placeholder" id="bank" name="bank" placeholder="请输入开户行" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">银行卡号</span>
                        <input type="text" class="text14_regular text_placeholder" id="card_number" name="card_number" placeholder="请输入本人真实银行卡号" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>

                <div class="mt-1" style="width: 100%;padding: 0 4%;border-bottom: 2px solid #F7F7F7;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">手机号</span>
                        <input type="text" class="text14_regular text_placeholder" id="phone" name="phone" placeholder="请输入手机号" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">验证码</span>
                        <input type="text" class="text14_regular text_placeholder" id="sms" name="sms" placeholder="获取验证码" style="width: 50%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                        <button type="button" onclick="request_sms()" id="request_sms_btn" class="btn" style="width: 25%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
        border-radius: 8px;height: 37px;margin-top: auto;margin-bottom: auto;">验证码</button>
                    </div>
                </div>
                <div class="mt-1" style="width: 100%;padding: 0 4%;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black222">设置默认银行卡</span>
                        <div class="form-group" style="position: absolute;right: 5%;">
                            <input type="checkbox" checked id="switchery" class="switchery"  data-switchery="true" style="display: none;">
                            <input id="status" name="status" type="hidden" value="1">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 mt-4 mb-2 pl-2 pr-2">
                    <button type="button" onclick="add_bankcard()" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
        border-radius: 8px;height: 45px;">完成</button>
                </div>
            </form>
        </div>
    <input type="hidden" id="result_bank" value="<?php if (isset($message)) echo $message; ?>">
    </div>
</div>
<style>

</style>
<script>
    $(document).ready(function() {

        var result = $('#result_bank').val();
        if (result.length > 0 || result != '') {
            if (result == 'ok') swal('成功！', '', 'success');
            else if(result == 'wrong') swal('警告', '验证码错误。', 'warning');
            else if (result == 'expired') swal('警告', '验证码过期。', 'warning');
            else swal('警告', '没有手机号码。', 'warning');
        }
    });

    (function(window, document, $) {
        // Switchery
        var i = 0;
        if (Array.prototype.forEach) {

            var elems = $('.switchery');
            $.each( elems, function( key, value ) {
                var $size="", $color="",$sizeClass="", $colorCode="";
                $size = $(this).data('size');
                var $sizes ={
                    'lg' : "large",
                    'sm' : "small",
                    'xs' : "xsmall"
                };
                if($(this).data('size')!== undefined){
                    $sizeClass = "switchery switchery-"+$sizes[$size];
                }
                else{
                    $sizeClass = "switchery";
                }

                $color = $(this).data('color');
                var $colors ={
                    'primary' : "#967ADC",
                    'success' : "#37BC9B",
                    'danger' : "#DA4453",
                    'warning' : "#F6BB42",
                    'info' : "#3BAFDA"
                };
                if($color !== undefined){
                    $colorCode = $colors[$color];
                }
                else{
                    $colorCode = "#90C549";
                }

                var switchery = new Switchery($(this)[0], { className: $sizeClass, color: $colorCode, secondaryColor: '#9c9898' });
            });
        } else {
            var elems1 = document.querySelectorAll('.switchery');

            for (i = 0; i < elems1.length; i++) {
                var $size = elems1[i].data('size');
                var $color = elems1[i].data('color');
                var switchery = new Switchery(elems1[i], { color: '#90C549;', secondaryColor: '#9c9898' });
            }
        }
        /*  Toggle Ends   */

    })(window, document, jQuery);

    $('.switchery').click(function () {
        if($('#status').val() == 0) $('#status').val(1);
        else $('#status').val(0);
    });
    var phone = '';

    function request_sms() {
        phone = $('#phone').val();
        if (phone.length < 1){
            swal("Warning", "请输入手机号码。", "warning");
        }
        else{
            $.post("<?php echo base_url('member/textme') ?>", {phone: phone},
                function (data) {
                    var result = JSON.parse(data);
                    if (result.status == "success") {
                        time();
                    } else {

                    }
                }
            );
        }

    }
    var wait=60;
    function time() {
        if (wait == 0) {
            $("#request_sms_btn").removeAttr("disabled");
            $("#request_sms_btn").html("验证码");
            wait = 60;
        } else {
            $("#request_sms_btn").attr("disabled", 'disabled');
            $("#request_sms_btn").html(wait+"s");
            wait--;
            setTimeout(function() {
                    time()
                },
                1000)
        }
    }
    function add_bankcard() {
        var cardholder = $("#cardholder").val();
        var identification = $("#identification").val();
        var bank = $("#bank").val();
        var card_number = $("#card_number").val();
        var phone = $("#phone").val();
        var sms = $("#sms").val();
        if(cardholder.length < 1){
            swal("警告", "请输入持卡人", "warning");
        }
        else if (phone.length < 1) {
            swal("警告", "请输入手机号码。", "warning");
        }
        else if(sms.length < 1){
            swal("警告", "请输入验证码", "warning");
        }
        else if(identification.length < 1){
            swal("警告", "请输入身份证号码。", "warning");
        }
        else if(bank.length < 1){
            swal("警告", "请输入开户行。", "warning");
        }
        else if(card_number.length < 1){
            swal("警告", "请输入银行卡号。", "warning");
        }
        else{
            $('form').submit();
        }
    }
    function go_bankcard_list(url) {
        location.href = '<?php echo base_url ('member/bankcard_list/'); ?>'+ url;
    }
</script>