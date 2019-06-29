<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background-color: #ffffff;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;max-width: 37.5rem; background-color: #ffffff;border-bottom: 2px solid #F5F5F5;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_index()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;">我的店铺</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="width: 100%;margin-top: 45px;position: absolute;bottom: 0;top: 0;overflow-y: scroll;">

            <div class="row ml-0 mr-0" style="width: 100%;height: 70px;background: white;padding-top: 15px;">

                <div style="width: 25%;height: 30px;line-height: 30px;text-align: center;">
                    <span class="text15_regular black444">类别：</span>
                </div>
                <div style="width: 75%;height: 40px;text-align: center;">
                    <select name="type" id="type" class="form-control" style="width: 90%;height: 30px;vertical-align: middle;margin-left: auto;margin-right: auto;">
                        <?php if (isset($types)){ foreach ($types as $key => $type){?>
                            <option value="<?php echo $type['id']?>"><?php echo $type['name']?></option>
                        <?php }}?>
                    </select>
                </div>
            </div>
            <div id="products" style="width: 100%">
                <?php if (count($products) > 0){ foreach ($products as $product){ ?>
                <div class="row" style="border-bottom: 6px solid #F5F5F5;padding: 5% 0 5% 0;margin: 0 1%;" onclick="go_product_detail(<?php echo $product['id']; ?>)">
                    <div class="col-sm-5" style="text-align: center;width: 41.66667%;">
                        <img src="<?php echo base_url($product['image']); ?>" style="width: 100%;">
                    </div>
                    <div class="col-sm-7" style="width: 58.33333%;">
                        <p class="text14_regular black444">产品名称：<?php echo $product['name']; ?></p>
                        <p class="text14_regular black999" style="margin: 10% 0;">规模：<span class="red_text15"><?php echo $product['scale'];?></span><?php echo $units[$product['unit']]; ?></p>
                        <p class="text14_regular black999" style="margin: 12% 0;">价格：<span class="red_text15">¥<?php echo $product['price']?></span></p>
                        <p class="text14_regular black999" style="margin: 10% 0;">库存：<span class="red_text15"><?php echo $product['stock'];?></span></p>
                    </div>
                </div>
                <?php }
                }else{?>
                    <div style="width: 100%;text-align: center;"><h3>没有产品</h3></div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        } );

        ///////////////    load cities by selected province     //////////////
        $("#type").change(function() {
            var type = $("#type").val();
            $.post("<?php echo base_url('member/my_products') ?>", {type: type},
                function (data) {
                    var result = JSON.parse(data);
                    if (result.status == "success") {
                        var selected_products = result['products'];
                        var units = result['units'];
                        var html = '';
                        if (selected_products.length > 0){
                            for (var i=0; i<selected_products.length; i++){
                                var product = selected_products[i];
                                var num = product['unit'];
                                html += '<div class="row" style="border-bottom: 6px solid #F5F5F5;padding: 5% 0 5% 0;margin: 0 1%;" onclick="go_product_detail('+ product['id'] +')">';
                                html += '<div class="col-sm-5" style="text-align: center;width: 41.66667%;">';
                                html += '<img src="../'+ product['image'] +'" style="width: 100%;">';
                                html += '</div>';
                                html += '<div class="col-sm-7" style="width: 58.33333%;">';
                                html += '<p class="text14_regular black444">产品名称：'+ product['name'] +'</p>';
                                html += '<p class="text14_regular black999" style="margin: 10% 0;">规模：<span class="red_text15">'+ product['scale']+ '</span>' + units[num] +'</p>';
                                html += '<p class="text14_regular black999" style="margin: 12% 0;">价格：<span class="red_text15">¥'+ product['price'] +'</span></p>';
                                html += '<p class="text14_regular black999" style="margin: 10% 0;">库存：<span class="red_text15">'+ product['stock'] +'</span></p>';
                                html += '</div>';
                                html += '</div>';
                            }
                        }
                        else{
                            html += '<div style="width: 100%;text-align: center;"><h3>没有产品</h3></div>';
                        }
                        $('#products').html(html);

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
        });


        function go_product_detail(id) {

        }
        function go_index() {
            location.href = "<?php echo base_url('member')?>";
        }
    </script>