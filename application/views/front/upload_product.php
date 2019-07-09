<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background: #F7F7F7;">
    <div class="content-wrapper" style="padding: 0;background: white;">
        <div class="content-header row m-0" style="max-width: 37.5rem;width:100%;height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px;background-color: #ffffff;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_task()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span class="top_title_text" style="margin-left: -34px;">上传产品</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body" style="margin-bottom: 60px;margin-top: 45px;">
                <div style="width: 100%;height: 230px;text-align: center;padding: 20px 4%;border-top: 3px solid #F7F7F7;">
                    <p class="text15_regular black444 m-0 p-0" style="text-align: left;height: 20px;">产品图片：</p>
                    <input type="file" accept="image/*" id="select_img" onchange="select_product(this)" style="width: 180px;height: 150px;position: absolute;opacity: 0;">
                    <img id="product_img" src="public/img/empty.png" style="width: 180px;height: 150px;background-size: 100% 100%;">
                </div>
                <div style="width: 100%;padding: 0 4%;">
                    <div class="row m-0 p-0 text15_regular">
                        <span class="black444">产品详情图：</span>
                    </div>
                    <div class="row mt-1 ml-0 mr-0">  
                        <!-- <img class="detail_img" id="small_product_img" src="public/img/empty.png" style="display: none;">  -->
                        <div class="new_detail_img" id="new_detail_img" style="margin-left: 5px;margin-top: 5px;">
                            <input type="file" accept="image/*" id="select_detail_img" onchange="select_detail_img(this)" style="width: 106px;height: 85px;position: absolute;opacity: 0;">
                            <img id="product_detail_img" src="public/img/empty.png" style="width: 106px;height: 85px;background-size: 100% 100%;">
                        </div>
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;margin-top: 10px;border-top: 3px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">选择土地：</span>
                        <select name="land" id="land" class="form-control" style="width: 70%;height: 40px;vertical-align: middle;margin-left: auto;margin-right: auto;margin-top: 5px;">
                            <?php if (isset($lands)){ foreach ($lands as $key => $land){?>
                                <option value="<?php echo $land['id']?>"><?php echo $land['landnum']?></option>
                            <?php }}?>
                        </select>
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-bottom: 2px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">产品名称：</span>
                        <input type="text" class="text14_regular text_placeholder" id="product_name" name="product_name" placeholder="请输入产品名称" style="width: 75%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-bottom: 1px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%">类别：</span>
                        <select name="type" id="type" class="form-control" style="width: 70%;height: 40px;vertical-align: middle;margin-left: auto;margin-right: auto;margin-top: 5px;">
                            <?php if (isset($types)){ foreach ($types as $key => $type){?>
                                <option value="<?php echo $type['id']?>"><?php echo $type['name']?></option>
                            <?php }}?>
                        </select>
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-top: 1px solid #F7F7F7;border-bottom: 1px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%;">规模：</span>
                        <input type="text" class="text14_regular text_placeholder" id="scale" name="scale" placeholder="请输入规模" style="width: 50%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                        <select name="unit" id="unit" class="form-control" style="width: 25%;height: 40px;vertical-align: middle;margin-left: auto;margin-right: auto;margin-top: 5px;">
                            <?php if (isset($units)){ foreach ($units as $key => $unit){?>
                                <option value="<?php echo $unit['id']-1;?>"><?php echo $unit['name']?></option>
                            <?php }}?>
                        </select>
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-top: 1px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%">价格：</span>
                        <input type="text" class="text14_regular text_placeholder" id="price" name="price" placeholder="请输入价格" style="width: 50%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                        <span class="blackAAA">元</span>
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-top: 1px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%">库存：</span>
                        <input type="number" class="text14_regular text_placeholder" id="stock" name="stock" placeholder="请输入库存" style="width: 50%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                        <span class="blackAAA">件</span>
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-top: 1px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 50px;line-height: 50px;">
                        <span class="black444" style="width: 25%">运费：</span>
                        <input type="number" class="text14_regular text_placeholder" id="delivery" name="stock" placeholder="请输入运费" style="width: 50%;border: none;height: 50px;padding: 5px 10px;outline: 0;">
                        <span class="blackAAA">¥</span>
                    </div>
                </div>
                <div style="width: 100%;padding: 0 4%;border-top: 1px solid #F7F7F7;border-bottom: 2px solid #F7F7F7;">
                    <div class="row m-0 p-0 text15_regular" style="height: 100px;line-height: 50px;">
                        <span class="black444" style="width: 25%">产品详情：</span>
                        <textarea type="text" class="text14_regular text_placeholder" id="detail" name="detail" placeholder="请输入产品详情" style="width: 75%;border: none;height: 70px;padding: 5px 10px;outline: 0;resize: none;margin-top: 12px;"></textarea>
                    </div>
                </div>
            </div>
            <div class="footer" style="max-width: 37.5rem;width: 100%;height: 60px;position: fixed;bottom: 0;border-color: transparent;background: #F7F7F7;border-top: 3px solid #F5F5F5;line-height: 54px;text-align: center;">
                <button type="button" onclick="upload_product()" class="text16_regular whiteFFF" style="width: 90%;height: 42px;background: #90C549;border-radius: 8px;border: none;">上传</button>
            </div>

        <input type="hidden" id="return_submit" value="<?php if (isset($result)) echo $result; ?>">
        <input type="hidden" id="apply_status" value="<?php if (isset($apply)) echo $apply['status']; ?>">
    </div>
    <!--   crop photo     //////-->
    <div id="back_modal" style="display: none;max-width: 37.5rem;width: 100%; height: 100%;background-color: grey;position: fixed;top: 0;">
        <div id="crop_div" style="max-width: 37.5rem;width: 100%;height: 270px;margin-top: 48px; background-color: #cccccc;text-align: center;">
            <img id="orign_img" src="" style="width: 100%;height: 80%;background-size: 100% 100%;background-position: center;">
            <button onclick="confirm_crop_img()" class="btn btn-info" style="margin-top: 10%">确认</button>
        </div>
    </div>
