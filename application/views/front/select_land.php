<div class="app-content content land_back">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;background-color: #f8f8f8;max-width: 37.5rem;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_select_area()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;">认购农场</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <ul class="row land_type">
                <li id="paddy_field" class="black999 green81AE46" onclick="go_land_type(1)" style="width: 20%;height: 100%;text-align: center;">
                    <span>水田</span>
                </li>
                <li id="dry_land" class="black999" onclick="go_land_type(2)" style="width: 20%;height: 100%;text-align: center;">
                    <span>旱地</span>
                </li>
                <li id="mountain_soil" class="black999" onclick="go_land_type(3)" style="width: 20%;height: 100%;text-align: center;">
                    <span>山土</span>
                </li>
                <li id="wetlands" class="black999" onclick="go_land_type(4)" style="width: 20%;height: 100%;text-align: center;">
                    <span>湿地</span>
                </li>
                <li id="riverside" class="black999" onclick="go_land_type(5)" style="width: 20%;height: 100%;text-align: center;">
                    <span>河畔</span>
                </li>
            </ul>
            <input type="hidden" id="block_id" value="<?php echo $block_id; ?>">
            <div id="lands" class="row" style="margin-top: 10%;padding:0 10% 0 10%;color: white;">
                <?php if ($lands){ foreach ($lands as $land) {
                    if ($land['owner'] == null){
                ?>
                    <div style="width: 25%;text-align: center;margin-top: 3%;" onclick="go_real_scene(<?php echo $land['id']; ?>)">
                        <div class="m-auto land_item">
                            <span class="land_text15"><?php echo $land['landnum']; ?></span>
                        </div>
                        <div class="land_item_bottom">
                            <span class="land_text14">可租</span>
                        </div>
                    </div>
                    <?php } else { if ($land['sold_at'] == null){?>
                        <div style="width: 25%;text-align: center;margin-top: 3%;opacity: 0.5" onclick="go_real_scene(<?php echo $land['id']; ?>)">
                            <div class="m-auto land_item">
                                <span class="land_text15"><?php echo $land['landnum']; ?></span>
                            </div>
                            <div class="land_item_bottom">
                                <span class="land_text14">待收货</span>
                            </div>
                        </div>
                        <?php } else {?>
                        <div style="width: 25%;text-align: center;margin-top: 3%;" onclick="go_real_scene(<?php echo $land['id']; ?>)">
                            <div class="m-auto land_item" style="background-color: #CA974E;">
                                <span class="land_text15"><?php echo $land['landnum']; ?></span>
                            </div>
                            <div class="land_item_bottom" style="background-color: #AAAAAA;">
                                <span class="land_text14">已售</span>
                            </div>
                        </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php } else {?>
                    <div style="width: 100%;text-align: center;margin-top: 10%;"><h3>没有土地</h3></div>
                <?php } ?>
            </div>
        </div>
    </div>
    <style>
        ul li{list-style-type: none;}
        .land_back{
            max-width: 37.5rem;height: 100%;margin-left: auto;margin-right: auto;
            background: url('public/img/subscribe_to_farm_background.png') top;
            background-size: 100% 96%;background-position-y: 45px;
            background-repeat: no-repeat;
        }
        .land_type{
            margin: 70px 6% 0 6%;height: 42px;border-radius: 21px; background-color: white;padding: 2%;font-weight: bold;
        }
        .land_item{
            width: 70px;height: 70px;background-color: #90C549;border-radius: 10px;padding-top: 10px;
        }
        .land_item_bottom{
            width: 60px;height: 24px;margin-top: -15px;background: #F5A623;
            border-radius: 10px;margin-left: auto;margin-right: auto;padding-top: 2px;
        }
        .land_text15{
            font-family: PingFangSC-Regular;
            font-size: 15px;
            color: #FFFFFF;
            letter-spacing: 0;
            line-height: 15px;
        }
        .land_text14{
            font-family: PingFangSC-Medium;
            font-size: 14px;
            color: #FFFFFF;
            letter-spacing: 0;
            line-height: 14px;
        }
        @media screen and (max-width: 567px) {
            .land_back{
                background-size: 100% 94%;
            }
            .land_type{
                padding: 3%;
            }
        }
    </style>
    <script>
        $(document).ready(function () {

            checkDevice();
            $(window).resize(function() {
                checkDevice();
            });
        });
        function checkDevice() {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                var wd = parseInt(window.innerWidth);
                var ht = parseInt(window.innerHeight);
                if (ht > wd) {
                    console.log('portrait');
                    $('.app-content').css('min-height', ht);
                }
                else{

                    if (ht<525){
                        console.log('landscape');
                        $('.app-content').css('min-height', 750);
                    }
                    else $('.app-content').css('min-height', ht*667/375);
                }
            }
        }
        function go_land_type(land_type) {
            $('.land_type li').removeClass('green81AE46');
            if (land_type == 1) $('#paddy_field').addClass('green81AE46');
            else if (land_type == 2) $('#dry_land').addClass('green81AE46');
            else if (land_type == 3) $('#mountain_soil').addClass('green81AE46');
            else if (land_type == 4) $('#wetlands').addClass('green81AE46');
            else $('#riverside').addClass('green81AE46');
            var block_id = $('#block_id').val();
            $.post("<?php echo base_url('front/selected_lands') ?>", {block_id: block_id, land_type: land_type},
                function (data) {
                    var result = JSON.parse(data);
                    if (result.status == "success") {
                        var selected_lands = result['lands'];
                        var html = '';
                        if (selected_lands.length > 0){
                            for (var i=0; i<selected_lands.length; i++){
                                var land = selected_lands[i];
                                if (land['owner'] == null){
                                    html += '<div style="width: 25%;text-align: center;margin-top: 3%;" onclick="go_real_scene('+ land['id'] +')">';
                                    html += '<div class="m-auto land_item">';
                                    html += '<span class="land_text15">'+ land['landnum'] +'</span>';
                                    html += '</div>';
                                    html += '<div class="land_item_bottom">';
                                    html += '<span class="land_text14">可租</span>';
                                    html += '</div>';
                                    html += '</div>';
                                }
                                else {
                                    if (land['sold_at'] == null){
                                        html += '<div style="width: 25%;text-align: center;margin-top: 3%;opacity: 0.5" onclick="go_real_scene('+ land['id'] +')">';
                                        html += '<div class="m-auto land_item">';
                                        html += '<span class="land_text15">'+ land['landnum'] +'</span>';
                                        html += '</div>';
                                        html += '<div class="land_item_bottom">';
                                        html += '<span class="land_text14">待收货</span>';
                                        html += '</div>';
                                        html += '</div>';
                                    }
                                    else{
                                        html += '<div style="width: 25%;text-align: center;margin-top: 3%;" onclick="go_real_scene('+ land['id'] +')">';
                                        html += '<div class="m-auto land_item" style="background-color: #CA974E;">';
                                        html += '<span class="land_text15">'+ land['landnum'] +'</span>';
                                        html += '</div>';
                                        html += '<div class="land_item_bottom" style="background-color: #AAAAAA;">';
                                        html += '<span class="land_text14">已售</span>';
                                        html += '</div>';
                                        html += '</div>';
                                    }
                                }
                            }
                        }
                        else{
                            html += '<div style="width: 100%;text-align: center;margin-top: 10%;"><h3>没有土地</h3></div>';
                        }
                        $('#lands').html(html);

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
        }
        function go_real_scene(id) {
            location.href = "<?php echo base_url ('front/real_scene/'); ?>"+id;
        }
        function go_select_area() {
            location.href = "<?php echo base_url ('front/select/area'); ?>";
        }
    </script>