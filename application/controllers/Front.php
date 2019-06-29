<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/WxPayPubHelper/WxPay.pub.config.php';
require_once APPPATH . 'controllers/Base.php';

class Front extends Base {
    /**
     * Weixin Pay
     **/
    public function pre() {
        $appid = WxPayConf_pub::APPID;
        $_SERVER['HTTP_HOST'] = '192.168.8.113';
        $redirect_uri = urlencode('http://' . $_SERVER['HTTP_HOST'] . '/Front/getUserOpenId');
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $this->createTxt('appid：' . $appid . "\n");
        redirect($url);
    }

    public function getUserOpenId() {
        $appid = WxPayConf_pub::APPID;
        $appsecret = WxPayConf_pub::APPSECRET;
        $code = $_GET['code'];
        $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $response_json = $this->curl_init($get_token_url);
        $res_token = $response_json;
        $openid = '';
        $access_token = '';
        if(isset($res_token['openid'])) $openid = $res_token['openid'];
        if(isset($res_token['access_token'])) $access_token = $res_token['access_token'];

        $get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid. '&lang=zh_CN';
        $response_json2 = $this->curl_init($get_user_info_url);
        $res_user_info = $response_json2;

        $nickname = '';
        $headimgurl = '';
        if(isset($res_user_info['nickname'])) $nickname = $res_user_info['nickname'];
        if(isset($res_user_info['headimgurl'])) $headimgurl = $res_user_info['headimgurl'];
        if(isset($res_user_info['sex'])){
            $sex = $res_user_info['sex'];
            $_SESSION['sex'] = $sex;
        }

        $_SESSION['openid'] = $openid;
        $_SESSION['headimgurl'] = $headimgurl;
        $_SESSION['nickname'] = $nickname;


        $this->createTxt('微信昵称：' . $nickname . '，openID: ' . $openid . "\n");
        $this->index();
    }

    public function curl_init($token_url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $token_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $token = curl_exec($ch);
        curl_close($ch);
	    return json_decode($token, true);
    }

    public function createTxt($cont, $file_path = 'openid.txt', $caseSensitive = 0){
        // 有则打开，无则创建
        $myfile = fopen($file_path, 'ab+') or die('Unable to open file!');
        if( filesize($file_path) === 0 ){ // 直接写
            fwrite($myfile, $cont);
            //die;
        }else{ // 先比对有无重复的内容
            $fp  = fopen($file_path, 'rb');
            $str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
            // Output in your browser
            //echo $str = str_replace("\r\n","<br />",$str);die;
            if($caseSensitive){
                $res = strpos($str,$cont);    // 判断target第一次出现的位置
            }else{
                $res = stripos($str,$cont);    // 判断target第一次出现的位置
            }
            // 如果为false，则没有， 0,1,2 都表示有
            if($res===false){
                fwrite($myfile, $cont);
            }
        }
        fclose($myfile);
    }

	/**
	 * Main Page
	 **/
	public function index() {
	    $this->load->model('Product_model');
	    $data['products'] = $this->Product_model->get_all_available();
        $this->load->model('Land_model');
        $data['lands'] = array();
        $land1 = $this->Land_model->get_land(5);
        $land2 = $this->Land_model->get_land(8);
        $data['lands'][] = $land1;
        $data['lands'][] = $land2;
		$this->load_header('首页');
		$this->load->view('front/index', $data);
		$this->load_footer();
	}

	/**
	 * Introduction Page
	 **/
	public function intro() {
		$this->load_header('项目介绍');
		$this->load->view('front/intro');
		$this->load_footer();
	}

	/**
	 * Area, Land Selection Page (for buy/check)
	 * @param string $command
	 * @param null $block_id
	 */
	public function select($command = 'area', $block_id = null) {
			if ($command === 'area') {
                $data = array();
                $this->load->model('Province_model');
                $this->load->model('Blocks_model');
                $provinces = $this->Province_model->get_all_provinces();
                foreach ($provinces as &$province) {
                    $rows = $this->Blocks_model->list_blocks($province['id']);
                    $province['count'] = count($rows);
                }
                $data['provinces'] = $provinces;
                $data['selected_areas'] = $this->Blocks_model->list_blocks(10);
				$this->load_header('选择区域');
				$this->load->view('front/select_area', $data);
				$this->load_footer();
			} elseif ($command === 'land') {
                $this->load->model('Land_model');
                $data['block_id'] = $block_id;
                $data['lands'] = $this->Land_model->get_block_lands($block_id, 1);
				$this->load_header('认购农场');
				$this->load->view('front/select_land', $data);
				$this->load_footer();
			}
	}

