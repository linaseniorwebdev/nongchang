<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;background-color: #f8f8f8;max-width: 37.5rem;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_top_product()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;"><?php if (isset($title)) echo $title;?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;overflow-y: auto;">
            <div class="row m-0 p-0">
            <?php if (count($products) > 0){ foreach ($products as $product){ ?>
            <div class="col-sm-4" onclick="go_product_detail(<?php echo $product['id']; ?>)" style="width: 33.333%;padding: 5px;text-align: center;">
                <img src="<?php echo base_url($product['image']); ?>" style="width: 100%;">
                <p class="mt-1 mb-1" style="font-size: 1rem;color: #444444;"><?php echo $product['name']; ?></p>
                <p class="mb-0" style="font-size: 1.2rem;color: #FA5359;">¥<?php echo $product['price']?></p>
            </div>
            <?php }
            }else{?>
                <div style="width: 100%;text-align: center;margin-top: 40%;">
                    <?php if ($type == 1){?>
                        <img src="public/img/product/today_special_offer.png" style="height: 100px;"/>
                        <h3>没有今日的特惠。</h3>
                    <?php }?>
                    <?php if ($type == 2){?>
                        <img src="public/img/product/vegetables_fruits.png" style="height: 100px;"/>
                        <h3>没有蔬菜水果优品。</h3>
                    <?php }?>
                    <?php if ($type == 3){?>
                        <img src="public/img/product/meat.png" style="height: 100px;"/>
                        <h3>没有家禽肉类优品。</h3>
                    <?php }?>
                    <?php if ($type == 4){?>
                        <img src="public/img/product/aquatic_product.png" style="height: 100px;"/>
                        <h3>没有水产冻品。</h3>
                    <?php }?>
                    <?php if ($type == 5){?>
                        <img src="public/img/product/egg_tofu.png" style="height: 100px;"/>
                        <h3>没有豆腐禽蛋优品。</h3>
                    <?php }?>
                    <?php if ($type == 6){?>
                        <img src="public/img/product/delicatessen_pasta.png" style="height: 100px;"/>
                        <h3>没有熟食面食优品。</h3>
                    <?php }?>
                    <?php if ($type == 7){?>
                        <img src="public/img/product/points.png" style="height: 100px;"/>
                        <h3>没有优秀的产品可以使用积分。</h3>
                    <?php }?>
                    <?php if ($type == 8){?>
                        <img src="public/img/product/other.png" style="height: 100px;"/>
                        <h3>没有其他农品</h3>
                    <?php }?>
                </div>
            <?php } ?>
            </div>
        </div>

    </div>
</div>

<style>

</style>
<script>

    $(document).ready(function(){
        // adjustImage();
    });
    $( window ).resize(function() {
        adjustImage();
    });
    function adjustImage(){
    }
    function go_top_product() {
        location.href = '<?php echo base_url ('front/top_product'); ?>';
    }
    function go_product_detail(product_id) {
        location.href = '<?php echo base_url ('front/product_detail/'); ?>' + product_id;
    }
</script>