</div>
<style>

</style>
<script>
    $(document).ready(function () {
        var apply_status = $('#apply_status').val();
        var return_submit = $('#return_submit').val();
        if (apply_status == '0') {
            $('#back_modal').css('display', 'block');
            swal({title: "提示",text: "正在审核中。",type: "error", confirmButtonText: "确认"})
                .then(function(e) {
                    if (e) {
                        $('#back_modal').css('display', 'none');
                        go_task();
                    }
                });
        }

    });
    function go_task() {
        location.href = '<?php echo base_url ('front/task'); ?>';
    }
    var dataURL = '';
    var detailURL = [];
    var product_or_detail = 0;
    function select_product(input){
        product_or_detail = 0;
        $('#back_modal').css('display', 'block');
        $('#orign_img').cropper("destroy");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // $('#orign_img').css("background-image", 'url(' + e.target.result + ')');
                // $('#orign_img').attr('src', e.target.result);
                $('#orign_img').prop('src', e.target.result);
                $("#orign_img").cropper({
                    viewMode: 1,
                    aspectRatio: 24/20
                });
            };
            reader.readAsDataURL(input.files[0]);

        }
    }
    var detail_img_cnt = -1;
    function select_detail_img(input){
        product_or_detail = 1;
        $('#back_modal').css('display', 'block');
        $('#orign_img').cropper("destroy");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // $('#orign_img').css("background-image", 'url(' + e.target.result + ')');
                // $('#orign_img').attr('src', e.target.result);
                $('#orign_img').prop('src', e.target.result);
                $("#orign_img").cropper({
                    viewMode: 1,
                    aspectRatio: 24/20
                });
            };
            reader.readAsDataURL(input.files[0]);

        }
    }
    function confirm_crop_img() {
        var cropper = $("#orign_img").data('cropper');
        var imageCanvas = cropper.getCroppedCanvas();
        if (product_or_detail == 0) {
            dataURL = imageCanvas.toDataURL();
            $('#product_img').attr('src',  dataURL);
            // $('#small_product_img').css('display', 'block');
            // $('#small_product_img').attr('src', dataURL);
        }
        else{
            detail_img_cnt++;
            console.log(detail_img_cnt);
            detailURL[detail_img_cnt] = imageCanvas.toDataURL();
            var divReference = document.querySelector('#new_detail_img');      
            var divToCreate = document.createElement('img');
            divToCreate.setAttribute("class", "detail_img");
            divToCreate.setAttribute("id", "detail_img" + detail_img_cnt);
            divToCreate.setAttribute("src", detailURL[detail_img_cnt]);
            divReference.parentNode.insertBefore(divToCreate, divReference);          
        }
        $('#back_modal').css('display', 'none');
    }

    function upload_product() {
        var land = $('#land').val();
        var product_name = $('#product_name').val();
        var type = $('#type').val();
        var scale = $('#scale').val();
        var unit = $('#unit').val();
        var stock = $('#stock').val();
        var price = $('#price').val();
        var delivery = $('#delivery').val();
        var detail = $('#detail').val();
        if (dataURL == ''){
            swal({title: "警告",text: "请选择产品图片。", icon: "warning", cancelButtonText: "确认"});
            return;
        }
        if (product_name.length < 1) {
            swal({title: "警告",text: "请输入产品名称。", icon: "warning",confirmButtonText: "确认"});
            return;
        }
        if (scale.length < 1){
            swal({title: "警告",text: "请输入规模。", icon: "warning",confirmButtonText: "确认"});
            return;
        }
        if (price.length < 1){
            swal({title: "警告",text: "请输入价格。", icon: "warning",confirmButtonText: "确认"});
            return;
        }
        if (stock.length < 1){
            swal({title: "警告",text: "请输入库存。", icon: "warning",confirmButtonText: "确认"});
            return;
        }
        if (delivery.length < 1){
            swal({title: "警告",text: "请输入运费。", icon: "warning",confirmButtonText: "确认"});
            return;
        }
        if (detail.length < 1){
            swal({title: "警告",text: "请输入产品详情。", icon: "warning",confirmButtonText: "确认"});
            return;
        }
        var formData = new FormData();
        formData.append("picture", dataURL);
        formData.append("detail_img", JSON.stringify(detailURL));
        formData.append('land', land);
        formData.append("name", product_name);
        formData.append("type", type);
        formData.append("price", price);
        formData.append("scale", scale);
        formData.append("unit", unit);
        formData.append("stock", stock);
        formData.append("delivery", delivery);
        formData.append("detail", detail);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('front/upload_product') ?>",

            success: function (data) {
                data = JSON.parse(data);
                console.log(data.product_id);
                console.log(data.img_id);
                if (data.status == "success") {
                    swal({icon: "success",text: "上传成功！",type: "success", confirmButtonText: "确认"})
                        .then(function(e) {
                            if (e) {
                                location.reload();
                            }
                        });
                } else {
                    if (data.sms == 'wrong') swal({title: "警告",text: "验证码错误。",type: "error", confirmButtonText: "确认"});
                    else if (data.phone == 'exist') swal({title: "警告",text: "手机号码已经存在，请输入另一个手机号码。",type: "error", confirmButtonText: "确认"});
                    else swal({title: "错误",text: "出了点问题。 请稍后再试。",type: "error", confirmButtonText: "确认"});
                }
            },
            error: function (error) {
                console.log('error');
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });

    }

</script>