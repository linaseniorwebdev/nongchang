<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/AlipayService.php';

require_once APPPATH . 'controllers/Base.php';

class Alipay extends Base {

    private $Alipay;

    public function __construct() {
	    parent::__construct();

        $this->Alipay = new AlipayService();
    }

    public function index() {
        echo '';
    }

    public function do_pay($type = 'pc') {
        $code = array(
            'pc'  => 'FAST_INSTANT_TRADE_PAY',
            'wap' => 'QUICK_WAP_WAY'
        );

        $method = array(
            'pc'  => 'alipay.trade.page.pay',
            'wap' => 'alipay.trade.wap.pay'
        );

        if ($this->post_exist()) {
            $orderNO = 'NCP' . uniqid();
            $orderName = $this->input->post('title');
            $orderid = $this->input->post('orderid');
            $ordertp = $this->input->post('ordertp');
            $this->Alipay->setAppid(ALIPAY_APPID); //'2016093000631301'
            $this->Alipay->setReturnUrl(base_url('alipay/do_return/' . $ordertp . '/' . $orderid));
            $this->Alipay->setNotifyUrl(base_url('alipay/do_notify'));
            $this->Alipay->setRsaPrivateKey(ALIPAY_RSA_PRIVATE);
            $this->Alipay->setTotalFee($this->input->post('amount'));
            $this->Alipay->setOutTradeNo($orderNO);
            $this->Alipay->setOrderName($orderName);
            
            $result = $this->Alipay->doPay($code[$type], $method[$type]);
            echo $result;
        } else {
            $this->bad_request();
        }
    }

    public function do_notify() {
        $this->Alipay->setRsaPublicKey(ALIPAY_RSA_PUBLIC);
        $result = $this->Alipay->rsaCheck($_POST);
        if ($result == true) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function do_return($ordertp, $orderid) {
        $this->Alipay->setRsaPublicKey(ALIPAY_RSA_PUBLIC);
        $result = $this->Alipay->rsaCheck($_GET);
        if ($result == true) {
            $this->load->model('Order_model');
            $this->load->model('Land_model');
            if ($ordertp === 'product') {
                $this->Order_model->update_order($orderid, array('status' => 1));
                $order = $this->Order_model->get_order($orderid);
                $land_id = $order->land;
                $db['owner'] = $order->user;
                $db['sold_at'] = date('Y-m-d H:i:s');
                $this->Land_model->update_land($land_id, $db);
                echo '
                    <!DOCTYPE html>
                    <html lang="zh-CN">
                    <head>
                        <meta charset="utf-8" />
                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                        <meta name="viewport" content="width=device-width, initial-scale=1" />
                        <title>  </title>
                    </head>
                    <body>
                        <h1 style="position: fixed; left: 50%; top: 30%; font-size: 2rem; color: #28a745; transform: translateX(-50%);">付款成功。</h1>
                        <a href="' . base_url('member/my_order') . '" style="position: fixed; left: 50%; top: 75%; font-size: 1rem; font-weight: bold; background-color: #007bff; color: white; transform: translateX(-50%); line-height: 2.5rem; padding: 0 15px; border-radius: 30px;">我的订单</a>
                    </body>
                    </html>
                    ';
            } else {
                $this->Order_model->update_order($orderid, array('status' => 3));
                $row = $this->Order_model->get_order($orderid);
                $this->load->model('Land_model');
                $this->Land_model->update_land($row['land'], array('sold_at' => date("Y-m-d H:i:s")));

                echo '
                    <!DOCTYPE html>
                    <html lang="zh-CN">
                    <head>
                        <meta charset="utf-8" />
                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                        <meta name="viewport" content="width=device-width, initial-scale=1" />
                        <title>  </title>
                    </head>
                    <body>
                        <h1 style="position: fixed; left: 50%; top: 30%; font-size: 2rem; color: #28a745; transform: translateX(-50%);">付款成功。</h1>
                        <a href="' . base_url('member/my_land') . '" style="position: fixed; left: 50%; top: 75%; font-size: 1rem; font-weight: bold; background-color: #007bff; color: white; transform: translateX(-50%); line-height: 2.5rem; padding: 0 15px; border-radius: 30px;">我的土地</a>
                    </body>
                    </html>
                    ';
            }
        } else {
            echo '
            <!DOCTYPE html>
            <html lang="zh-CN">
            <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <title>  </title>
            </head>
            <body>
                <h1 style="position: fixed; left: 50%; top: 30%; font-size: 2rem; color: #dc3545; transform: translateX(-50%);">不合法的请求</h1>
                <a href="' . base_url('/') . '" style="position: fixed; left: 50%; top: 75%; font-size: 1rem; font-weight: bold; background-color: #007bff; color: white; transform: translateX(-50%); line-height: 2.5rem; padding: 0 15px; border-radius: 30px;">首页</a>
            </body>
            </html>
            ';
        }
    }
}