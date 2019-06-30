<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_profile()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">我的仓库</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="margin-top: 45px;margin-bottom: 90px;overflow-y: scroll;position: absolute;width: 100%;top: 0;bottom: 0;">
            <div class="row m-0 text14_medium black444" style="width: 100%;height: 45px;line-height: 45px;padding: 0 5%;border-top: 2px solid #F7F7F7;border-bottom: 1px solid #F7F7F7;">
                <div class="col-sm-4" style="width: 33.333%;text-align: center">
                    <span>产品名称</span>
                </div>
                <div class="col-sm-4" style="width: 33.333%;text-align: center">
                    <span>计量</span>
                </div>
                <div class="col-sm-4" style="width: 33.333%;text-align: center">
                    <span>当前库存</span>
                </div>
            </div>
            
            <?php if(count($stocks) > 0){ 
                foreach ($stocks as $key => $stock) {
                   $product = $products[$key];
                ?>
                <div class="row m-0 text14_regular black444" style="width: 100%;height: 35px;line-height: 35px;padding: 0 5%;">
                    <div class="col-sm-4" style="width: 33.333%;text-align: center">
                        <span><?php echo $product['name']; ?></span>
                    </div>
                    <div class="col-sm-4" style="width: 33.333%;text-align: center">
                        <span><?php echo $units[$product['unit']]['name']; ?></span>
                    </div>
                    <div class="col-sm-4" style="width: 33.333%;text-align: center">
                        <span class="yellowF5A623"><?php echo $stock['amount']; ?></span>
                    </div>
                </div>
            <?php } } ?>

            <div class="col-sm-12 pl-2 pr-2" style="position: fixed;bottom: 10px;max-width: 37.5rem;">
                <button type="button" onclick="go_give_others()" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
    border-radius: 8px;height: 45px;">赠送他人</button>
            </div>
        </div>

    </div>
</div>

<script>

    function go_give_others() {
        location.href = '<?php echo base_url ('member/give_others'); ?>';
    }
    function go_profile() {
        location.href = '<?php echo base_url ('member'); ?>';
    }
</script>