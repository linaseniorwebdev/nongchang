<div id="login_scene" class="app-content content" style="max-width: 37.5rem;height: 100%;margin-left: auto;margin-right: auto;">
    <div class="content-wrapper hide_scrollbar" style="padding: 0;height: 100%;overflow-y: scroll;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;background-color: #f8f8f8;max-width: 37.5rem;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_login()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;">注册</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 40%;">
            <div class="row m-0 p-1" style="text-align: center;">
                <form action="<?php echo base_url ('member/signup') ?>" method="post" style="width: 100%;">
                    <div class="col-sm-12 m-0 pl-2 pr-2">
                        <input type="text" class="mb-1 pl-1" id="username" name="username" value="<?php if (isset($user_name)) echo $user_name; ?>" placeholder="请输入您的用户名" style="width: 90%;height: 40px;background-color: white;border: none;border-radius: 8px;">
                    </div>
                    <div class="col-sm-12 m-0 pl-2 pr-2">
                        <input type="number" class="mb-1 pl-1" id="phone" name="phone" value="<?php if (isset($phone_number)) echo $phone_number;?>" placeholder="请输入您的手机号码" style="width: 90%;height: 40px;background-color: white;border: none;border-radius: 8px;">
                    </div>
                    <div class="col-sm-12 m-0 pl-2 pr-2">
                        <input type="text" value="" class="mb-1 pl-1" id="sms" name="sms" placeholder="请输入获取验证码" style="width: 55%;height: 40px;background-color: white;border: none;border-radius: 8px;vertical-align: middle;">
                        <button id="request_sms_btn" type="button" onclick="request_sms()" class="btn mb-1" style="width: 30%;color: white;background: #90C549;border-radius: 8px;margin-left: 4%;">验证码</button>
                    </div>
                    <div class="col-sm-12 m-0 pl-2 pr-2">
                        <input type="password" class="mb-1 pl-1" id="password" name="password" placeholder="请设置您的密码" style="width: 90%;height: 40px;background-color: white;border: none;border-radius: 8px;">
                    </div>
                    <div class="col-sm-12 mb-2 pl-2 pr-2">
                        <input type="password" class="mb-1 pl-1" id="confirm-password" placeholder="重复密码" style="width: 90%;height: 40px;background-color: white;border: none;border-radius: 8px;">
                    </div>
                    <div class="col-sm-12 mb-2 pl-2 pr-2">
                        <button type="button" onclick="signup()" class="btn mb-1" style="width: 95%;color: white;background: #F5A623;box-shadow: 1px 2px 4px 0 rgba(245,166,35,0.58);
    border-radius: 8px;">注册</button>
                    </div>
                </form>
            </div>
        </div>
        <input type="hidden" id="return_name" value="<?php if (isset($username)) echo $username; ?>">
        <input type="hidden" id="return_phone" value="<?php if (isset($phone)) echo $phone; ?>">
        <input type="hidden" id="return_sms" value="<?php if (isset($sms)) echo $sms; ?>">
    </div>
</div>
    <style>
        @media screen and (max-width: 567px)  {
            .login_header_img{
                height: 144px;
            }
        }
    </style>
    <script>
        // $(".toggle-password").click(function() {
        //     $("#eye-icon").toggleClass("mdi-eye mdi-eye-off");
        //     var input = $($("#eye-icon").attr("toggle"));
        //     if (input.attr("type") == "password") {
        //         input.attr("type", "text");
        //     } else {
        //         input.attr("type", "password");
        //     }
        // });

        $(document).ready(function(){
            if($('#return_name').val() == 'exist')
                swal("警告", "用户名已经存在，请输入其他用户名。", "warning");

            else if($('#return_phone').val() == 'exist')
                swal("警告", "手机号码已经存在，请输入另一个手机号码。", "warning");

            else if($('#return_sms').val() == 'wrong')
                swal("警告", "错误验证码。", "warning");

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

        function signup() {
            var alnum = /^[a-z0-9]+$/i;
            var username = $("#username").val();
            var hasSpace = $('#username').val().indexOf(' ')>=0;
            var sms = $("#sms").val();
            var password = $("#password").val();
            var confirm = $("#confirm-password").val();
            phone = $('#phone').val();
            if(username.length < 1){
                swal("警告", "请输入用户名", "warning");
                return;
            }
            if (hasSpace){
                swal("警告", "不能在用户名中使用空格", "warning");
                return;
            }
            if (phone.length < 1) {
                swal("警告", "请输入手机号码。", "warning");
                return;
            }
            if(sms.length < 1){
                swal("警告", "请输入验证码", "warning");
                return;
            }
            if(password.length < 1){
                swal("警告", "请输入密码。", "warning");
                return;
            }
            if(confirm.length < 1){
                swal("警告", "请输入重复密码。", "warning");
                return;
            }
            if(password != confirm){
                swal("警告", "密码不匹配。", "warning");
                return;
            }

            $('form').submit();

        }
        
        function go_login() {
            location.href = "<?php echo base_url('member/login'); ?>";
        }

    </script>