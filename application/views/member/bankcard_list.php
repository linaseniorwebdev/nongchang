<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_profile('<?php echo $url; ?>')" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">绑定银行卡</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;">
            <?php foreach ($data as $key => $row){  ?>
            <div style="width: 100%;padding: 0 4%;border-top: 10px solid #F7F7F7;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black444" style="width: 25%;">持卡人</span>
                    <input type="text" class="text14_regular text_placeholder" id="cardholder" readonly value="<?php echo $row['holder']; ?>" style="width: 50%;border: none;height: 50px;padding: 5px 10px;outline: 0;">

                    <?php if ($row['last_used'] == 1){ ?>
                        <div style="text-align: center;position: absolute;right: 5%;width: 45px;height: 25px;line-height: 25px;border: 1px solid #F74832;border-radius: 5px;margin-top: 10px;">
                            <span class="text14_regular redF74832">默认</span>
                        </div>
                    <?php }  ?>

                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black444" style="width: 25%;">身份证号码</span>
                    <input type="text" class="text14_regular text_placeholder" id="card_number" readonly value="<?php echo $row['identity']; ?>" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                </div>
            </div>

            <div style="width: 100%;padding: 0 4%;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black444" style="width: 25%;">开户行</span>
                    <input type="text" class="text14_regular text_placeholder" id="bank" readonly value="<?php echo $row['bank']; ?>" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                </div>
            </div>
            <div style="width: 100%;padding: 0 4%;background: white;">
                <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                    <span class="black444" style="width: 25%;">银行卡号</span>
                    <input type="text" class="text14_regular text_placeholder" id="bank_number" readonly value="<?php echo $row['number']; ?>" style="width: 55%;border: none;height: 50px;padding: 5px 10px;outline: 0;">

                    <div onclick="go_change_bankcard(<?php echo $row['id']; ?>, '<?php echo $url; ?>')" style="text-align: center;width: 55px;height: 30px;line-height: 30px; background: #90C549;border-radius: 6px;margin-top: 5px;cursor: pointer;position: absolute;right: 4%;">
                        <span class="text14_medium whiteFFF" style="font-size: 13px;">修改</span>
                    </div>

                </div>
            </div>
            <?php } ?>
            <div class="col-sm-12 mt-4 mb-2 pl-2 pr-2">
                <button type="button" onclick="go_add_bankcard('<?php echo $url; ?>')" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
    border-radius: 8px;height: 45px;">新增银行卡</button>
            </div>
        </div>

    </div>
</div>
<style>

</style>
<script>
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

    function go_add_bankcard(url) {
        location.href = '<?php echo base_url ('member/bankcard/'); ?>'+ url;
    }
    function go_change_bankcard(id, url) {
        location.href = "<?php echo base_url ('member/change_bankcard/'); ?>"+ id + '/' + url;
    }
    function go_profile(url) {
        if (url == 'member') location.href = '<?php echo base_url ('member'); ?>';
        else  location.href = '<?php echo base_url ('member/apply_withdrawal'); ?>';
    }
</script>