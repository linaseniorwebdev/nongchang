<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #f8f8f8;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span class="top_title_text">首页</span>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-bottom: 60px;margin-top: 45px;">
            <div class="row m-0 p-0">
<!--                <div id="carousel-pause" class="carousel slide" data-ride="carousel" data-pause="" style="width: 100%;">-->
<!--                    <div class="carousel-inner" role="listbox">-->
<!--                        <div class="carousel-item active">-->
                            <img id="header-img1" src="public/img/home/home_header.png" alt="First slide" class="home_header_img">
<!--                        </div>-->
<!--                        <div class="carousel-item">-->
<!--                            <img id="header-img2" src="public/img/raw_1534868547.png" alt="Second slide" style="width: 100%;height: 200px;">-->
<!--                        </div>-->
<!--                        <div class="carousel-item">-->
<!--                            <img id="header-img3" src="public/img/raw_1534872014.png" alt="Third slide" style="width: 100%;height: 200px;">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <div class="row" style="border-bottom: 6px solid #F5F5F5;margin: 0">
                <div class="col-sm-5" style="text-align: center;width: 41.66667%;border-right: 1px solid #F5F5F5;padding: 0 5%;cursor: pointer;" onclick="go_select_area()">
                    <img src="public/img/home/liangtian.png" style="width: 100%;margin-top: 21%;">
                    <p class="mb-0" style="font-family: PingFangSC-Medium;
                        font-size: 15px;
                        color: #81AE46;
                        letter-spacing: 0;
                        line-height: 15px;
                        margin-top: 10%;font-weight: bold;">认购良田</p>
                </div>
                <div class="col-sm-7" style="width: 58.33333%;">
                    <div class="row" onclick="go_slot_game()" style="border-bottom: 1px solid #F5F5F5;cursor: pointer;">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-7 mt-1 mb-1" style="width: 58.33333%;text-align: center;">
                                    <img src="public/img/home/hobies.png" style="width: 55%;;margin-top: -2rem;">
                                </div>
                                <div class="col-sm-5 mt-1 mb-1" style="padding:0;text-align: left;width: 41.66667%;">
                                    <div style="display: table;width: 100%;height: 100%;">
                                        <div style="display: table-cell;vertical-align: middle;">
                                            <p class="mb-0" style="font-family: PingFangSC-Medium;
                                                font-size: 15px;
                                                color: #81AE46;
                                                letter-spacing: 0;
                                                line-height: 15px;font-weight: bold;">趣味偷菜</p>
                                            <p class="mb-0" style="font-family: PingFangSC-Regular;
                                                font-size: 12px;
                                                color: #999999;
                                                letter-spacing: 0;
                                                line-height: 14px;
                                                margin-top: 1rem;">免费领好货</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" onclick="go_intro()" style="cursor: pointer;">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-7" style="width: 58.33333%;text-align: center;">
                                    <img src="public/img/home/introduction.png" style="width: 55%;margin: 1rem;">
                                </div>
                                <div class="col-sm-5" style="padding:0;text-align: left;width: 41.66667%;">
                                    <div style="display: table;width: 100%;height: 100%;">
                                        <div style="display: table-cell;vertical-align: middle;">
                                            <p class="mb-0 text15_medium yellowF5A623" style="font-weight: bold;">项目介绍</p>
                                            <p class="mb-0 text12_regular black999" style="margin-top: 1rem;padding-left: 6px;">诚邀体验</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ml-0 mr-0" style="padding: 4%;">
                <div style="float:left;width: 50%;">
                    <span style="font-size: 1.2rem;float: left;color: #030303;font-weight: bold;">优选农品</span>
                </div>
                <div style="float:right;width: 50%;">
                    <span onclick="view_more()" style="font-size: 14px;color: rgb(179, 179, 179);float: right;">更多</span>
                </div>
            </div>
            <div id="products_div" class="row m-0 pl-0">

                <?php if (count($products) > 0){ foreach ($products as $key => $product){ ?>
                    <div class="col-sm-4" onclick="go_product_detail(<?php echo $product['id']; ?>)" style="width: 33.333%;padding: 5px;text-align: center;">
                        <img src="<?php echo base_url($product['image']); ?>" style="width: 100%;">
                        <p class="mt-1 mb-1" style="font-size: 1rem;color: #444444;"><?php echo $product['name']; ?></p>
                        <p class="mb-0" style="font-size: 1.2rem;color: #FA5359;">¥<?php echo $product['price']?></p>
                    </div>
                <?php if ($key == 5) break;}
                }else{?>
                    <div style="width: 100%;text-align: center;"><h3>没有产品</h3></div>
                <?php } ?>

            </div>
            <div class="row m-0 p-0" style="border-top: 6px solid #F5F5F5;position: relative;background-image: url('public/img/home/home_ad.png');height: 105px;background-size: 100% auto;background-position: center center;">
                <div style="display: table;width: 100%;height: 100%;">
                    <div style="display: table-cell;vertical-align: middle;color: white;text-align: center;">
                        <p style="font-size: 16px">一亩好地，臻品邀约</p>
                        <p style="font-size: 12px">互联网+农场商业新模式</p>
                    </div>
                </div>
            </div>
            <!-- <?php if (count($lands) > 0) { foreach ($lands as $land){?>
            <div onclick="show_video(<?php echo $land['id'];?>)" class="row m-0 p-0 home_ad" style="background-image: url('<?php echo base_url($land['map']); ?>');">
                <div style="width: 100%;position: absolute;bottom: 0;">
                    <p class="m-0 p-2">
                        <span style="font-size: 14px"><?php echo $land['landnum']?>农场地实景欣赏</span>
                        <label style="float:right;">
                            <span class="mdi mdi-eye" style="font-size: 18px;vertical-align: middle;"></span>
                            <span style="font-size: 12px">56768</span>
                        </label>
                    </p>
                </div>
                <div id="video_part<?php echo $land['id'];?>" style="position:absolute;display: none;z-index: 10;">
                    <video id="land_video<?php echo $land['id'];?>" controls style="width: 100%;height: 100%;">
                        <source src="<?php echo base_url($land['intro']); ?>" type="video/mp4">
                    </video>
                </div>
            </div>
            <?php } }?> -->
        </div>
        <div class="footer" style="max-width: 37.5rem;width: 100%;height: 45px;position: fixed;bottom: 0;border-color: transparent;background-color: #ffffff;border-top: 3px solid #F5F5F5;z-index: 1000;">
            <div class="row m-0 p-0" style="height: 100%;">
                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/home_selected.png" style="height: 90%;margin: 4px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #90C549;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">首页</span>
                    </div>
                </div>

                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;" onclick="go_top_product();">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/product_unselected.png" style="height: 94%;margin: 4px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #999999;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">优品</span>
                    </div>
                </div>

                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;" onclick="go_task()">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/task_unselected.png" style="height: 89%;margin: 5px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #999999;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">任务</span>
                    </div>
                </div>

                <div class="col-sm-3 m-0 p-0" style="width: 25%;height: 100%;" onclick="go_profile()">
                    <div style="text-align: center;width: 100%;height: 60%;">
                        <img src="public/img/bottom_icon/person_unselected.png" style="height: 88%;margin: 4px;">
                    </div>
                    <div style="text-align: center;width: 100%;height: 40%;">
                        <span style="font-family: PingFangSC-Regular;
                            font-size: 10px;
                            color: #999999;
                            letter-spacing: 0;
                            line-height: 10px;font-weight: bold;">我的</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        // adjustImage();
    });
    function view_more() {
        var html = '';
        html += '<?php if (count($products) > 0){ foreach ($products as $key => $product){ ?>';
        html += '<div class="col-sm-4" onclick="go_product_detail(<?php echo $product['id']; ?>)" style="width: 33.333%;padding: 5px;text-align: center;">';
        html += '<img src="<?php echo base_url($product['image']); ?>" style="width: 100%;">';
        html += '<p class="mt-1 mb-1" style="font-size: 1rem;color: #444444;"><?php echo $product['name']; ?></p>';
        html += '<p class="mb-0" style="font-size: 1.2rem;color: #FA5359;">¥<?php echo $product['price']?></p>';
        html += '</div>';
        html += '<?php }}else{?>';
        html += '<div style="width: 100%;text-align: center;"><h3>没有产品</h3></div>';
        html += '<?php } ?>';
        $('#products_div').html(html);
    }
    function show_video(video_id) {
        $('#video_part' + video_id).css('display', 'block');
        $('#land_video' + video_id).get(0).play();
    }
    function go_select_area() {
        location.href = '<?php echo base_url ('front/select/area'); ?>';
    }
    function go_intro() {
        location.href = '<?php echo base_url ('front/intro'); ?>';
    }
    function go_slot_game() {
        // location.href = '<?php echo base_url ('front/stealing_vegetables'); ?>';
    }
    function go_top_product() {
        location.href = '<?php echo base_url ('front/top_product'); ?>';
    }
    function go_task() {
        location.href = '<?php echo base_url ('front/task'); ?>';
    }
    function go_profile() {
        location.href = '<?php echo base_url ('member'); ?>';
    }
    function go_product_detail(product_id) {
        location.href = '<?php echo base_url ('front/product_detail/'); ?>'+ product_id;
    }
</script>