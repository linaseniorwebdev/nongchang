<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background-color: #f5f5f5;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;max-width: 37.5rem; background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_profile()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;">我的土地</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;overflow-y: scroll;">
            <?php if (count($data)>0){ foreach ($data as $land){ ?>
            <div class="row mt-0 ml-0 mr-0 p-0 text14_regular black444" style="background-color: white;border-bottom:8px solid #f5f5f5;" onclick="go_camera(<?php echo $land['id']; ?>)">
                <p class="m-0" style="width: 100%;padding: 10px 0 5px 10px;">土地编号：<span><?php echo $land['landnum']; ?></span></p>
                <p class="m-0" style="width: 100%;padding: 5px 0 10px 10px;">订购时间：<span><?php echo $land['sold_at']; ?></span></p>
                <p class="m-0" style="width: 100%;padding: 5px 0 10px 10px;">位置：<span><?php echo $land['block_description']; ?></span></p>
                <div style="width: 100%;">
                    <img src="../<?php echo $land['map']; ?>" style="width: 100%;">
                    <?php if (!$land['sold_at']){ ?>
                    <div style="width: 100%;text-align: center;position: absolute;margin-top: -45%"><span class="badge badge-warning round text16_medium whiteFFF ">正在审查中</span></div>
                    <?php } ?>
                </div>
            </div>
            <?php } } else{ ?>
                <div style="width: 100%;text-align: center;padding-top: 100px;"><h3>没有土地</h3></div>
            <?php } ?>
        </div>
    </div>

    <script>
        function go_profile() {
            location.href = '<?php echo base_url ('member'); ?>';
        }
        function go_camera(land_id) {
            location.href = "<?php echo base_url('member/my_land_camera/')?>" + land_id;
        }
    </script>