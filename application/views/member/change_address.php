<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_my_address('<?php echo $url;?>')" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">修改地址</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;overflow-y: scroll;">
            <div style="width: 100%;padding: 0 4%;border-top: 3px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black222" style="width: 25%;">收货人</span>
                    <input type="text" class="text14_regular" value="<?php echo $self['receipt'] ?>" readonly style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black222" style="width: 25%;">手机号</span>
                    <input type="text" class="text14_regular" id="phone" readonly
                           value="<?php
                                    echo substr($self['phone'], 0, 3);
                                    echo "****";
                                    echo substr($self['phone'], 7);
                                    ?>"
                           style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                </div>
            </div>
            <form id="change_address_form" action="<?php echo base_url ('member/change_address/'.$self['id']); ?>" method="post">
                <input id="url" name="url" type="hidden" value="<?php echo $url; ?>">
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
                                            if ($province['id'] == $self['province']) echo '<option selected value="' . $province['id'] . '">' . $province['name'] . '</option>';
                                            else echo '<option value="' . $province['id'] . '">' . $province['name'] . '</option>';
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
                                    <option>省市地区</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 100%;height: 120px;padding: 4%;background: white;">
                    <p class="text15_regular black222 m-0" style="width: 25%;float: left;line-height: 18px">详细地址</p>
                    <textarea id="detail" name="detail" class="text14_regular black444 text_placeholder" placeholder="请输入详细地址（5-120个字)" minlength="5" maxlength="120" style="width: 75%;height: 80%;border: none;outline: 0;resize: none;"><?php echo $self['detail'] ?></textarea>
                </div>
                <div class="mt-1" style="width: 100%;padding: 0 4%;background: white;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black222">设置默认地址</span>
                        <div class="form-group" style="position: absolute;right: 5%;">
                            <?php if ($self['status'] == 1){ ?>
                                <input type="checkbox" checked id="switchery" class="switchery"  data-switchery="true" style="display: none;">
                                <input id="status" name="status" type="hidden" value="1">
                            <?php } else{ ?>
                                <input type="checkbox" id="switchery" class="switchery"  data-switchery="false" style="display: none;">
                                <input id="status" name="status" type="hidden" value="0">
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mt-2 mb-2 pl-2 pr-2">
                    <button id="change_form_submit" type="button" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
        border-radius: 8px;height: 45px;">修改</button>
                </div>
            </form>

            <div class="col-sm-12 mt-2 mb-2 pl-2 pr-2">
                <button type="button" onclick="delete_address('<?php echo $self['id'] ?>')" class="btn mb-1" style="width: 100%;color: white;background: #F5A623;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
        border-radius: 8px;height: 45px;">删除</button>
            </div>
        </div>

    </div>
</div>
<style>

</style>
<script>
    $(document).ready(function() {
        //////////   cities by selected province  //////////
        $("#city").html('');
        $.post("<?php echo base_url('api/city/list'); ?>", {province: <?php echo $self['province'] ?>}, function(data) {
            data = JSON.parse(data);
            $.each(data.cities, function (i, v) {
                var buffer = '';
                if (v.id == <?php echo $self['city'] ?>) buffer = '<option selected value="' + v.id + '">' + v.name + '</option>';
                else buffer = '<option value="' + v.id + '">' + v.name + '</option>';
                $("#city").append(buffer);
            });
        });

        ////////////  districts by selected citie  ////////////////
        $("#district").html('');
        $.post("<?php echo base_url('api/district/list'); ?>", {city: <?php echo $self['city'] ?>}, function(data) {
            data = JSON.parse(data);
            $.each(data.districts, function (i, v) {
                var buffer = '';
                if (v.id == <?php echo $self['district'] ?>) buffer = '<option selected value="' + v.id + '">' + v.name + '</option>';
                else buffer = '<option value="' + v.id + '">' + v.name + '</option>';
                $("#district").append(buffer);
            });
        });
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

    $('#change_form_submit').click(function () {

        var detail = $('#detail').val();
        if(detail.length < 1) {
            swal("警告", "请输入详细地址。", "warning");
        }
        else{
            $('#change_address_form').submit();
        }
    });
    function delete_address(address_id) {
        swal({
            title: "警告",
            text: "你确定删除吗？",
            icon: "warning",

            buttons: ["取消", "确认"],

        })
        .then((willDelete) => {
            if (willDelete) {
                $.post("<?php echo base_url('member/delete_address') ?>", {id: address_id},
                    function (data) {
                        var result = JSON.parse(data);
                        console.log(result);
                        if (result.status == "success") {
                            go_my_address('<?php echo $url;?>');
                        } else {
                            swal({
                                title: "错误",
                                text: "出了点问题。 请稍后再试。",
                                type: "error",
                                confirmButtonText: "确认"
                            }).then(function(e) {
                                location.reload();
                            });
                        }

                    }
                );

            } else {
                // swal("Your imaginary file is safe!");
            }
        });
    }
    function go_my_address(url) {
        location.href = '<?php echo base_url ('member/my_address/'); ?>' + url;
    }
</script>