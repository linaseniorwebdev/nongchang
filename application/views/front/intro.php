<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background-color: #f5f5f5;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;max-width: 37.5rem;background-color: #f8f8f8;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_back()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;">项目介绍</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-bottom: 45px;margin-top: 45px;">
            <div class="row mt-0 ml-0 mr-0 p-0" style="background-color: white;border-bottom:8px solid #f5f5f5;">
                <img src="public/img/intro/raw_1534873039.png" style="width: 100%;height: 100%;">
                <img src="public/img/intro/raw_1534873085.png" style="width: 100%;height: 100%;">
            </div>


        </div>
    </div>

    <script>

        $(document).ready(function(){

            adjustImage();
        });

        $( window ).resize(function() {
            adjustImage();
        });

        function adjustImage(){
            //  var W = $(window).width();
            //  var img_H = W * 200 / 375;
            //  $('#header-img1').css({"height": img_H});
            // $('#header-img2').css({"height": img_H});
            // $('#header-img3').css({"height": img_H});
        }
    </script>