	public function selected_areas() {
        $data = array();
        try {
            $province = $this->input->post('province');
            $city = $this->input->post('city');
            $district = $this->input->post('district');
            $this->load->model('Blocks_model');
            $data['selected_areas'] = $this->Blocks_model->list_blocks($province, $city, $district);
            $data['status'] = 'success';
        }
        catch (Exception $exc) {
                $data['status'] = 'fail';
            }

        echo json_encode($data);
    }

    public function selected_lands() {
        $data = array();
        try {
            $block_id = $this->input->post('block_id');
            $land_type = $this->input->post('land_type');
            $this->load->model('Land_model');
            $data['lands'] = $this->Land_model->get_block_lands($block_id, $land_type);
            $data['status'] = 'success';
        }
        catch (Exception $exc) {
            $data['status'] = 'fail';
        }

        echo json_encode($data);
    }

	/**
	 * Land Detail Page
	 * @param null $land_id
	 */
    public function real_scene($land_id = null) {
        $this->load->model('Land_model');
        $this->load->model('Bindings_model');
        $land = $this->Land_model->get_land($land_id);
        $channels = $this->Bindings_model->get_bindings_by_land($land_id);
        if ($channels) {
            $land['has_camera'] = true;
            $land['channel'] = $channels[0];
        } else {
            $land['has_camera'] = false;
        }
	    $this->load_header('实景');
	    $this->load->view('front/real_scene', array('land' => $land));
	    $this->load_footer();
    }

	/**
	 *Land Confirm payment Page
	 * @param null $land_id
	 */
    public function confirm_pay($land_id = null) {
        if ($this->login) {
            $this->load->model('Land_model');
            $land = $this->Land_model->get_land($land_id);
            $this->load_header('确认支付');
            $this->load->view('front/confirm_pay', array('land' => $land));
            $this->load_footer();
        } else {
	        redirect('member/login');
        }
    }

    public function order_land($land_id = null, $land_price = null) {
        if ($this->login) {
            $this->load->model('Order_model');
            $this->load->model('Land_model');
            $user = $this->user->getId();
            $order['orderno'] = 'NCL'.$user.$this->getUID();
            $order['type'] = 1;
            $order['user'] = $user;
            $order['land'] = $land_id;
            $order['total'] = $land_price;
            $order['created_at'] = date('Y-m-d H:i:s');
            $order_land = $this->Order_model->add_order($order);
            $cond['owner'] = $user;
            $this->Land_model->update_land($land_id, $cond);
            echo json_encode(array('status' => 'success', 'orderid' => $order_land));
        }
        else {
	        redirect('member/login');
        }
    }

	/**
	 *Product Confirm Order Page
	 * @param null $url
	 * @param null $product_ids
	 */
    public function confirm_order($url = null, $product_ids = null) {
        if ($this->login) {
            $data['url'] = $url;
            $data['pids'] = $product_ids;
            $user= $this->user->getId();
            $this->load->model('Destination_model');
            $data['destination'] = $this->Destination_model->get_default_destination($user);
            $pids = explode('_', $product_ids);
            $this->load->model('Product_model');
            $this->load->model('Cart_model');
            $data['products'] = array();
            $data['amounts'] = array();
	        foreach ($pids as $i => $iValue) {
	            $product = $this->Product_model->get_product($pids[$i]);
	            $data['products'][] = $product;
	            $cart = $this->Cart_model->get_user_cart($user, $pids[$i]);
	            $data['amounts'][] = $cart['amount'];
	        }
	        $this->load_header('确认订单');
            $this->load->view('front/confirm_order', $data);
            $this->load_footer();
        } else {
	        redirect('member/login');
        }
    }

    /**
     *Stealing vegetables Page
     **/
    public function stealing_vegetables() {
        $this->load->model('Reward_model');
        $this->load->model('Product_model');
        $data = array(
            'rewards' => $this->Reward_model->get_all_rewards(),
            'products' => $this->Product_model->get_bonus_products()
        );
        if ($this->login) {
            $data['is_login'] = 1;
        }
        else{
            $data['is_login'] = 0;
        }
        $this->load_header('偷菜');
        $this->load->view('front/stealing_vegetables', $data);
        $this->load_footer();
    }

