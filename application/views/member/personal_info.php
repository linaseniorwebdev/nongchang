<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_profile()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">个人信息</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;">
            <input type="hidden" id="user_id" value="<?php echo $user['id']; ?>">
            <div style="width: 100%;height: 150px;text-align: center;padding: 30px">
                <?php if($user['photo']){ ?>
                    <div id="avatar" style="width: 90px;height: 90px;border-radius:50%;margin-left: auto;margin-right: auto; background-image: url('../<?php echo $user['photo']; ?>');background-size: 100% 100%;">
                        <input type="file" accept="image/*" id="select_avatar" name="photo" onchange="avatar_upload(this)" style="width: 90px;height: 90px;border-radius: 45px;cursor: pointer;opacity: 0;">
                    </div>
                <?php }
                else{ ?>
                    <div id="avatar" style="width: 90px;height: 90px;border-radius:50%;margin-left: auto;margin-right: auto; background-image: url('../uploads/avatars/default.png');background-size: 100% 100%;">
                        <input type="file" accept="image/*" id="select_avatar" name="photo" onchange="avatar_upload(this)" style="width: 90px;height: 90px;border-radius: 45px;cursor: pointer;opacity: 0;">
                    </div>
                <?php } ?>
            </div>

            <div style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black444" style="width: 25%;">姓名</span>
                    <input type="text" class="text14_regular text_placeholder" name="fullname" id="fullname" value="<?php echo $user['fullname']; ?>" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    <input type="hidden" id="original_name" value="<?php echo $user['fullname']; ?>">
                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;border-bottom: 2px solid #F7F7F7;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black444" style="width: 25%;">手机号码</span>
                    <input type="text" class="text14_regular text_placeholder" name="phone" id="phone" value="<?php echo $user['phone']; ?>" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    <input type="hidden" id="original_phone" value="<?php echo $user['phone']; ?>">
                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;background: white;">
                <div id="sms_field" class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;display: none;">
                    <span class="black444" style="width: 25%;">验证码</span>
                    <input type="text" class="text14_regular text_placeholder" id="sms" placeholder="获取验证码" style="width: 50%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    <button type="button" id="request_sms_btn" onclick="request_sms()" class="btn" style="width: 25%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
    border-radius: 8px;height: 37px;margin-top: auto;margin-bottom: auto;">验证码</button>
                </div>
            </div>

            <div class="col-sm-12 mt-4 mb-2 pl-2 pr-2">
                <button type="button" onclick="go_modify_info()" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
    border-radius: 8px;height: 45px;">修改信息</button>
            </div>
        </div>

            <!--   crop photo     //////-->
        <div id="crop_div" style="display: none;max-width: 37.5rem;width: 100%;height: 270px;position: fixed;margin-top: 48px; background-color: #cccccc;text-align: center;">
            <img id="orign_img" src="" style="width: 100%;height: 80%;background-size: 100% 100%;background-position: center;">
            <button onclick="confirm_crop_img()" class="btn btn-info" style="margin-top: 10%">确认</button>
        </div>
    </div>
</div>
<style>

</style>
<script>

    var dataURL = '';
    function avatar_upload(input) {
        $('#crop_div').css('display', 'block');
        $('#orign_img').cropper("destroy");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // $('#orign_img').css("background-image", 'url(' + e.target.result + ')');
                // $('#orign_img').attr('src', e.target.result);
                $('#orign_img').prop('src', e.target.result);
                $("#orign_img").cropper({
                    viewMode: 10/8,
                    aspectRatio: 1
                });
            };
            reader.readAsDataURL(input.files[0]);

        }
    }
    function confirm_crop_img() {
        var cropper = $("#orign_img").data('cropper');
        var imageCanvas = cropper.getCroppedCanvas();
        dataURL = imageCanvas.toDataURL();
        $('#avatar').css("background-image", 'url(' + dataURL + ')');
        $('#crop_div').css('display', 'none');
    }
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
                        alert("error!");
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

    function go_modify_info() {
        var user_id = $('#user_id').val();
        var fullname = $('#fullname').val();
        var phone = $('#phone').val();
        var original_phone = $('#original_phone').val();
        var original_name = $('#original_name').val()
        var sms = $('#sms').val();
        if (fullname == original_name && phone == original_phone && dataURL == ''){
            location.href = '<?php echo base_url ('member'); ?>';
        }
        if (fullname.length < 1){
            swal("警告", "请输入姓名。", "warning");
            return;
        }
        if (phone.length < 1){
            swal("警告", "请输入手机号。", "warning");
            return;
        }

        if (phone != original_phone) {
            if (sms.length < 1) {
                swal({
                    title: "警告",
                    text: "如果您想更改手机号码，则必须获取验证码。",
                    icon: "warning",
                    buttons: ["取消", "确认"],
                }).then(function(e) {
                    if (e) {
                        $('#sms_field').css('display', 'block');
                    }
                    else{
                        $('#sms_field').css('display', 'none');
                        $('#phone').val(original_phone);

                    }
                });
                return;
            }

        }

        var formData = new FormData();
        formData.append("picture", dataURL);
        formData.append("fullname", fullname);
        formData.append("phone", phone);
        formData.append("sms", sms);
        formData.append("id", user_id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('api/upload/user') ?>",
            // xhr: function () {
            //     var myXhr = $.ajaxSettings.xhr();
            //     if (myXhr.upload) {
            //         myXhr.upload.addEventListener('progress', that.progressHandling, false);
            //     }
            //     return myXhr;
            // },
            success: function (data) {

                data = JSON.parse(data);
                if (data.status == "success") {
                    $('#sms').val('');
                    location.reload();
                } else {
                    if (data.sms == 'wrong') swal({title: "警告",text: "验证码错误。",type: "error", confirmButtonText: "确认"});
                    else if (data.phone == 'exist') swal({title: "警告",text: "手机号码已经存在，请输入另一个手机号码。",type: "error", confirmButtonText: "确认"});
                    else swal({title: "错误",text: "出了点问题。 请稍后再试。",type: "error", confirmButtonText: "确认"});
                }
            },
            error: function (error) {
                console.log('error');
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });

    }
    function go_profile() {
        location.href = '<?php echo base_url ('member'); ?>';
    }
</script>