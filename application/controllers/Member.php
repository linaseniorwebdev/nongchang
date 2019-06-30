<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'controllers/Base.php');

class Member extends Base {

	public function textme() {
		$result = array('status' => 'fail');
		if ($this->post_exist()) {
			$message = array(
				"0" => "短信发送成功",
				"-1" => "参数不全",
				"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
				"30" => "密码错误",
				"40" => "账号不存在",
				"41" => "余额不足",
				"42" => "帐户已过期",
				"43" => "IP地址限制",
				"50" => "内容含有敏感词",
				"51" => "手机号码不准确"
			);

			$smsapi = "http://api.smsbao.com/";
			$user = "qiyunit"; //短信平台帐号
			$pass = md5("qiyun123"); //短信平台密码

			$phone = $this->input->post('phone');

			$sms = '';
			for ($n = 0; $n < 6; $n++)
				if ($n < 1)
					$sms .= rand(1, 9);
				else
					$sms .= rand(0, 9);

			$content = "您的验证码是`" . $sms . "`,５分钟内有效。为了您的账户安全，请不要把验证码泄露给他人。";

			$this->load->model('Session_model');
			$this->Session_model->add_session(array(
				'phone' => $phone,
				'data' => $sms,
				'created_at' => date("Y-m-d H:i:s")
			));

			try {
				$sendurl = $smsapi . "sms?u=" . $user . "&p=" . $pass . "&m=" . $phone . "&c=" . urlencode($content);
				$res = file_get_contents($sendurl);
				if ($res == "0") {
					$result['sms'] = $sms;
					$result['status'] = 'success';
				} else {
					$result['description'] = $message[$res];
				}
			} catch (Exception $exc) {
				$result['description'] = $exc->getTraceAsString();
			}
		} else {
			$result['description'] = 'Missing arguments';
		}
		echo json_encode($result);
	}

	public function checkSMS($phone, $sms) {
		if ($phone == null)
			return 'invalid';
		$this->load->model('Session_model');
		$data = $this->Session_model->get_session($phone);
		if ($data) {
			$data = $this->Session_model->get_real_session($phone);
			if ($data) {
				if ($sms == $data['data'])
					return 'ok';
				return 'wrong';
			}
			return 'expired';
		} else
			return 'nonexist';
	}
	
	public function index() {
		if ($this->login) {
			$id = $this->user->getId();
			$this->load->model('Income_model');
			$data1 = $this->Income_model->get_income($id);
			$this->load->model('Stock_model');
			$data2 = $this->Stock_model->get_stock($id);
			$data = array_merge($data1, $data2);
			$this->load->model('User_model');
			$data['user'] = $this->User_model->get_user($id);
			$this->load->model('Request_model');
			$data['request'] = $this->Request_model->get_user_request($id);
			$this->load_header('我的');
			$this->load->view('member/index', $data);
			$this->load_footer();
		} else
			redirect('member/login');
	}

	public function login() {
		$messages = array();

		if ($this->post_exist()) {
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$messages['username'] = $user;
			$messages['password'] = $pass;
			$this->load->model('User_model');
			$data = $this->User_model->get_by_name($user);

			if ($data) {

			} else
				$data = $this->User_model->get_by_phone($user);

			if ($data) {
				if ($data['password'] == md5($pass)) {
					// Login success
					$this->session->set_userdata('user', $data['id']);
					redirect('front');
				} else {
					$messages['reason'] = 'password';
				}
			} else {
				$messages['reason'] = 'nonexist';
			}
		}
		$this->load_header('登录');
		$this->load->view('member/login', $messages);
		$this->load_footer();
	}

	public function check_user(){
	    $username = $this->input->post('username');
        $this->load->model('User_model');
        $data = $this->User_model->get_by_name($username);
        if ($data) {

        } else
            $data = $this->User_model->get_by_phone($username);
        if ($data) {
            $data['status'] = 'success';
        }
        else $data['status'] = 'fail';
        echo json_encode($data);
    }

    public function change_password($user_id = null) {
        if ($user_id == null) {
            if ($this->agent->is_referral())
                echo $this->agent->referrer();
            else
                redirect('/');
        }
        $this->load->model('User_model');
        $data = $this->User_model->get_user($user_id);
        if ($this->post_exist()) {
            $phone = $this->input->post('phone');
            $sms = $this->input->post('sms');
            $messages['sms'] = $this->checkSMS($phone, $sms);
            if ($messages['sms'] == 'ok'){
                $password = $this->input->post('password');
                $params['password'] = md5($password);
                $this->User_model->update_user($user_id, $params);
                redirect('member/login');
            }
        }
        $this->load_header('更改密码');
        $this->load->view('member/change_password', array('user' => $data));
        $this->load_footer();
    }