    /**
     * Excellent Product Page ========================
     **/
    public function top_product() {
        $this->load_header('优品');
        $this->load->view('front/top_product');
        $this->load_footer();
    }

	/**
	 * type Products Page ========================
	 * @param null $type
	 */
    public function products($type = null) {
            $this->load->model('Product_model');
            $title = '';
            $params = array();
            $params['status'] = 1;
            if ((int)$type === 1) {
                $title = '今日特惠';
                $data['products'] = $this->Product_model->get_today();
            } elseif ((int)$type === 2) {
                $title = '蔬菜水果';
                $params['type'] = 1;
                $data['products'] = $this->Product_model->get_item_products($params);
            } elseif ((int)$type === 3) {
                $title = '家禽肉类';
                $params['type'] = 2;
                $data['products'] = $this->Product_model->get_item_products($params);
            } elseif ((int)$type === 4) {
                $title = '水产冻品';
                $params['type'] = 3;
                $data['products'] = $this->Product_model->get_item_products($params);
            } elseif ((int)$type === 5) {
                $title = '豆腐禽蛋';
                $params['type'] = 4;
                $data['products'] = $this->Product_model->get_item_products($params);
            } elseif ((int)$type === 6) {
                $title = '熟食面食';
                $params['type'] = 5;
                $data['products'] = $this->Product_model->get_item_products($params);
            } elseif ((int)$type === 7) {
                $title = '积分兑换';
                $params['type'] = 6;
                $data['products'] = $this->Product_model->get_item_products($params);
            } elseif ((int)$type === 8) {
                $title = '其他农品';
                $params['type'] = 7;
                $data['products'] = $this->Product_model->get_item_products($params);
            }
            $data['title'] = $title;
            $this->load->model('Product_model');
            $data['type'] = $type;
            $this->load_header($title);
            $this->load->view('front/products', $data);
            $this->load_footer();
    }


	/**
	 * Product Detail Page
	 * @param null $product_id
	 */
    public function product_detail($product_id = null) {
        $this->load->model('Product_model');
        $data['product'] = $this->Product_model->get_product($product_id);
        $this->load->model('Unit_model');
        $data['unit'] = $this->Unit_model->get_unit($data['product']['unit']);
        $this->load->model('Malls_model');
        $mall = $this->Malls_model->get_mall($data['product']['mall']);
        $this->load->model('User_model');
        $data['user'] = $this->User_model->get_user($mall['owner']);
        $data['login_user'] = -1;
        if ($this->login) {
            $user = $this->user->getId();
            $data['login_user'] = $user;
            $this->load->model('Cart_model');
            $data['carts'] = $this->Cart_model->get_user_carts($user);
        }
        $this->load_header('商品详情');
        $this->load->view('front/product_detail', $data);
        $this->load_footer();
    }

    /**
     * Add Cart Page
     **/
    public function add_cart() {
        if ($this->login) {
            $data['status'] = 'fail';
            $user = $this->user->getId();
            $this->load->model('Cart_model');
            $params['user'] = $user;
            $params['amount'] = $this->input->post('cnt');
            $params['product'] = $this->input->post('product_id');
            $products = $this->Cart_model->get_user_cart($user, $params['product']);
            $params['amount'] += $products['amount'];
            if ($products['id']) {
	            $result = $this->Cart_model->update_cart($products['id'], $params);
            } else {
	            $result = $this->Cart_model->add_cart($params);
            }
            if ($result) {
                $data['status'] = 'success';
            }
            echo json_encode($data);
        } else {
	        redirect('member/login');
        }
    }

