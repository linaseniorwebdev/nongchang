<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background-color: #f5f5f5;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;max-width: 37.5rem; background-color: #f8f8f8;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_back()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;">实景</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="margin-top: 45px;position: absolute;width: 100%;bottom: 0;top: 0;overflow-y: scroll;">
            <?php if (count($data)>0){ foreach ($data as $key => $land){ ?>
                <div class="row mt-0 ml-0 mr-0 p-0 text14_regular black444" style="background-color: white;border-bottom:8px solid #f5f5f5;">
                    <p class="m-0" style="width: 100%;padding: 10px 0 5px 10px;">土地详情：<span><?php echo $land['title']; ?></span></p>
                    <div style="width: 100%;">
                        <video class="myvideo" id="myPlayer<?php echo $key; ?>" poster="public/img/thumb.jpg" controls playsInline webkit-playsinline autoplay style="width: 100%;">
                            <?php if ($land['rtmp']){ ?>
                                <source src="<?php echo $land['rtmp']; ?>" type="" />
                            <?php } ?>
                            <?php if ($land['hls']){ ?>
                                <source src="<?php echo $land['hls']; ?>" type="application/x-mpegURL" />
                            <?php } ?>
                            <?php if ($land['ws']){ ?>
                                <source src="<?php echo $land['ws']; ?>"  />
                            <?php } ?>
                        </video>
                    </div>
                </div>
            <?php } } else{ ?>
                <div style="width: 100%;text-align: center;padding-top: 100px;"><h3>没有土地</h3></div>
            <?php } ?>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var key = 0;
            $(".myvideo").each(function() {
                var player = new EZUIPlayer('myPlayer'+key);
                key++;
            });
            // var player = new EZUIPlayer('myPlayer1');
        });
        function go_select_land() {
            location.href = "<?php echo base_url('front/select/land')?>";
        }
        
        
    </script>