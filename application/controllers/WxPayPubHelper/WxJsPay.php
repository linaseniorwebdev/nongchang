<?php

/**
 * JS_API支付demo
 * ====================================================
 * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
 * 成功调起支付需要三个步骤：
 * 步骤1：网页授权获取用户openid
 * 步骤2：使用统一支付接口，获取prepay_id
 * 步骤3：使用jsapi调起支付
*/
include_once("WxPayPubHelper.php");

class WxJsPay
{
	function __construct() {
    }
    
    public function getWxPayParam($openid, $body, $out_trade_no, $total_fee, $notify_url)
    {
        //使用jsapi接口
        $jsApi = new JsApi_pub();

        $unifiedOrder = new UnifiedOrder_pub();
        $unifiedOrder->setParameter("openid","$openid");//商品描述
        $unifiedOrder->setParameter("body","$body");//商品描述
        $unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
        $unifiedOrder->setParameter("total_fee","$total_fee");//总金额
        $unifiedOrder->setParameter("notify_url",$notify_url);//通知地址 
        $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
        $prepay_id = $unifiedOrder->getPrepayId();
        $jsApi->setPrepayId($prepay_id);
        $jsApiParameters = $jsApi->getParameters();

        return $jsApiParameters;
    }
	
}
?>