    public function product_pay() {
        if ($this->login) {
            $data['status'] = 'fail';
            $user = $this->user->getId();
            $this->load->model('Order_model');
            $this->load->model('Destination_model');
	        $this->load->model('Cart_model');
	        $this->load->model('Product_model');
            $shopping_address = $this->Destination_model->get_default_destination($user);
            $order['orderno'] = 'NCP' . $user . $this->getUID();
            $order['type'] = 0;
            $order['user'] = $user;
            $order['product'] = $this->input->post('product');
            $order['total'] = $this->input->post('total');
            $order['delivery'] = $this->input->post('delivery');
            $coupon = $this->input->post('coupon');
            if ($coupon && (int)$coupon > 0) {
                $order['coupon'] = $this->input->post('coupon');
            }
            $order['destination'] = $shopping_address['id'];
            $order['created_at'] = date('Y-m-d H:i:s');
            $order['status'] = 0;
            $order_product = $this->Order_model->add_order($order);
            $cart = $this->input->post('cart');

            if ($cart == 1) {
                $products = $this->decodeArray($order['product']);
                foreach ($products as $product) {
                    $params['user'] = $user;
                    $params['product'] = $product['id'];
                    $this->Cart_model->delete_carts($params);
                    $pt = $this->Product_model->get_product($product['id']);
                    $cond['stock'] = $pt['stock'] - $product['amount'];
                    $this->Product_model->update_product($product['id'], $cond);
                }
            }

            if ($order_product) {
                $data['status'] = 'success';
                $data['orderno'] = $order['orderno'];
                $data['orderid'] = $order_product;
            }

            echo json_encode($data);
        } else {
	        redirect('member/login');
        }
    }

    /**
     * Shopping Cart Page
     **/
    public function shopping_cart() {
        if ($this->login) {
            $user = $this->user->getId();
            $this->load->model('Cart_model');
            $data['products'] = $this->Cart_model->get_user_carts($user);
            $this->load_header('购物车');
            $this->load->view('front/shopping_cart', $data);
            $this->load_footer();
        } else {
	        redirect('member/login');
        }
    }

    /**
     * Task Page ========================
     **/
    public function task() {
        if ($this->login) {
            $user = $this->user->getId();
            $this->load->model('Land_model');
            $land_buyer = $this->Land_model->get_sold_lands($user);
            $data['land_buyer'] = count($land_buyer);
            $this->load->model('User_model');
            $data['user'] = $this->User_model->get_user($user);
            $this->load_header('任务');
            $this->load->view('front/task', $data);
            $this->load_footer();
        } else {
	        redirect('member/login');
        }
    }

    /**
     * Publish Task Page
     **/
    public function publish_task() {
        if ($this->login) {
            $user = $this->user->getId();
            $this->load->model('Land_model');
            $data['lands'] = $this->Land_model->get_sold_lands($user);
            $this->load->model('Task_category_model');
            $data['categories'] = $this->Task_category_model->get_all_available();
            if ($this->post_exist()) {
                $result['status'] = 'fail';
                try {
                    $result = array();
                    $category_id = $this->input->post('category_id');
                    $this->load->model('Task_type_model');
                    $result['task_types'] = $this->Task_type_model->get_all_available($category_id);
                    $result['status'] = 'success';
                }catch (Exception $ex){
                    $result['reason'] = $ex->getMessage();
                }
                echo json_encode($result);
            }
            else{
                $this->load_header('发布任务');
                $this->load->view('front/publish_task', $data);
                $this->load_footer();
            }
        } else {
	        redirect('member/login');
        }
    }

    /**
     * get the area of selected land
     **/
    public function publish_task_area() {
        $result = array();
        $result['status'] = 'fail';
        try {
            $land_id = $this->input->post('land_id');
            $this->load->model('Land_model');
            $result['land'] = $this->Land_model->get_land($land_id);
            $result['status'] = 'success';
        }catch (Exception $ex){
            $result['reason'] = $ex->getMessage();
        }
        echo json_encode($result);
    }

    /**
     *  Publish task
     **/
    public function publish_my_task() {
        if ($this->login) {
            $result = array();
            $result['status'] = 'fail';
            try {
                $params = array();
                $user = $this->user->getId();
                $params['user'] = $user;
                $params['type'] = $this->input->post('type');
                $params['land'] = $this->input->post('land_id');
                $params['description'] = $this->input->post('description');
                $params['status'] = 1;
                $params['price'] = $this->input->post('price');
                $params['updated_at'] = date('Y-m-d H:i:s');
                $this->load->model('Task_model');
                $task = $this->Task_model->add_task($params);
                $result['status'] = 'success';
                $result['task_id'] = $task;
            }catch (Exception $ex){
                $result['reason'] = $ex->getMessage();
            }
            echo json_encode($result);
        } else {
	        redirect('member/login');
        }
    }

