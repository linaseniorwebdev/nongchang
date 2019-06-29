<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_warehouse()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">赠送他人</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="width: 100%;position: absolute;top: 0;margin-top: 45px;bottom: 90px; overflow-y: scroll;">
            <div class="row m-0 text14_medium black444" style="width: 100%;height: 45px;line-height: 45px;padding: 0 5%;border-top: 2px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;background: white;">
                <div style="width: 25%;text-align: center">
                    <span>产品名称</span>
                </div>
                <div style="width: 20%;text-align: center">
                    <span>计量</span>
                </div>
                <div style="width: 25%;text-align: center">
                    <span>当前库存</span>
                </div>
                <div style="width: 30%;text-align: center">
                    <span>当前库存</span>
                </div>
            </div>
            <div style="width: 100%;background: white;">
                <div class="row m-0 text14_regular black444" style="width: 100%;height: 35px;line-height: 35px;padding: 0 5%;">
                    <div style="width: 25%;text-align: center">
                        <span>土豆</span>
                    </div>
                    <div style="width: 20%;text-align: center">
                        <span>斤</span>
                    </div>
                    <div style="width: 25%;text-align: center">
                        <span class="yellowF5A623">15</span>
                    </div>
                    <div style="width: 30%;text-align: center">
                        <img onclick="minus_cnt()" src="public/img/minus.png" style="width: 25px;">&nbsp;&nbsp;
                        <span id="product_cnt" class="black_text14">1</span>&nbsp;&nbsp;
                        <img onclick="plus_cnt()" src="public/img/plus.png" style="width: 25px;">
                    </div>
                </div>

            </div>
            <div style="width: 100%;height: 130px;padding: 5%;background: white;border-top: 6px solid #F7F7F7;">
                <p class="text15_regular black222">填写收货地址</p>
                <textarea class="text_placeholder" placeholder="多行输入" style="width: 100%;height: 60px;border: none;outline: 0;resize: none;"></textarea>
            </div>
            <div style="width: 100%;height: 120px;padding: 5%;background: white;border-top: 6px solid #F7F7F7;">
                <p class="text15_regular black222">备注</p>
                <textarea class="text_placeholder" placeholder="多行输入" style="width: 100%;height: 50px;border: none;outline: 0;resize: none;"></textarea>
            </div>

            <div class="col-sm-12 pl-2 pr-2" style="position: fixed;bottom: 10px;max-width: 37.5rem;">
                <button type="button" onclick="go_give_others()" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
    border-radius: 8px;height: 45px;">提交</button>
            </div>
        </div>

    </div>
</div>

<script>
    function plus_cnt() {
        var cnt = $('#product_cnt').text();
        var int_cnt = parseInt(cnt);
        int_cnt += 1;
        $('#product_cnt').text(int_cnt);
    }
    function minus_cnt() {
        var cnt = $('#product_cnt').text();
        var int_cnt = parseInt(cnt);
        if(int_cnt != 1 ){
            int_cnt -= 1;
            $('#product_cnt').text(int_cnt);
        }
    }
    function go_warehouse() {
        location.href = '<?php echo base_url ('member/warehouse'); ?>';
    }
</script>