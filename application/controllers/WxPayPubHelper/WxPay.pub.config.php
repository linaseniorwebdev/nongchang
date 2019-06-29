<?php

/**
* 	配置账号信息
*/

class WxPayConf_pub
{
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = 'wx40d1a3b4f4d36e6e';
	//受理商ID，身份标识
	const MCHID = '1498859662';
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = 'shuxueshuxueshuxueshuxueshuxue88';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = '0b4d6e41b4e703b6688da5b7abee4cce';
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = 'cert/apiclient_cert.pem';
	const SSLKEY_PATH = 'cert/apiclient_key.pem';
//    const SSLROOTCA_PATH = '/home/wwwroot/fotoask.fotomen.cn/ThinkPHP/Library/Vendor/WxPayPubHelper/cacert/rootca.pem';
	
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定


	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}
	
?>