    /**
     * Mission Plan Page
     **/
    public function mission_plan() {
        if ($this->login) {
            $user = $this->user->getId();
            $this->load->model('Task_model');
            $data['tasks'] = $this->Task_model->get_user_tasks($user);
            $this->load_header('任务计划');
            $this->load->view('front/mission_plan', $data);
            $this->load_footer();
        } else {
	        redirect('member/login');
        }
    }

    /**
     * Apply for Entry Page
     **/
    public function apply_entry() {
        if ($this->login) {
            $user = $this->user->getId();
            $this->load->model('Request_model');
            if ($this->post_exist()) {
                $params['requester'] = $user;
                $params['charger'] = $this->input->post('principal');
                $params['phone'] = $this->input->post('telephone');
                $params['requested_at'] = date('Y-m-d H:i:s');
                $result = $this->Request_model->add_request($params);
                if ($result) {
	                $data['result'] = 'success';
                } else {
	                $data['result'] = 'fail';
                }
            }
            $data['apply'] = $this->Request_model->get_user_request($user);
            if ((int)$data['apply']['status'] === 1){
                redirect('front/upload_product');
            } else{
                $this->load_header('申请入驻');
                $this->load->view('front/apply_entry', $data);
                $this->load_footer();
            }
        } else {
	        redirect('member/login');
        }
    }

    public function upload_product() {
        if ($this->login) {
            $user = $this->user->getId();
            if ($this->post_exist()) {
                $result['status'] = 'fail';
                $this->load->model('Malls_model');
                $mall = $this->Malls_model->get_user_mall($user);
                $this->load->model('Product_model');
                
                $params = array(
                    'mall' => $mall['id'],
                    'land' => $this->input->post('land'),
                    'name' => $this->input->post('name'),
                    'type' => $this->input->post('type'),
                    'scale' => $this->input->post('scale'),
                    'unit' => $this->input->post('unit'),
                    'price' => $this->input->post('price'),
                    'stock' => $this->input->post('stock'),
                    'description' => $this->input->post('detail'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $product_id = 0;
                $picture = $this->input->post('picture');
                if (strpos($picture, 'data:image/png;base64') === 0) {
                    $picture = str_replace(array('data:image/png;base64,', ' '), array('', '+'), $picture);
                    $data = base64_decode($picture);
                    $file = 'uploads/products/'.$user. '_' . md5($picture) . '.png';
                    if (file_put_contents($file, $data)) {
                        $params['image'] = $file;
                        $product_id = $this->Product_model->add_product($params);
                        $result['product_id'] = $product_id;
                        $result['status'] = 'success';
                    }
                }
                $detail_img = $this->input->post('detail_img');
                
                for($i = 0; $i < count($detail_img); $i++){
                    
                    $img = $detail_img[$i];
                    if (strpos($img, 'data:image/png;base64') === 0) {
                        $img = str_replace(array('data:image/png;base64,', ' '), array('', '+'), $img);
                        $data2 = base64_decode($img);
                        $file2 = 'uploads/products/'.$user. '_' . md5($img) . '.png';
                        if (file_put_contents($file2, $data2)) {
                            $para['detail_img'] = $file2;
                            $para['product_id'] = $product_id;
                            $para['updated_at'] = date('Y-m-d H:i:s');
                            $this->load->model('Product_detail_img_model');
                            $this->Product_detail_img_model->add_product_detail_img($para);               
                        }
                    }
                }
                echo json_encode($result);
            } else{
                $this->load->model('Land_model');
                $data['lands'] = $this->Land_model->get_all_lands($user);
                $this->load->model('Product_type_model');
                $data['types'] = $this->Product_type_model->get_all_product_types();
                $this->load->model('Unit_model');
                $data['units'] = $this->Unit_model->get_all_available();
                $this->load_header('上传产品');
                $this->load->view('front/upload_product', $data);
                $this->load_footer();
            }
        } else {
	        redirect('member/login');
        }
    }

	/**
	 * Buy Land
	 * @param string $command
	 */
	public function buy($command = 'land') {
		if ($this->login) {
			if ($command === 'product') {
				$this->load_header('');
				$this->load->view('front/select_area');
				$this->load_footer();
			} elseif ($command === 'land') {
				$this->load_header('Land Selection');
				$this->load->view('front/select_land');
				$this->load_footer();
			}
		} else {
			redirect('member/login');
		}
	}
}