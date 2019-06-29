<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="public/custom/js/scripts.js"></script>
<script src="public/vendors/js/extensions/cropper.min.js"></script>
<script src="https://open.ys7.com/sdk/js/1.4/ezuikit.js"></script>
<script>
    function go_back() {
        history.back();
    }

    function callPay(price, land_id) {
        console.log(price);

        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                console.log("oooo");
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            } else if (document.attachEvent) {
                console.log("kkkkk");
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        } else {
            jsApiCall(price, land_id);
        }
    }

    function jsApiCall(price, land_id) {
        console.log("jsApiCall");
        var param = {
            'price':price,
            'land_id':land_id
        };

        $.post('<?php echo base_url('WxPayPubHelper/WeixinPay/getPayParams') ?>', param,
            function (data) {
                WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',
//                    data,
                    JSON.parse(data),
                    function(res){
                        WeixinJSBridge.log(res.err_msg);
                        if(res.err_msg == 'get_brand_wcpay_request:ok'){
                            swal({
                                title: "操作成功",
                                text: "",
                                icon: "success",
                                buttons: ["确认"],
                            }).then(function(e) {
                                if (e) {
                                    go_back();
                                }
                            });
                        }else if(res.err_msg == 'get_brand_wcpay_request:cancel'){
                            swal("操作失败","","warning");
                        }else{
                            swal("操作失败","","warning");
                        }
                    }
                );
            }
        );
    }

    
</script>
</body>

</html>