<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_profile()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">申请提现</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="margin-top: 45px;background: #F7F7F7;position: absolute;width: 100%;bottom: 0;top: 0;overflow-y: scroll;">
            <form action="<?php echo base_url ('member/apply_withdrawal') ?>" method="post" style="width: 100%;">
                <div style="width: 100%;height: 150px;padding: 10px 20px;background: white;border-top: 2px solid #F7F7F7;">
                    <p class="row m-0 text14_regular black000">提现</p>
                    <input id="amount" name="amount" type="number" class="text14_regular text_placeholder" placeholder="请输入金额" style="width: 100%;height: 60px;text-align: center;border: none;outline: 0;border-bottom: 2px solid #F7F7F7;">
                    <div class="text12_regular blackAAA" style="width: 100%;height: 30px;padding-top: 10px;">
                        <p>最高可提现：<span class="redFB5E60"><span id="total"><?php if ($withdraw_money['total']) echo $withdraw_money['total']; else echo "0"; ?></span>&nbsp;元</span></p>
                        <p>审核周期为1-2个工作日，提现收取2%手续费</p>
                    </div>
                </div>

                <div style="width: 100%;height: 100px;padding: 20px;background: white;margin-top: 15px">
                    <p class="text15_regular black444" style="border-bottom: 2px solid #F7F7F7;height: 40%;">提现到银行卡</p>
                    <p>
                        <span class="text15_medium black444">
                            <?php if ($bankcard['number']) {
                                echo substr($bankcard['number'], 0, 4);
                                echo " ";
                                echo substr($bankcard['number'], 4, 5);
                                echo " ";
                                echo substr($bankcard['number'], 9, 5);
                                echo " ";
                                echo substr($bankcard['number'], 14);
                                ?>
                                <input type="hidden" id="card" name="card" value="<?php echo $bankcard['id']; ?>">
                            <?php
                            }
                            else{ echo "请选择您的默认银行卡"; ?>
                                <input type="hidden" id="card" value="0">
                            <?php } ?>
                        </span>
                        <span onclick="go_change_bankcard()" class="text14_regular yellowF5A623" style="position: absolute;right: 5%;line-height: 14px;cursor: pointer;">更换</span>
                    </p>
                </div>
                <div class="col-sm-12 mt-4 mb-2 pl-2 pr-2">
                    <button type="button" onclick="go_apply_now()" class="btn mb-1" style="width: 100%;color: white;background: #90C549;box-shadow: 1px 2px 4px 0 rgba(144,197,73,0.36);
        border-radius: 8px;height: 45px;">立即提现</button>
                </div>
            </form>
            <div class="col-sm-12 mb-2 pl-2 pr-2">
                <button type="button" onclick="go_apply_record()" class="btn mb-1" style="width: 100%;color: white;background: #F5A623;box-shadow: 1px 2px 4px 0 rgba(245,166,35,0.58);
    border-radius: 8px;height: 45px;">提现记录</button>
            </div>
        </div>
        <input type="hidden" id="result_apply" value="<?php if (isset($status)) echo $status; ?>">
    </div>
</div>

<script>

    $(document).ready(function() {
        var result = $('#result_apply').val();
        if (result.length > 0 || result != '') {
            if (result == 'success') swal('申请提现成功！', '正在审查中', 'success');
            else if(result == 'fail') swal('警告', '申请提现失败。请再试一次。', 'warning');
        }
    });
    function go_apply_now() {

        var amount = $("#amount").val();
        var total = $("#total").text();
        var card = $("#card").val();
        console.log(parseFloat(total));
        if (amount.length < 1) {
            swal("警告", "请输入金额", "warning");
        }
        else if (card == 0) {
            swal("警告", "请选择您的默认银行卡", "warning");
        }
        else if (amount > parseFloat(total)) {
            swal("警告", "请输入少于最高可提现", "warning");
        }
        else $('form').submit();
    }
    function go_apply_record() {
        location.href = "<?php echo base_url('member/apply_record'); ?>";
    }
    function go_profile() {
        location.href = "<?php echo base_url('member'); ?>";
    }
    function go_change_bankcard() {
        var url = 'withdraw';
        location.href = "<?php echo base_url('member/bankcard_list/'); ?>" + url;
    }
</script>