	public function signup() {
		$messages = array();
		if ($this->login)
			redirect('member/index');

		if ($this->post_exist()) {
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$phone = $this->input->post('phone');
			$sms = $this->input->post('sms');
            $messages['user_name'] = $user;
            $messages['phone_number'] = $phone;

			$this->load->model('User_model');

			$data = $this->User_model->get_by_name($user);
			if ($data)
				$messages['username'] = 'exist';
			else
				$messages['username'] = 'ok';

			$data = $this->User_model->get_by_phone($phone);
			if ($data)
				$messages['phone'] = 'exist';
			else
				$messages['phone'] = 'ok';

			$messages['sms'] = $this->checkSMS($phone, $sms);

			if ($messages['username'] == 'ok' && $messages['sms'] == 'ok' && $messages['phone'] == 'ok') {
				while (1) {
					$six = mt_rand(100000, 999999);
					$data = $this->User_model->get_by_number($six);
					if ($data)
						continue;
					break;
				}
				$params = array(
					'username' => $user,
					'fullname' => $user,
					'usernum' => $six,
					'phone' => $phone,
					'password' => md5($pass),
					'created_at' => date("Y-m-d H:i:s")
				);
				$this->User_model->add_user($params);

				redirect('member/login');
			}
		}
		$this->load_header('注册');
		$this->load->view('member/signup', $messages);
		$this->load_footer();
	}

	public function logout() {
		$this->session->unset_userdata('user');
		redirect('front');
	}

