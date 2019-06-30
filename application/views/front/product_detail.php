<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;background-color: #f8f8f8;max-width: 37.5rem;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_products(<?php echo $product['type']; ?>)" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;">商品详情</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;margin-bottom: 50px;overflow-y: auto;">
            <input id="product_id" type="hidden" value="<?php echo $product['id']; ?>">
            <div class="row m-0 p-0" style="text-align: center;">
                <img id="header-img1" src="<?php echo base_url($product['image']); ?>" alt="First slide" class="home_header_img" style="width: auto;margin-left: auto;margin-right: auto;">
            </div>
            <div style="width: 100%;border-bottom: 2px solid #F5F5F5;">
                <p class="p-0" style="font-size: 15px;color: #444444;margin: 10px 20px;text-align: left;"><?php echo $product['name'];echo $product['scale'];echo $unit['name']; ?>
                    <span style="float: right;color: #AAAAAA;">库存：<span id="stock"><?php echo $product['stock']; ?></span>件</span>
                </p>
                <p class="red_text15" style="padding: 0 20px;">¥<?php echo $product['price']; ?></p>
            </div>
            <div class="row m-0" style="width: 100%;padding: 5% 5% 2% 5%;border-bottom: 2px solid #F5F5F5;">
                <div style="width: 20%;">
                    <img src="public/img/store_avatar.png" style="width: 50px;height: 50px;">
                </div>
                <div style="width: 55%;padding: 0 5%;">
                    <p><?php echo $user['fullname']; ?>的一亩三分地</p>
                    <p class="black_text14" style="font-size: 15px;color: #90C549">22<span style="color: #AAAAAA;">全部商品</span></p>
                </div>
                <div style="width: 25%;">
                    <btton class="btn p-0" style="width: 100%;max-width: 150px;height: 35px;line-height: 35px; background: #90C549;border-radius: 10px;color: #ffffff;margin-top: 8%;" onclick="go_land_real_scene(<?php echo $product['land']; ?>)">观看实景</btton>
                </div>
            </div>
            <p class="black_text15 m-0" style="color: #F5A623;border-bottom: 1px solid #F5F5F5;padding: 5%;">商品详情</p>
            <div style="width: 100%;padding: 3% 5%;color: #AAAAAA;">
                <span><?php echo $product['description']; ?></span>
            </div>
        </div>
        <input type="hidden" id="is_login" value="<?php echo $login_user; ?>">
        <?php if ($login_user != -1){  if ($user['id'] != $login_user){?>
            <div class="footer" style="max-width: 37.5rem;width: 100%;height: 45px;position: fixed;bottom: 0;border-color: transparent;background-color: #ffffff;border-top: 3px solid #F5F5F5;">
            <div class="row m-0 p-0" style="height: 100%;">
                <div style="width: 26%;height: 100%;">
                    <div class="row m-0 p-0" style="height:100%">
                        <div style="width: 50%;height: 100%;" onclick="add_heart()">
                            <div style="text-align: center;width: 100%;height: 60%;">
                                <img src="public/img/favorites_unchecked.png" style="height: 90%;margin: 4px;">
                            </div>
                            <div style="text-align: center;width: 100%;height: 40%;">
                                <span style="font-family: PingFangSC-Regular;
                                font-size: 10px;
                                color: #999999;
                                letter-spacing: 0;
                                line-height: 10px;font-weight: bold;">收藏</span>
                            </div>
                        </div>
                        <div style="width: 50%;height: 100%;" onclick="go_shopping_cart()">
                            <div style="text-align: center;width: 100%;height: 60%;">
                                <img src="public/img/shopping_cart.png" style="height: 90%;margin: 4px;">
                                <?php if (count($carts) > 0) { ?>
                                <div style="position: absolute;top: 0;left: 20%;width: 18px;height: 18px;background: #FA5959;line-height: 18px;border-radius: 9px;">
                                    <span id="product_num" class="text12_regular whiteFFF"><?php echo (count($carts)); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                            <div style="text-align: center;width: 100%;height: 40%;">
                                <span style="font-family: PingFangSC-Regular;
                                font-size: 10px;
                                color: #999999;
                                letter-spacing: 0;
                                line-height: 10px;font-weight: bold;">购物车</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 37%;height: 100%;background: #90C549;line-height: 45px;text-align: center" onclick="add_cart(<?php echo $product['id']; ?>)">
                    <span style="font-family: PingFangSC-Regular;
                                font-size: 16px;
                                color: #FFFFFF;
                                letter-spacing: 0;
                                line-height: 16px;">加入购物车</span>
                </div>
                <div style="width: 37%;height: 100%;background: #F5A623;line-height: 45px;text-align: center" onclick="go_confirm_order('<?php echo $product['id']; ?>')">
                    <span style="font-family: PingFangSC-Regular;
                                font-size: 16px;
                                color: #FFFFFF;
                                letter-spacing: 0;
                                line-height: 16px;">立即购买</span>
                </div>
            </div>
        </div>
        <?php } } else{?>
            <div class="footer" style="max-width: 37.5rem;width: 100%;height: 45px;position: fixed;bottom: 0;border-color: transparent;background-color: #ffffff;border-top: 3px solid #F5F5F5;">
                <div class="row m-0 p-0" style="height: 100%;">
                    <div style="width: 26%;height: 100%;">
                        <div class="row m-0 p-0" style="height:100%">
                            <div style="width: 50%;height: 100%;" onclick="add_heart()">
                                <div style="text-align: center;width: 100%;height: 60%;">
                                    <img src="public/img/favorites_unchecked.png" style="height: 90%;margin: 4px;">
                                </div>
                                <div style="text-align: center;width: 100%;height: 40%;">
                                <span style="font-family: PingFangSC-Regular;
                                font-size: 10px;
                                color: #999999;
                                letter-spacing: 0;
                                line-height: 10px;font-weight: bold;">收藏</span>
                                </div>
                            </div>
                            <div style="width: 50%;height: 100%;" onclick="go_shopping_cart()">
                                <div style="text-align: center;width: 100%;height: 60%;">
                                    <img src="public/img/shopping_cart.png" style="height: 90%;margin: 4px;">
                                    <?php if (isset($carts)){ if (count($carts) > 0) { ?>
                                        <div style="position: absolute;top: 0;left: 20%;width: 18px;height: 18px;background: #FA5959;line-height: 18px;border-radius: 9px;">
                                            <span id="product_num" class="text12_regular whiteFFF"><?php echo (count($carts)); ?></span>
                                        </div>
                                    <?php }} ?>
                                </div>
                                <div style="text-align: center;width: 100%;height: 40%;">
                                <span style="font-family: PingFangSC-Regular;
                                font-size: 10px;
                                color: #999999;
                                letter-spacing: 0;
                                line-height: 10px;font-weight: bold;">购物车</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="width: 37%;height: 100%;background: #90C549;line-height: 45px;text-align: center" onclick="add_cart(<?php echo $product['id']; ?>)">
                    <span style="font-family: PingFangSC-Regular;
                                font-size: 16px;
                                color: #FFFFFF;
                                letter-spacing: 0;
                                line-height: 16px;">加入购物车</span>
                    </div>
                    <div style="width: 37%;height: 100%;background: #F5A623;line-height: 45px;text-align: center" onclick="go_confirm_order('<?php echo $product['id']; ?>')">
                    <span style="font-family: PingFangSC-Regular;
                                font-size: 16px;
                                color: #FFFFFF;
                                letter-spacing: 0;
                                line-height: 16px;">立即购买</span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div id="modal_background" style="display: none;position: fixed;width: 100%;max-width: 37.5rem;height: 100%;top: 0;opacity: 0.48;background: #797474;margin-left: auto;margin-right: auto;"></div>
    <div id="pay_modal" style="width: 100%;max-width: 37.5rem;height: 30%;position: fixed;bottom: -50%;background: white;margin-left: auto;margin-right: auto;">
        <div style="width: 100%;padding: 3%;">
            <div style="border-bottom: 1px solid #DDDDDD;padding-bottom: 10px;">
                <span class="text14_regular black444">请选择购买数量</span>
                <span onclick="hide_pay_modal()" class="mdi mdi-close" style="font-size: 21px;color: #AAAAAA;float: right;margin-top: -6px;"></span>
            </div>
        </div>
        <p style="width: 100%;padding: 1% 5%;">
            <span class="text14_regular black444" style="margin: 10% 0;text-align: left;">购买数量</span>
            <span style="float: right">
                        <img onclick="minus_cnt()" src="public/img/minus.png" style="width: 25px;">&nbsp;&nbsp;
                        <span id="product_cnt" class="black_text14">1</span>&nbsp;&nbsp;
                        <img onclick="plus_cnt()" src="public/img/plus.png" style="width: 25px;">
                    </span>
        </p>
        <div style="width: 100%; height: 45px;background: #90C549;text-align: center;line-height: 45px;bottom: 0;position: absolute;" onclick="confirm_cnt()">
            <span class="text16_regular whiteFFF">确认数量</span>
        </div>
    </div>
</div>

<style>

</style>
<script>

    $(document).ready(function(){

    });
    function go_products(type) {
        type = parseInt(type) + 1;
        location.href = '<?php echo base_url ('front/products/'); ?>' + type;
    }
    function show_pay_modal() {
        $('#modal_background').css('display', 'block');
        $('#pay_modal').animate({bottom: 0},'normal');
    }
    function hide_pay_modal() {
        $('#modal_background').css('display', 'none');
        $('#pay_modal').animate({bottom: '-50%'}, 'normal');
    }
    function plus_cnt() {
        var cnt = $('#product_cnt').text();
        var int_cnt = parseInt(cnt);
        var str_stock = $('#stock').text();
        var stock = parseInt(str_stock);
        if (int_cnt < stock){
            int_cnt += 1;
            $('#product_cnt').text(int_cnt);
        }

    }
    function minus_cnt() {
        var cnt = $('#product_cnt').text();
        var int_cnt = parseInt(cnt);
        if(int_cnt != 1 ){
            int_cnt -= 1;
            $('#product_cnt').text(int_cnt);
        }
    }
    function add_cart() {
        show_pay_modal()
    }
    function confirm_cnt() {
        if ($('#is_login').val() == -1) {
            location.href = '<?php echo base_url ('member/login'); ?>';
        }
        else{
            var cnt = parseInt($('#product_cnt').text());
            var product_id = $('#product_id').val();
            var product_num = $('#product_num').text();
            $.post("<?php echo base_url('front/add_cart') ?>", {product_id: product_id ,cnt: cnt},
                function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    if (result.status == "success") {
                        product_num = parseInt(product_num) + 1;
                        $('#product_num').text(product_num);
                        hide_pay_modal();
                        location.reload();
                    } else {
                        swal("提示", "请再试一次。", "warning");
                    }
                }
            );
        }

    }
    function add_heart() {

    }
    function go_confirm_order(product_id) {
        var url = "product_detail";
        location.href = '<?php echo base_url ('front/confirm_order/'); ?>' + url + '/' + product_id;
    }
    function go_shopping_cart() {
        location.href = '<?php echo base_url ('front/shopping_cart'); ?>';
    }
    function go_land_real_scene(land_id) {
        location.href = '<?php echo base_url ('front/real_scene/'); ?>' + land_id;
    }
</script>