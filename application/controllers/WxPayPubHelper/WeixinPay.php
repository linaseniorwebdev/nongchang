<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include("include/admin.global.php");
require_once(APPPATH . 'controllers/Base.php');
require_once "WxJsPay.php";
require_once "WxPay.pub.config.php";
require_once "WxPayPubHelper.php";


class WeixinPay extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Land_model');
    }

    public function getPayParams()
    {
        $price = $this->input->post('price');
        $land_id = $this->input->post('land_id');

        $member_id = $this->user->getId();
        $create_time = time();
        $this->load->helper('string');

        // order data
        $order_serial = str_replace("-", "", $create_time);
        $order_serial = str_replace(" ", "", $order_serial);
        $order_serial = str_replace(":", "", $order_serial);
        $order_serial = "sx_".$order_serial.random_string('numeric', 3);

        $data['order_owner']  = $member_id;
        $data['order_serial']     = $order_serial;
        $data['order_price']      = $price;
        $data['order_created']    = $create_time;

        $land['owner'] = $member_id;
//        $this->Land_model->update($land_id, $land);

        $openid = $_SESSION['openid'];
        $body = '支付首页';
        $total_fee =  strval(intval($price*100));

//        if($vip_type)
//            $order_serial .= '_'.$member_id.'_vip_'.$vip_type;
//        else
//            $order_serial .= '_'.$member_id.'_chapter_'.$chapter_id;

        $out_trade_no = $order_serial;

        $protocol = "http://";
        if(isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on") $protocol = "https://";
        $notify_url = $protocol.$_SERVER["HTTP_HOST"]."/HTML5/WxPayPubHelper/WeixinPay/wxPayCallBack";

        $jsPay = new WxJsPay();
        $jsApiParameters = $jsPay->getWxPayParam($openid, $body, $out_trade_no, $total_fee, $notify_url);
        echo $jsApiParameters;
    }

    public function wxPayCallBack() {

        //使用通用通知接口
        $notify = new Notify_pub();

        //存储微信的回调
//        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $xml  = file_get_contents("php://input");
        //以log文件形式记录回调信息
        $log_name = "./NotifyCallback.log";//log文件路径

        $this->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");

        $notify->saveData($xml);

        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败");//返回信息
        }else{
            $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
        }
        $returnXml = $notify->returnXml();
        echo $returnXml;

        if($notify->checkSign() == TRUE)
        {
            if ($notify->data["return_code"] == "FAIL") {
                //此处应该更新一下订单状态，商户自行增删操作
                $this->log_result($log_name,"【通信出错】:\n".$xml."\n");
            }
            elseif($notify->data["result_code"] == "FAIL"){
                //此处应该更新一下订单状态，商户自行增删操作
                $this->log_result($log_name,"【业务出错】:\n".$xml."\n");
              //  $this->HomeModel->deleteOrder($_SESSION['order_serial']);
            }
            else{
                //此处应该更新一下订单状态，商户自行增删操作
                $this->log_result($log_name,"【支付成功】:\n".$xml."\n");

                $total_fee = $notify->data["total_fee"];
                $out_trade_no = $notify->data["out_trade_no"];

                $type = explode("_", $out_trade_no);


                $land_id = -1;


                $data['order_price'] = $total_fee/100;
                $data['order_serial'] = 'sx_'.$type[1];
                $data['order_state'] = 1;
                $data['order_updated'] = time();
                $data['order_land_id'] = $land_id;
//                $data['order_owner'] = $member_id;

//                $this->HomeModel->updateOrder($data);
            }
        }
    }
    // 打印log
    function  log_result($file,$word)
    {
        $fp = fopen($file,"a");
        flock($fp, LOCK_EX) ;
        fwrite($fp,"执行日期：".strftime("%Y-%m-%d-%H:%M:%S",time())."\n".$word."\n\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}
?>