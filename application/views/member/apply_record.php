<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_apply_withdrawal()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">提现记录</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-0 text14_medium black444" style="max-width: 37.5rem;width: 100%;height: 45px;line-height: 45px;padding: 0 5%;border-top: 2px solid #F7F7F7;border-bottom: 1px solid #F7F7F7;position:fixed;top: 45px;background-color: white;z-index: 3;">
            <div class="col-sm-4" style="width: 33.333%;text-align: center">
                <span>金额</span>
            </div>
            <div class="col-sm-4" style="width: 33.333%;text-align: center">
                <span>事件</span>
            </div>
            <div class="col-sm-4" style="width: 33.333%;text-align: center">
                <span>提现时间</span>
            </div>
        </div>
        <div class="content-body" style="margin-top: 90px;">
            <?php if (count($data) > 0) { foreach ($data as $record) {?>
                <div class="row m-0 text14_regular black444" style="width: 100%;height: 35px;line-height: 35px;padding: 0 5%;">
                    <div class="col-sm-4" style="width: 33.333%;text-align: center">
                        <span class="redF74832">￥<?php echo $record['amount']; ?></span>
                    </div>
                    <div class="col-sm-4" style="width: 33.333%;text-align: center">
                        <span><?php
                            if ($record['status'] == 0) echo "正在审查中";
                            else if ($record['status'] == 1) echo "提现";
                            else echo "取消提现";
                            ?>
                        </span>
                    </div>
                    <div class="col-sm-4" style="width: 33.333%;text-align: center">
                        <span><?php echo substr($record['updated_at'], 0, 10); ?></span>
                    </div>
                </div>
            <?php }} else{?>
                <div style="width: 100%;text-align: center;margin-top: 30%;"><h3>没有申请提现的记录</h3></div>
            <?php }?>
        </div>

    </div>
</div>

<script>

    function go_apply_withdrawal() {
        location.href = '<?php echo base_url ('member/apply_withdrawal'); ?>';
    }
</script>