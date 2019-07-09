<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_login()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">更改密码</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;">
            <form id="change_form" action="<?php echo base_url('member/change_password')?>" method="post">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['id']; ?>">
                <div style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">用户名</span>
                        <input type="text" class="text14_regular text_placeholder" name="username" id="username" readonly value="<?php echo $user['username']; ?>" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">新密码</span>
                        <input type="password" class="text14_regular text_placeholder" name="password" id="password" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">重复密码</span>
                        <input type="password" class="text14_regular text_placeholder" name="confirm" id="confirm" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-bottom: 2px solid #F7F7F7;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">手机号码</span>
                        <input type="text" class="text14_regular text_placeholder" name="phone" id="phone" readonly value="<?php echo substr($user['phone'],0,3);echo "....";echo substr($user['phone'],7,11); ?>" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;background: white;">
                    <div id="sms_field" class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">验证码</span>
                        <input type="text" class="text14_regular text_placeholder" id="sms" name="sms" placeholder="获取验证码" style="width: 50%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                        <button type="button" id="request_sms_btn" onclick="request_sms()" class="btn" style="width: 25%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
        border-radius: 8px;height: 37px;margin-top: auto;margin-bottom: auto;">验证码</button>
                    </div>
                </div>

                <div class="col-sm-12 mt-4 mb-2 pl-2 pr-2">
                    <button type="button" onclick="go_change()" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
        border-radius: 8px;height: 45px;">更改密码</button>
                </div>
            </form>
        </div>


    </div>
</div>
<style>

</style>
<script>

    function request_sms() {
        var phone = $('#phone').val();
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
                        swal("Warning", "服务器错误。", "warning");
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

    function go_change() {
        var password = $('#password').val();
        var confirm = $('#confirm').val();
        var sms = $('#sms').val();

        if (password.length < 1){
            swal("警告", "请输入新密码。", "warning");
            return;
        }
        if (confirm.length < 1){
            swal("警告", "请输入重复密码。", "warning");
            return;
        }
        if (password != confirm) {
            swal("警告", "密码不匹配。", "warning");
            return;
        }
        if(sms.length < 1){
            swal("警告", "请输入验证码", "warning");
            return;
        }
        $('#change_form').submit();

    }
    function go_login() {
        location.href = '<?php echo base_url ('member/login'); ?>';
    }
</script>