<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 22;color: #101010;
                                font-size: 18px; width: 100%;background-color: #f8f8f8;max-width: 37.5rem;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_back()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">实景</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;overflow-y: auto;">
            <div class="row m-0 p-0" style="text-align: center; position: relative;">
                <img id="play_btn" class="play_btn" src="public/img/real_scene/play.png">
                <div id="video_part" class="home_header_img" style="position:absolute; display: none; z-index: 10;">
                <?php
                if ($land['has_camera']) {
                    ?>
                    <video id="camera_preview" poster="public/img/thumb.jpg" controls playsInline webkit-playsinline autoplay>
                        <source src="<?php echo $land['channel']['rtmp']; ?>" type="" id="rtmp" />
                        <source src="<?php echo $land['channel']['hls']; ?>" type="application/x-mpegURL" id="hls" />
                    </video>
                    <?php
                } else {
                    ?>
                    <video id="land_video" controls>
                        <source src="../../<?php echo $land['intro']; ?>" type="video/mp4">
                    </video>
                    <?php
                }
                ?>
                </div>
                <img id="header-img1" src="../../<?php echo $land['map']; ?>" alt="First slide" class="home_header_img" style="z-index: 1;">

            </div>

            <div class="row m-0 p-0 play_bottom">
                <div class="col-sm-12 top_intro">
                    <img class="ml-auto mr-auto" src="public/img/real_scene/wooden_sign.png" style="width: 55%;height: 100%;">
                    <span class="wooden_text"><?php echo $land['landnum']; ?>号农场地实景直播</span>
                </div>
                <div class="col-sm-12 cultivation-text mb-1">
                    <div class="text_back p-1 intro_text_style">
                        <div style="width: 100%;overflow-y: auto">
                            <p class="p-0 m-0" style="text-align: center;">适宜耕种</p>
                            <span><?php echo $land['detail']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 ordering_text" style="margin-bottom: 17%;">
                    <div class="text_back p-1 intro_text_style">
                        <div style="width: 100%;overflow-y: auto">
                            <p class="p-0 m-0" style="text-align: center;">订购须知</p>
                            <span>这里是说明这里是说明这里是说明这里是说明这里是说明这里是说明这里是说明这里是说明是说明这里是说明这里是说明是说明这里是说明这里是说明</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($land['owner']) {
            ?>
            <?php
        } else {
            ?>
            <div class="content-footer" style="text-align: center;max-width: 37.5rem;width: 100%;position: fixed;bottom: 0;">
                <button onclick="order_now(<?php echo $land['id']; ?>)" class="btn margin2_bottom_btn">立即订购</button>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<style>
    .margin2_bottom_btn{
        width: 90%;background: #F5A623;border-radius: 8px;color: white;font-size: 16px;margin-bottom: 2%;
        margin-left: auto;
        margin-right: auto;

    }

    .wooden_text{
        font-family: PingFangSC-Medium;
        font-size: 21px;
        color: #8B572A;
        letter-spacing: 0;
        line-height: 21px;
        margin-left: -48%;
        margin-top: 13%;
        position: absolute;
    }

    .intro_text_style{
        font-family: PingFangSC-Regular;
        font-size: 14px;
        color: #8B572A;
        letter-spacing: 0;
        line-height: 28px;
    }

    .ordering_text{

        padding: 0 7%;
    }

    .cultivation-text{

        padding: 0 7%;
    }

    .top_intro{
        height: 20%;
        margin-bottom: 2%;
        text-align: center;
    }

    .play_btn{
        margin-top: 17%;
        position: absolute;
        margin-left: 40%;
        width: 20%;
        z-index: 9;
    }

    .play_bottom{
        background: url('public/img/real_scene/bottom_background.png') top;
        background-size: 100% 100%;
        height: 612px;
    }

    @media screen and (max-width: 567px) {
        .play_bottom{
            height: 100%;
        }
        .wooden_text{
            font-size: 15px;
            line-height: 15px;
            margin-left: -48%;
            margin-top: 13%;
        }
        .top_intro{
            height: 17%;
        }
    }

    .text_back{
        opacity: 0.61;
        background: #FFFFFF;
        border-radius: 20px;
    }

    video {
		width: 100%;
	}
</style>
<script>
    $('#play_btn').click(function () {
        $('#video_part').css('display', 'block');
        <?php
        if ($land['has_camera']) {
            ?>
            <?php
        } else {
            ?>
            $('#land_video').get(0).play();
            <?php
        }
        ?>
       
    });
    function order_now(land_id) {
        location.href = '<?php echo base_url ('front/confirm_pay/'); ?>' + land_id;
    }
    function go_intro() {
        location.href = '<?php echo base_url ('front/intro'); ?>';
    }
</script>