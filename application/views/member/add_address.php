<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_my_address('<?php echo $url;?>')" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">新增地址</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;overflow-y: scroll;">
            <form id="add_address_form" action="<?php echo base_url ('member/add_address') ?>" method="post">
                <input id="url" name="url" type="hidden" value="<?php echo $url; ?>">
            <div style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black222" style="width: 25%;">收货人</span>
                    <input type="text" class="text14_regular text_placeholder" id="receipt" name="receipt" placeholder="请输入收货人姓名" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black222" style="width: 25%;">手机号</span>
                    <input type="number" class="text14_regular text_placeholder" id="phone" name="phone" placeholder="请输入手机号" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                </div>
            </div>

            <div class="mt-1" style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black222">点击选择省市地区</span>
                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;background: white;border-bottom: 2px solid #F7F7F7;">
                <div class="row m-0 p-0 " style="height: 70px;">
                    <div style="width: 33.333%;">
                        <div style="width: 100%;height: 30px;line-height: 30px;text-align: center;">
                            <span class="text15_regular black444">省</span>
                        </div>
                        <div style="width: 100%;height: 40px;text-align: center;">
                            <select name="province" id="province" class="form-control" style="width: 90%;height: 30px;vertical-align: middle;margin-left: auto;margin-right: auto;">
                                <?php
                                $reversed = array_reverse($provinces);
                                foreach ($reversed as $province) {
                                    if ($province['code'])
                                        echo '<option value="' . $province['id'] . '">' . $province['name'] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div style="width: 33.333%;">
                        <div style="width: 100%;height: 30px;line-height: 30px;text-align: center;">
                            <span class="text15_regular black444">市</span>
                        </div>
                        <div style="width: 100%;height: 40px;text-align: center;">
                            <select name="city" id="city" class="form-control" style="width: 90%;height: 30px;vertical-align: middle;margin-left: auto;margin-right: auto;">
                            </select>
                        </div>
                    </div>
                    <div style="width: 33.333%;">
                        <div style="width: 100%;height: 30px;line-height: 30px;text-align: center;">
                            <span class="text15_regular black444">区</span>
                        </div>
                        <div style="width: 100%;height: 40px;text-align: center;">
                            <select name="district" id="district" class="form-control" style="width: 90%;height: 30px;vertical-align: middle;margin-left: auto;margin-right: auto;">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 100%;height: 120px;padding: 4%;background: white;">
                <p class="text15_regular black222">详细地址</p>
                <textarea id="detail" name="detail" class="text_placeholder" placeholder="请输入详细地址（5-120个字)" minlength="5" maxlength="120" style="width: 100%;height: 80%;border: none;outline: 0;resize: none;"></textarea>
            </div>
            <div class="mt-1" style="width: 100%;padding: 0 4%;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black222">设置默认地址</span>
                    <div class="form-group" style="position: absolute;right: 5%;">
                        <input type="checkbox" id="switchery" checked class="switchery"  data-switchery="true" style="display: none;">
                        <input id="status" name="status" type="hidden" value="1">
                    </div>
                </div>
            </div>

            <div class="col-sm-12 mt-4 mb-2 pl-2 pr-2">
                <button id="form_submit" type="button" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
    border-radius: 8px;height: 45px;">完成</button>
            </div>
            </form>
        </div>
        <input id="result" type="hidden" value="<?php if (isset($message)) echo $message; ?>">
    </div>
</div>
<style>

</style>
<script>
        $(document).ready(function() {


            var result = $('#result').val();
            if (result.length > 0 || result != '') {
                if (result == 'success') swal('成功！', '', 'success');
                else swal('警告', '请再试一次。', 'warning');
            }

            //////////   Beijing cities  //////////
            $("#city").html('');
            $.post("<?php echo base_url('api/city/list'); ?>", {province: 1}, function(data) {
                data = JSON.parse(data);
                $.each(data.cities, function (i, v) {
                    var buffer = '<option value="' + v.id + '">' + v.name + '</option>';
                    $("#city").append(buffer);
                });
            });

            ////////////  Bejing Dongcheng districts    ////////////////
            $("#district").html('');
            $.post("<?php echo base_url('api/district/list'); ?>", {city: 1}, function(data) {
                data = JSON.parse(data);
                $.each(data.districts, function (i, v) {
                    var buffer = '<option value="' + v.id + '">' + v.name + '</option>';
                    $("#district").append(buffer);
                });
            });
        } );
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
    /////////////////    load cities by selected province     //////////////
    $("#province").change(function() {
        $("#city").html('');
        var selectedVal = this.value;
        $.post("<?php echo base_url('api/city/list'); ?>", {province: selectedVal}, function(data) {
            data = JSON.parse(data);
            $.each(data.cities, function (i, v) {
                var buffer = '<option value="' + v.id + '">' + v.name + '</option>';
                $("#city").append(buffer);
                $("#district").html('');
                $.post("<?php echo base_url('api/district/list'); ?>", {city: data.cities[0]['id']}, function(data) {
                    data = JSON.parse(data);
                    $.each(data.districts, function (i, v) {
                        var buffer = '<option value="' + v.id + '">' + v.name + '</option>';
                        $("#district").append(buffer);
                    });
                });
            });
        });
    });
    /////////////////    load districts by selected city     //////////////
    $("#city").change(function() {
        $("#district").html('');
        var selectedVal = this.value;
        $.post("<?php echo base_url('api/district/list'); ?>", {city: selectedVal}, function(data) {
            data = JSON.parse(data);
            $.each(data.districts, function (i, v) {
                var buffer = '<option value="' + v.id + '">' + v.name + '</option>';
                $("#district").append(buffer);
            });
        });
    });
    
    $('#form_submit').click(function () {
        var receipt = $('#receipt').val();
        var phone = $('#phone').val();
        // var province = $('#province').val();
        // var city = $('#city').val();
        // var district = $('#district').val();
        var detail = $('#detail').val();
        if (receipt.length < 1) {
            swal("警告", "请输入收货人名字。", "warning");
        }
        else if(phone.length < 1) {
            swal("警告", "请输入手机号。", "warning");
        }
        else if(detail.length < 1) {
            swal("警告", "请输入详细地址。", "warning");
        }
        else{
            $('#add_address_form').submit();
        }
    });
    function go_my_address(url) {
        location.href = '<?php echo base_url ('member/my_address/'); ?>'+url;
    }
</script>