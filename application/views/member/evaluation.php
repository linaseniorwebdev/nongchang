
<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: white;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #f5f5f5;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <div style="width: 20px;height: 30px;position:absolute;left: 0;top: 0;margin-top: 6px;margin-left: 10px;">
                        <span onclick="go_my_order()" class="mdi mdi-chevron-left mdi-24px"></span>
                    </div>
                    <span class="top_title_text">发表评价</span>
                    <div style="width: 30%;position:absolute;right: 0;height: 25px;top: 10px;color: orange;font-size: 15px;">
                        <span onclick="submit_evaluation(<?php echo $order_id;?>)">发布</span>
                    </div>

                </div>
            </div>
        </div>
        <div class="content-body" style="margin-top: 45px;">
            <div class="row m-0" style="padding: 5px !important;border-bottom: 1px solid #bbbbbb;">
                <div style="width: 25%;float: left;text-align: center;line-height:33.6px;">
                    <span>描述相符</span>
                </div>
                <div style="width: 50%;float: left;text-align: center;">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="star-rating">
                            <span class="mdi mdi-star-outline match" data-rating="1"></span>
                            <span class="mdi mdi-star-outline match" data-rating="2"></span>
                            <span class="mdi mdi-star-outline match" data-rating="3"></span>
                            <span class="mdi mdi-star-outline match" data-rating="4"></span>
                            <span class="mdi mdi-star-outline match" data-rating="5"></span>
                            <input type="hidden" name="whatever1" id="match_val" class="rating-value1" value="1">
                          </div>
                        </div>
                    </div>
                </div>
                <div style="width: 25%;float: left;text-align: center;line-height:33.6px;">
                    <span>非常好</span>
                </div>
            </div>
            <div class="row m-0 p-0" style="border-bottom: 4px solid #f5f5f5;">
                <textarea id="evaluation_content" style="width: 100%;height: 100px;padding: 5px 10px;border: none;" placeholder="宝贝满足你的期待吗？说说它的优点和美中不足的地方吧"></textarea>
            </div>
            <!-- <div class="row m-0" style="padding: 10px !important;">
                <div style="width: 100%;font-size: 15px;color: black;">
                    <span>店铺评分</span>
                </div>
                <div style="width: 100%;">
                    <div class="row m-0">
                        <div style="width: 25%;float: left;line-height: 33.6px;">
                            <span>物流服务</span>
                        </div>
                        <div style="width: 75%;float: left;">
                            <div class="row">
                                <div class="col-lg-12">
                                  <div class="star-rating">
                                    <span class="mdi mdi-star-outline logistic" data-rating="1"></span>
                                    <span class="mdi mdi-star-outline logistic" data-rating="2"></span>
                                    <span class="mdi mdi-star-outline logistic" data-rating="3"></span>
                                    <span class="mdi mdi-star-outline logistic" data-rating="4"></span>
                                    <span class="mdi mdi-star-outline logistic" data-rating="5"></span>
                                    <input type="hidden" name="whatever1" id="logistic_val" class="rating-value2" value="1">
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 100%;">
                    <div class="row m-0">
                        <div style="width: 25%;float: left;line-height: 33.6px;">
                            <span>服务态度</span>
                        </div>
                        <div style="width: 75%;float: left;">
                            <div class="row">
                                <div class="col-lg-12">
                                  <div class="star-rating">
                                    <span class="mdi mdi-star-outline attitude" data-rating="1"></span>
                                    <span class="mdi mdi-star-outline attitude" data-rating="2"></span>
                                    <span class="mdi mdi-star-outline attitude" data-rating="3"></span>
                                    <span class="mdi mdi-star-outline attitude" data-rating="4"></span>
                                    <span class="mdi mdi-star-outline attitude" data-rating="5"></span>
                                    <input type="hidden" name="whatever1" id="attitude_val" class="rating-value3" value="1">
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        
    </div>
</div>

<style>
    .star-rating {
      line-height:32px;
      font-size:2em;
    }

    .star-rating .mdi-star{color: yellow;}
</style>
<script>
    var $star_rating1 = $('.star-rating .match');
    var SetRatingStar1 = function() {
      return $star_rating1.each(function() {
        if (parseInt($star_rating1.siblings('input.rating-value1').val()) >= parseInt($(this).data('rating'))) {
          return $(this).removeClass('mdi-star-outline').addClass('mdi-star');
        } else {
          return $(this).removeClass('mdi-star').addClass('mdi-star-outline');
        }
      });
    };
    $star_rating1.on('click', function() {
      $star_rating1.siblings('input.rating-value1').val($(this).data('rating'));
      return SetRatingStar1();
    });
    SetRatingStar1();


    // var $star_rating2 = $('.star-rating .logistic');
    // var SetRatingStar2 = function() {
    //   return $star_rating2.each(function() {
    //     if (parseInt($star_rating2.siblings('input.rating-value2').val()) >= parseInt($(this).data('rating'))) {
    //       return $(this).removeClass('mdi-star-outline').addClass('mdi-star');
    //     } else {
    //       return $(this).removeClass('mdi-star').addClass('mdi-star-outline');
    //     }
    //   });
    // };
    // $star_rating2.on('click', function() {
    //   $star_rating2.siblings('input.rating-value2').val($(this).data('rating'));
    //   return SetRatingStar2();
    // });
    // SetRatingStar2();



    // var $star_rating3 = $('.star-rating .attitude');
    // var SetRatingStar3 = function() {
    //   return $star_rating3.each(function() {
    //     if (parseInt($star_rating3.siblings('input.rating-value3').val()) >= parseInt($(this).data('rating'))) {
    //       return $(this).removeClass('mdi-star-outline').addClass('mdi-star');
    //     } else {
    //       return $(this).removeClass('mdi-star').addClass('mdi-star-outline');
    //     }
    //   });
    // };
    // $star_rating3.on('click', function() {
    //   $star_rating3.siblings('input.rating-value3').val($(this).data('rating'));
    //   return SetRatingStar3();
    // });
    // SetRatingStar3();

    $(document).ready(function() {
        
    } );
    
    
    function submit_evaluation(order_id) {
        var evaluation_content = $('#evaluation_content').val();
        var match = $('#match_val').val();
        // var logistic = $('#logistic_val').val();
        // var attitude = $('#attitude_val').val();
        if (evaluation_content.length < 1) {
            swal('警告', '请输入评评价内容。', 'warning');
            return;
        }
        $.post("<?php echo base_url('member/give_evaluation') ?>",
             {order_id:order_id, note:evaluation_content, rating:match},
            function (data) {
                var result = JSON.parse(data);
                if (result.state == "success") {
                    location.href = '<?php echo base_url ('member/my_order'); ?>';
                }
                else{
                    swal("提示", result.reason, "warning");
                }
            }
        );
    }
   
    function go_my_order() {
        location.href = '<?php echo base_url ('member/my_order'); ?>';
    }

</script>