    public function apply_withdrawal() {
        if ($this->login) {
	        $id = $this->user->getId();
	        $this->load->model('Income_model');
	        $data['withdraw_money'] = $this->Income_model->get_income($id);
	        $this->load->model('Card_model');
	        $data['bankcard'] = $this->Card_model->get_default_card($id);
            if ($this->post_exist()) {
                $data['status'] = 'fail';
                $params['user'] = $id;
                $params['amount'] = $this->input->post('amount');
                $params['card'] = $this->input->post('card');
                $params['status'] = 0;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $this->load->model('Withdraw_model');
                $result = $this->Withdraw_model->add_withdraw($params);
                if ($result){
                    $data['status'] = 'success';
                }
            }
            $this->load_header('申请提现');
            $this->load->view('member/apply_withdrawal', $data);
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function apply_record() {
        if ($this->login) {
	        $id = $this->user->getId();
	        $this->load->model('Withdraw_model');
	        $data = $this->Withdraw_model->get_withdraw($id);
            $this->load_header('提现记录');
            $this->load->view('member/apply_record', array('data' => $data));
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function warehouse() {
        if ($this->login) {
        	$user_id = $this->user->getId();
        	$this->load->model('Stock_model');
        	$this->load->model('Product_model');
        	$stocks = $this->Stock_model->get_user_stocks($user_id);
        	$products = array();
        	foreach ($stocks as $key => $stock) {
        		$product = $this->Product_model->get_stock_product($stock['product']);
        		array_push($products, $product);
        	}
        	$this->load->model('Unit_model');
        	$units = $this->Unit_model->get_all_available();
        	$data['stocks'] = $stocks;
        	$data['products'] = $products;
        	$data['units'] = $units;
            $this->load_header('我的仓库');
            $this->load->view('member/warehouse', $data);
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function bankcard($url = null) {
        $messages = array();
        if ($this->login) {
            if ($this->post_exist()) {
                $url = $this->input->post('url');
                $id = $this->user->getId();
                $this->load->model('Card_model');
                $status = $this->input->post('status');
                if ($status == 1)
                    $this->Card_model->reset_lasted_used($id);
                $sms = $this->input->post('sms');
                $phone =  $this->input->post('phone');
                $messages['sms'] = $this->checkSMS($phone, $sms);
                if ($messages['sms'] == 'ok') {
                    $params = array(
                        'user' => $id,
                        'holder' => $this->input->post('cardholder'),
                        'identity' => $this->input->post('identification'),
                        'bank' => $this->input->post('bank'),
                        'number' => $this->input->post('card_number'),
                        'phone' => $phone,
                        'last_used' => $status

                    );
                    $this->Card_model->add_card($params);

                    redirect('member/bankcard_list/'.$url);
                }
            }
            $messages['url'] = $url;
            $this->load_header('绑定银行卡');
            $this->load->view('member/bankcard', $messages);
            $this->load_footer();
        }
        else{
            redirect('member/login');
        }
    }

	public function bankcard_list($url = null) {
		if ($this->login) {
			$id = $this->user->getId();
			$this->load->model('Card_model');
			$data = $this->Card_model->get_all_cards($id);
			$this->load_header('我的银行卡');
			$this->load->view('member/bankcard_list', array('data' => $data, 'url'=> $url));
			$this->load_footer();
		} else
			redirect('member/login');
	}

	public function change_bankcard($id = null, $url = null) {
        if ($this->login) {
            if ($id == null) {
                if ($this->agent->is_referral())
                    echo $this->agent->referrer();
                else
                    redirect('/');
            }
            $data = array();

            $this->load->model('Card_model');
            $data['self'] = $this->Card_model->get_card($id);
            if ($this->post_exist()) {
                $url = $this->input->post('url');
                $user = $this->user->getId();
                $this->load->model('Card_model');
                $status = $this->input->post('status');
                if ($status == 1)
                    $this->Card_model->reset_lasted_used($user);
                $sms = $this->input->post('sms');
                $phone =  $this->input->post('phone');
                $data['sms'] = $this->checkSMS($phone, $sms);
                if ($data['sms'] == 'ok') {
                    $params = array(
                        'holder' => $this->input->post('cardholder'),
                        'identity' => $this->input->post('identification'),
                        'bank' => $this->input->post('bank'),
                        'number' => $this->input->post('card_number'),
                        'phone' => $phone,
                        'last_used' => $status

                    );
                    $this->Card_model->update_card($id, $params);

                    redirect('member/bankcard_list/'.$url);
                }
            }
            $data['url'] = $url;
            $this->load_header('绑定银行卡');
            $this->load->view('member/change_bankcard', $data);
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function my_land() {
        if ($this->login) {
	        $user = $this->user->getId();
	        $this->load->model('Land_model');
	        $data = $this->Land_model->get_all_lands($user);
            $this->load_header('我的土地');
            $this->load->view('member/my_land', array('data' => $data));
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function my_land_camera($land_id = null) {
        if ($this->login) {
            $this->load->model('Bindings_model');
            $data = $this->Bindings_model->get_bindings_by_land($land_id);
            $this->load_header('实景');
            $this->load->view('member/my_land_camera', array('data' => $data));
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function personal_info() {
        if ($this->login) {
        	$id = $this->user->getId();
        	$this->load->model('User_model');
        	$user = $this->User_model->get_user($id);
            $this->load_header('个人信息');
            $this->load->view('member/personal_info', array('user' => $user));
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function my_address($url = null, $sub = null, $product_id = null) {
        if ($this->login) {
            if ($product_id != null) $url = $url.'/'. $sub.'/'.$product_id;
	        $id = $this->user->getId();
	        $this->load->model('Destination_model');
	        $data = $this->Destination_model->get_destinations($id);
            $this->load_header('我的地址');
            $this->load->view('member/my_address', array('data' => $data, 'url' => $url));
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function add_address($url = null,$sub = null, $product_id = null) {
        if ($this->login) {
	        $data = array();
            if ($product_id != null) $url = $url.'/'. $sub.'/'.$product_id;
	        $data['url'] = $url;
	        $this->load->model('Province_model');
	        $data['provinces'] = $this->Province_model->get_all_provinces();
	        if ($this->post_exist()) {
		        $user = $this->user->getId();
		        $this->load->model('Destination_model');
		        $status = $this->input->post('status');
		        if ($status == 1)
			        $this->Destination_model->reset_status($user);
		        $params = array(
		        	'user' => $user,
			        'receipt' => $this->input->post('receipt'),
			        'phone' => $this->input->post('phone'),
			        'province' => $this->input->post('province'),
			        'city' => $this->input->post('city'),
			        'district' => $this->input->post('district'),
			        'detail' => $this->input->post('detail'),
			        'status' => $status
		        );
		        $this->Destination_model->add_destination($params);
		        $data['message'] = 'success';
		        $url = $this->input->post('url');
		        redirect('member/my_address/'.$url);
	        }
            $this->load_header('新增地址');
            $this->load->view('member/add_address', $data);
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function change_address($id = null, $url = null, $sub = null, $product_id = null) {
        if ($this->login) {
        	if ($id == null) {
		        if ($this->agent->is_referral())
			        echo $this->agent->referrer();
		        else
			        redirect('/');
	        }
	        $data = array();
            if ($product_id != null) $url = $url.'/'. $sub.'/'.$product_id;
            $data['url'] = $url;
	        $this->load->model('Province_model');
	        $this->load->model('Destination_model');
	        $data['provinces'] = $this->Province_model->get_all_provinces();
	        $data['self'] = $this->Destination_model->get_by_id($id);
            if ($this->post_exist()) {
                $user = $this->user->getId();
                $status = $this->input->post('status');
                if ($status == 1)
                    $this->Destination_model->reset_status($user);
                $params = array(
                    'province' => $this->input->post('province'),
                    'city' => $this->input->post('city'),
                    'district' => $this->input->post('district'),
                    'detail' => $this->input->post('detail'),
                    'status' => $status
                );
                $this->Destination_model->update_destination($id, $params);
                $data['message'] = 'success';
                $url = $this->input->post('url');
                redirect('member/my_address/'.$url);
            }
            $this->load_header('修改地址');
            $this->load->view('member/change_address', $data);
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function delete_address(){
        $data = array();
        try{
            $id = $this->input->post('id');
            $this->load->model('Destination_model');
            $params['status'] = 0;
            $params['visible'] = 0;
            $this->Destination_model->update_destination($id, $params);
            $data['status'] = 'success';
        }
        catch (Exception $exc) {
            $data['status'] = 'fail';
        }

        echo json_encode($data);
    }

    public function give_others() {
        if ($this->login) {
            $this->load_header('赠送他人');
            $this->load->view('member/give_others');
            $this->load_footer();
        } else
            redirect('member/login');
    }

    public function my_order() {
        if ($this->login) {
            $user = $this->user->getId();
            $this->load->model('Order_model');
            if ($this->post_exist()) {
                $data['state'] = 'fail';
                try{
                    $data = array();
                    $status = $this->input->post('status');
                    if ($status == 'all') {
                        $data['orders'] = $this->Order_model->get_user_orders($user);
                    }
                    else if ($status == 0){
                        $data['orders'] = $this->Order_model->get_user_order0($user, 0);
                    }
                    else{
                        $data['orders'] = $this->Order_model->get_user_orders($user, $status);
                    }
//                    file_put_contents('debug.txt', date("Y-m-d H:i:s") . ' `orderlength` = ' . count($data['orders']));
                    $this->load->model('Product_model');
                    $prods = array();
                    $pt_ids_amounts = array();
                    foreach ($data['orders'] as $order){
                        $products = $this->decodeArray($order['product']);
                        array_push($pt_ids_amounts, $products);
                        $pts = array();
                        foreach ($products as $product) {
                            $pt = $this->Product_model->get_product($product['id']);
                            array_push($pts, $pt);
                        }
                        array_push($prods, $pts);
                    }
                    $data['pt_ids_amounts'] = $pt_ids_amounts;
                    $data['products'] = $prods;
                    $data['state'] = 'success';
                } catch (Exception $ex){
                    $data['reason'] =  $ex->getMessage();
                }
                echo json_encode($data);
            }
            else{
                $this->load_header('我的订单');
                $this->load->view('member/my_order');
                $this->load_footer();
            }

        } else
            redirect('member/login');
    }

    public function cancel_order() {
        if ($this->login) {
            $user = $this->user->getId();
            $this->load->model('Order_model');
            $status = $this->input->post('status');
            $order_id = $this->input->post('order_id');
            $data['state'] = 'fail';
            try{
                if ($status == 0) {
                    $delivery = 0;
                }
                else if ($status == 1) {
                    $delivery = 5.00;
                }
                else if ($status == 2) {
                    $delivery = 5.00;
                }
                $order = $this->Order_model->get_order($order_id);
                $products = $this->decodeArray($order['product']);
                foreach ($products as $product) {
                    $this->load->model('Product_model');
                    $pt = $this->Product_model->get_product($product['id']);
                    $cond['stock'] = $pt['stock'] + $product['amount'];
                    $this->Product_model->update_product($product['id'], $cond);
                }
                $params['status'] = 4;
                $this->Order_model->update_order($order_id, $params);
                $data['state'] = 'success';
            }catch (Exception $ex){
                $data['reason'] =  $ex->getMessage();
            }
            echo json_encode($data);
        }else
            redirect('member/login');
    }
    public function pay_order(){
        if ($this->login) {
            $data['state'] = 'fail';
            try{
                $user = $this->user->getId();
                $this->load->model('Order_model');
                $order_id = $this->input->post('order_id');
                $params['status'] = 1;
                $this->Order_model->update_order($order_id, $params);
                $data['state'] = 'success';
            }catch (Exception $ex){
                $data['reason'] =  $ex->getMessage();
            }
            echo json_encode($data);
        }else
            redirect('member/login');
    }
    public function remind_shipment(){
        if ($this->login) {
            $data['state'] = 'fail';
            try{
                $this->load->model('Order_model');
                $order_id = $this->input->post('order_id');
                $params['status'] = 2;
                $this->Order_model->update_order($order_id, $params);
                $data['state'] = 'success';
            }catch (Exception $ex){
                $data['reason'] =  $ex->getMessage();
            }
            echo json_encode($data);
        }else
            redirect('member/login');
    }
    public function complete_order(){
        if ($this->login) {
            $data['state'] = 'fail';
            try{
                $this->load->model('Order_model');
                $order_id = $this->input->post('order_id');
                $params['status'] = 3;
                $this->Order_model->update_order($order_id, $params);
                $data['state'] = 'success';
            }catch (Exception $ex){
                $data['reason'] =  $ex->getMessage();
            }
            echo json_encode($data);
        }else
            redirect('member/login');
    }
    public function delete_order(){
        if ($this->login) {
            $data['state'] = 'fail';
            try{
                $this->load->model('Order_model');
                $order_id = $this->input->post('order_id');
                $this->Order_model->delete_order($order_id);
                $data['state'] = 'success';
            }catch (Exception $ex){
                $data['reason'] =  $ex->getMessage();
            }
            echo json_encode($data);
        }else
            redirect('member/login');
    }
    public function my_products() {
        if ($this->login) {
            $user = $this->user->getId();
            $this->load->model('Product_type_model');
            $data['types'] = $this->Product_type_model->get_all_product_types();
            $this->load->model('Product_model');
            $this->load->model('Malls_model');
            $mall = $this->Malls_model->get_user_mall($user);
            $this->load->model('Unit_model');
            $units = $this->Unit_model->get_all_available();
            $data['units'] = array();
            foreach ($units as $unit){
//                $item = array(
//                  $unit['id'] =>$unit['name']
//                );
//                array_push($data['units'], $item);
                $data['units'][$unit['id']] = $unit['name'];
            }
            $params['mall'] = $mall['id'];
            $params['type'] = 1;
            if ($this->post_exist()) {
                $params['type'] = $this->input->post('type');
                $data['products'] = $this->Product_model->get_item_products($params);
                $data['status'] = 'success';
                echo json_encode($data);
            }
            else{
                $data['products'] = $this->Product_model->get_item_products($params);
                $this->load_header('我的店铺');
                $this->load->view('member/my_products', $data);
                $this->load_footer();
            }

        } else
            redirect('member/login');
    }

    public function go_evaluation(){
    	if ($this->login) {
    		$data['order_id'] = $this->input->get('order_id');
    		$this->load_header('发表评价');
            $this->load->view('member/evaluation', $data);
            $this->load_footer();
    	}
    	else
            redirect('member/login');
    }

    public function give_evaluation(){
    	if ($this->login) {
    		$data['state'] = 'fail';
    		$user = $this->user->getId();
    		$order_id = $this->input->post('order_id');
    		$params['writer'] = $user;
    		$params['order'] = $order_id;
    		$params['note'] = $this->input->post('note');
    		$params['rating'] = $this->input->post('rating');
    		$this->load->model('Order_model');
    		$order = $this->Order_model->get_order($order_id);
    		$this->load->model('Product_model');
    		$products = $this->decodeArray($order['product']);
    		$this->load->model('Review_model');
    		foreach ($products as $product) {
    			$params['product'] = $product['id'];
    			$result = $this->Review_model->add_review($params);
    			if ($result != null) 
    				$data['state'] = 'success';
    			else 
    				$data['state'] = 'fail';
    		}
    		$update_order['review'] = 1;
    		$this->Order_model->update_order($order_id, $update_order);
    		echo json_encode($data);
    	}
    	else
            redirect('member/login');
    }
}
