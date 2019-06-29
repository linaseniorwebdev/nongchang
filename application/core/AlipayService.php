<?php

class AlipayService {

	protected $appId;           // App ID
	protected $charset;         // Default Charset
	protected $notifyUrl;       // URL, to where notification can be sent
	protected $orderName;       // Order Name
	protected $outTradeNo;      // Order Number
	protected $returnUrl;       // URL, to where can redirect after success
	protected $rsaPrivateKey;   // RSA Private Key
	protected $rsaPublicKey; 	// RSA Public Key
	protected $totalFee;        // Pay Amount (Unit CNY)

	public function __construct() {
		$this->charset = 'utf8';
	}

	public function setAppid($appid) {
		$this->appId = $appid;
	}

	public function setReturnUrl($returnUrl) {
		$this->returnUrl = $returnUrl;
	}

	public function setNotifyUrl($notifyUrl) {
		$this->notifyUrl = $notifyUrl;
	}

	public function setRsaPrivateKey($rsaPrivateKey) {
		$this->rsaPrivateKey = $rsaPrivateKey;
	}

	public function setRsaPublicKey($rsaPublicKey) {
		$this->rsaPublicKey = $rsaPublicKey;
	}

	public function setTotalFee($payAmount) {
		$this->totalFee = $payAmount;
	}

	public function setOutTradeNo($outTradeNo) {
		$this->outTradeNo = $outTradeNo;
	}

	public function setOrderName($orderName) {
		$this->orderName = $orderName;
	}

	public function doPay($code, $method) {
		$requestConfigs = array(
			'out_trade_no'  => $this->outTradeNo,
			'product_code'  => $code,
			'total_amount'  => $this->totalFee,
			'subject'       => $this->orderName,
		);

		$commonConfigs = array(
			'app_id'        => $this->appId,
			'method'        => $method,
			'format'        => 'JSON',
			'return_url'    => $this->returnUrl,
			'charset'       => $this->charset,
			'sign_type'     => 'RSA2',
			'timestamp'     => date('Y-m-d H:i:s'),
			'version'       => '1.0',
			'notify_url'    => $this->notifyUrl,
			'biz_content'   => json_encode($requestConfigs),
		);

		$commonConfigs['sign'] = $this->generateSign($commonConfigs, $commonConfigs['sign_type']);
		return $this->buildRequestForm($commonConfigs);
	}

	protected function buildRequestForm($para_temp) {

		$sHtml = '
        <!DOCTYPE html>
        <html lang="zh-CN">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>  </title>
        </head>
        <body>
            <h1 style="position: fixed; left: 50%; top: 30%; font-size: 1.1rem; color: #007bff; transform: translateX(-50%) translateY(-50%);">正在跳转至支付页面...</h1>
        </body>
        </html>
        <form id="alipaysubmit" name="alipaysubmit" action="https://openapi.alipay.com/gateway.do?charset=' . $this->charset . '" method="POST">';
//https://openapi.alipaydev.com/gateway.do
		foreach($para_temp as $key => $val){
			if (false == $this->checkEmpty($val)) {
				$val = str_replace("'", '&apos;', $val);
				$val = str_replace("\"", '&quot;', $val);
				$sHtml .= '<input type="hidden" name="' . $key . '" value="' . $val . '"/>';
			}
		}

		$sHtml .= '<input type="submit" value="ok" style="display: none;" /></form>';
		$sHtml .= '<script>document.forms["alipaysubmit"].submit();</script>';

		return $sHtml;
	}

	public function generateSign($params, $signType = 'RSA') {
		// echo $this->getSignContent($params);
		// exit();
		return $this->sign($this->getSignContent($params), $signType);
	}

	protected function sign($data, $signType = 'RSA') {
		$priKey = $this->rsaPrivateKey;
		$res = "-----BEGIN RSA PRIVATE KEY-----\n" . chunk_split($priKey, 64, "\n") . "-----END RSA PRIVATE KEY-----\n";
		$res or die('您使用的私钥格式错误，请检查RSA私钥配置');
		if ('RSA2' == $signType) {
			openssl_sign($data, $sign, $res, "SHA256");
		} else {
			openssl_sign($data, $sign, $res);
		}
		$sign = base64_encode($sign);
		return $sign;
	}

	protected function checkEmpty($value) {
		if (!isset($value)) {
			return true;
		}

		if ($value == null) {
			return true;
		}

		if (trim($value) == '') {
			return true;
		}

		return false;
	}

	public function getSignContent($params) {
		ksort($params);

		$stringToBeSigned = '';
		$i = 0;

		foreach ($params as $k => $v) {
			if (false == $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
				$v = $this->characet($v, $this->charset);
				if ($i == 0) {
					$stringToBeSigned .= $k . "=" . $v;
				} else {
					$stringToBeSigned .= "&" . $k . "=" . $v;
				}
				$i++;
			}
		}

		return $stringToBeSigned;
	}

	private function characet($data, $targetCharset) {
		if (!empty($data)) {
			$fileType = $this->charset;
			if (strcasecmp($fileType, $targetCharset) != 0) {
				$data = mb_convert_encoding($data, $targetCharset, $fileType);
			}
		}
		return $data;
	}

	public function rsaCheck($params) {
		$sign = $params['sign'];
		$signType = $params['sign_type'];
		unset($params['sign_type'], $params['sign']);
		return $this->verify($this->getSignContent($params), $sign, $signType);
	}

	private function verify($data, $sign, $signType = 'RSA') {
		$pubKey= $this->rsaPublicKey;
		$res = "-----BEGIN PUBLIC KEY-----\n" . chunk_split($pubKey, 64, "\n") . "-----END PUBLIC KEY-----\n";
		$res or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');

		if ('RSA2' == $signType) {
			$result = (bool)openssl_verify($data, base64_decode($sign), $res, "SHA256");
		} else {
			$result = (bool)openssl_verify($data, base64_decode($sign), $res);
		}

		return $result;
	}
}
