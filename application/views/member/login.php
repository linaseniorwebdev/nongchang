<div id="login_scene" class="app-content content" style="max-width: 37.5rem;height: 100%;margin-left: auto;margin-right: auto;">
    <div class="content-wrapper hide_scrollbar" style="padding: 0;height: 100%;overflow-y: scroll;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;background-color: #f8f8f8;max-width: 37.5rem;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span>登录</span>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 40%;">
            <div class="row m-0 p-1" style="text-align: center;">
                <form action="<?php echo base_url('member/login'); ?>" method="post" style="width: 100%;">
                    <div class="col-sm-12 m-0 pl-2 pr-2">
                        <img src="public/img/login/user.png" style="vertical-align: middle;height: 30px;">
                        <input type="text" class="mb-1 ml-1 pl-1" value="<?php if (isset($username)) echo $username; ?>" id="username" name="username" placeholder="用户名/邮箱/手机号" autocomplete="off" style="width: 78%;height: 40px;background-color: white;border: none;border-radius: 8px;">
                    </div>
                    <div class="col-sm-12 m-0 pl-2 pr-2">
                        <img src="public/img/login/password.png" style="vertical-align: middle;height: 30px;">


                        <input type="password" class="mb-1 ml-1 pl-1" value="<?php if (isset($password)) echo $password; ?>" id="password-field" name="password" placeholder="登录密码" style="width: 78%;height: 40px;background-color: white;border: none;border-radius: 8px;">
                        <div class="toggle-password field-icon">
                            <span id="eye-icon" toggle="#password-field" class="mdi mdi-eye" style="font-size: 25px"></span>
                        </div>


                    </div>
                    <div class="col-sm-12 mb-2 pl-3 pr-3">
                        <p onclick="go_change_password()" class="mt-1 mr-0 mb-2 text15_regular black444" style="float: right;margin-left: auto;cursor: pointer;">忘记密码?</p>
                    </div>
                    <div class="col-sm-12 mb-2 pl-2 pr-2">
                        <button type="button" onclick="go_login()" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
    border-radius: 8px;height: 45px;">登录</button>
                    </div>
                    <div class="col-sm-12 mb-2 pl-2 pr-2">
                        <button type="button" onclick="go_signup()" class="btn mb-1" style="width: 100%;color: white;background: #F5A623;box-shadow: 1px 2px 4px 0 rgba(245,166,35,0.58);
    border-radius: 8px;height: 45px;">注册</button>
                    </div>
                </form>
            </div>
        </div>
        <input type="hidden" id="reason" value="<?php if (isset($reason)) echo $reason; ?>">
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
        $(document).ready(function(){
           var reason = $("#reason").val();
            console.log(reason);
           if (reason == 'nonexist') {
               swal("警告", "此用户不存在。", "warning");
           }
           else if (reason == 'password') {
               swal("警告", "密码错误。", "warning");
           }

        });
        $(".toggle-password").click(function() {
            $("#eye-icon").toggleClass("mdi-eye mdi-eye-off");
            var input = $($("#eye-icon").attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        function go_login() {
            var username = $("#username").val();
            var password = $("#password-field").val();
            if(username.length < 1){
                swal("警告", "请输入用户名。", "warning");
                return;
            }
            if(password.length < 1){
                swal("警告", "请输入密码。", "warning");
                return;
            }

            $('form').submit();

        }
        function go_signup() {
            location.href = "<?php echo base_url('member/signup'); ?>";
        }
        function go_change_password() {
            var username = $("#username").val();
            if(username.length < 1){
                swal("警告", "请输入用户名。", "warning");
                return;
            }
            $.post("<?php echo base_url('member/check_user') ?>", {username: username},
                function (data) {
                    var result = JSON.parse(data);
                    if (result.status == "success") {
                        location.href = "<?php echo base_url('member/change_password/'); ?>" + result.id;
                    } else {
                        swal("警告", "此用户不存在。", "warning");
                    }
                }
            );
        }
    </script>