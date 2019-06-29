<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_profile('<?php echo $url;?>')" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">我的地址</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;">
            <?php
            foreach ($data as $key => $row) { ?>
                <div style="width: 100%;height: 110px;padding: 20px;border-top: 6px solid #F7F7F7;background: white;">
                    <div style="width: 75%;height: 100%; float: left;">
                        <div class="row m-0 p-0" style="height: 50%;">
                            <span class="text15_regular black222" style="width: 40%;line-height: 27px;">持卡人</span>
                            <span class="text14_regular black444" style="width: 60%;line-height: 27px;">
                                <?php
                                    echo substr($row['phone'], 0, 3);
                                    echo "****";
                                    echo substr($row['phone'], 7);
                                ?>
                            </span>
                        </div>
                        <div class="row m-0 p-0" style="height: 50%;">
                            <span class="text14_regular black444" style="width: 100%;line-height: 27px;">地址：<?php echo ($row['province'].$row['city'].$row['district'].$row['detail']); ?></span>
                        </div>

                    </div>
                    <?php if($row['status'] == 1){ ?>
                        <div style="width: 25%;height: 100%; float: left;">
                            <div style="width: 100%;height: 22px;">
                                <div class="parent-table" style="width: 40px;height: 20px;border: 1px solid #F74832;border-radius: 5px;float: right;">
                                    <div class="child-cell">
                                        <span class="text14_regular redF74832">默认</span>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 100%;">
                                <div class="parent-table" onclick="go_change_address(<?php echo $row['id']; ?>, '<?php echo $url; ?>')" style="float: right;width: 55px;height: 30px;background: #90C549;border-radius: 6px;margin-top: 5px;cursor: pointer;">
                                    <div class="child-cell">
                                        <span class="text14_medium whiteFFF" style="font-size: 13px;">修改</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php }
                    else{ ?>
                        <div style="width: 25%;height: 100%; float: left;">
                            <div class="parent-table" onclick="go_change_address(<?php echo $row['id']; ?>, '<?php echo $url; ?>')" style="float: right;width: 55px;height: 30px;background: #90C549;border-radius: 6px;margin-top: 25px;cursor: pointer;">
                                <div class="child-cell">
                                    <span class="text14_medium whiteFFF" style="font-size: 13px;">修改</span>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                </div>
            <?php } ?>


            <!--      button      /////-->
            <div class="col-sm-12 pl-2 pr-2" style="position: absolute;bottom: 50px;">
                <button type="button" onclick="go_add_address('<?php echo $url;?>')" class="btn mb-1" style="width: 100%;color: white;background: #F5A623;
border-radius: 8px;height: 45px;">新增地址</button>
            </div>
        </div>

    </div>
</div>
<style>

</style>
<script>
    function go_profile(url) {
        console.log(url);
        if (url == 'member') location.href = '<?php echo base_url ('member'); ?>';
        else location.href = '<?php echo base_url ('front/'); ?>'+url;
    }
    function go_add_address(url) {
        location.href = '<?php echo base_url ('member/add_address/'); ?>' + url;
    }
    function go_change_address(id, url) {
        location.href = '<?php echo base_url ('member/change_address/'); ?>'+ id + '/' + url;
    }
</script>