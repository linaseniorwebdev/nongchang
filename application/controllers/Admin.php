<?php

// Error Logging -> file_put_contents('debug.txt', date("Y-m-d H:i:s"));

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base.php';

class Admin extends Base {
	
	/**
	 * 控制台
	 */
	public function index() {
		if ($this->admin) {
			$data = array();
			$this->load->model('Dashboard_model');
			$data['users'] = $this->Dashboard_model->get_users();
			$data['products'] = $this->Dashboard_model->get_products();
			$data['lands'] = $this->Dashboard_model->get_lands();
			$data['orders'] = $this->Dashboard_model->get_orders();
			$data['tasks'] = $this->Dashboard_model->get_tasks();
			$data['incomes'] = $this->Dashboard_model->get_income();
			$this->load_header('控制台', true);
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'index', 'sub' => null));
			$this->load->view('admin/index', $data);
			$this->load_footer(true);
		} else
			redirect('admin/signin');
	}
	
	/**
	 * 登录页
	 */
	public function signin() {
		if ($this->admin)
			redirect('admin/index');

		$messages = array();

		if ($this->post_exist()) {
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$messages['username'] = $user;
			$messages['password'] = $pass;
			$this->load->model('Admin_model');
			$data = $this->Admin_model->get_by_name($user);
			if ($data) {
				if ($data['password'] == md5($pass)) {
					$this->session->set_userdata('admin', $data['id']);
					redirect('admin');
				} else {
					$messages['reason'] = 'password';
				}
			} else {
				$messages['reason'] = 'nouser';
			}
		}

		$this->load->view('admin/signin', $messages);
	}
	
	/**
	 * 登出页
	 */
	public function signout() {
		$this->session->unset_userdata('admin');
		redirect('admin');
	}
	
	/**
	 * 用户管理
	 */
	public function users() {
		if ($this->admin) {
			$this->load_header('用户管理', true);
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'users', 'sub' => null));
			$this->load->view('admin/users');
			$this->load_footer(true, 'users');
		} else
			redirect('admin/signin');
	}
	
	/**
	 * 地址管理
	 * @param string $com
	 */
	public function address($com = 'province') {
		if ($this->admin) {
			$this->load->model('Province_model');
			$data['provinces'] = $this->Province_model->get_all_provinces(false);
			if ($com == 'province')
				$this->load_header('省管理', true);
			if ($com == 'city')
				$this->load_header('市管理', true);
			if ($com == 'district')
				$this->load_header('区管理', true);
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'address', 'sub' => $com));
			$this->load->view('admin/address_' . $com, $data);
			$this->load_footer(true, 'address_' . $com);
		} else
			redirect('admin/signin');
	}
	
	/**
	 * 土地管理
	 * @param string $com
	 */
	public function land($com = 'area') {
		if ($this->admin) {
			$this->load->model('Province_model');
			$data['provinces'] = $this->Province_model->get_all_provinces(false);
			if ($com === 'area') {
				$this->load_header('区域管理', true);
				$this->load->model('Blocks_model');
				$data['data'] = $this->Blocks_model->list_blocks(1);
			}
			if ($com === 'type') {
				$this->load_header('土地类型管理', true);
			}
			if ($com === 'new') {
				$this->load_header('新增土地', true);
			}
			if ($com === 'all') {
				$this->load->model('Channel_model');
				$data['channels'] = $this->Channel_model->get_all_channels();
				$this->load_header('所有土地', true);
			}
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'land', 'sub' => $com));
			$this->load->view('admin/land_' . $com, $data);
			$this->load_footer(true, 'land_' . $com);
		} else {
			redirect('admin/signin');
		}
	}
	
	/**
	 * 远程视频监控
	 * @param string $com
	 */
	public function remote($com = 'channels') {
		if ($this->admin) {
			$data = array();
			if ($com === 'channels') {
				$this->load_header('摄像频道', true);
			}
			if ($com === 'add') {
				$this->load_header('新增频道', true);
			}
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'remote', 'sub' => $com));
			$this->load->view('admin/remote_' . $com, $data);
			$this->load_footer(true, 'remote_' . $com);
		} else {
			redirect('admin/signin');
		}
	}
	
	/**
	 * 任务管理
	 * @param string $com
	 */
	public function task($com = 'category') {
		if ($this->admin) {
			$data = array();
			if ($com == 'category')
				$this->load_header('任务类别', true);
			if ($com == 'type') {
				$this->load_header('任务类型', true);
				$this->load->model('Task_category_model');
				$data['cats'] = $this->Task_category_model->get_all_available();
			}
			if ($com == 'status')
				$this->load_header('任务状态', true);
			if ($com == 'all')
				$this->load_header('所有任务', true);
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'task', 'sub' => $com));
			$this->load->view('admin/task_' . $com, $data);
			$this->load_footer(true, 'task_' . $com);
		} else
			redirect('admin/signin');
	}
	
	/**
	 * 优品管理
	 * @param string $com
	 */
	public function product($com = 'unit') {
		if ($this->admin) {
			if ($com == 'unit')
				$this->load_header('优品单位', true);
			if ($com == 'type')
				$this->load_header('优品类型', true);
			if ($com == 'all')
				$this->load_header('所有优品', true);
			if ($com == 'request')
				$this->load_header('入住请求', true);
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'product', 'sub' => $com));
			$this->load->view('admin/product_' . $com);
			$this->load_footer(true, 'product_' . $com);
		} else
			redirect('admin/signin');
	}
	
	/**
	 * 订单管理
	 * @param string $com
	 */
	public function order($com = 'product') {
		if ($this->admin) {
			if ($com == 'product')
				$this->load_header('购买订单', true);
			if ($com == 'land')
				$this->load_header('认购订单', true);
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'order', 'sub' => $com));
			$this->load->view('admin/order_' . $com);
			$this->load_footer(true,'order_' . $com);
		} else
			redirect('admin/signin');
	}
	
	/**
	 * 赠送管理
	 */
	public function delivery() {
		if ($this->admin) {
			$this->load_header('赠送管理', true);
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'delivery', 'sub' => null));
			$this->load->view('admin/delivery');
			$this->load_footer(true);
		} else
			redirect('admin/signin');
	}
	
	/**
	 * 订单管理
	 * @param string $com
	 */
	public function wallet($com = 'income') {
		if ($this->admin) {
			if ($com === 'income') {
				$this->load_header('所有收入', true);
			}
			if ($com === 'withdraw') {
				$this->load_header('所有退钱', true);
			}
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'wallet', 'sub' => $com));
			$this->load->view('admin/wallet_' . $com);
			$this->load_footer(true,'wallet_' . $com);
		} else {
			redirect('admin/signin');
		}
	}
	
	/**
	 * 系统管理
	 * @param string $com
	 */
	public function system($com = 'coupon') {
		if ($this->admin) {
			if ($this->post_exist()) {
				if ($com === 'other') {
					$value = (float)$this->input->post('seller_fee');
					$this->System_model->update_system_variable('seller_fee', number_format($value / 100.0, 2, '.', ''));
					$value = (float)$this->input->post('withdraw_fee');
					$this->System_model->update_system_variable('withdraw_fee', number_format($value / 100.0, 2, '.', ''));
					redirect('admin/system/other');
				} elseif ($com === 'game') {
					$value = (float)$this->input->post('probability_common');
					$this->System_model->update_system_variable('probability_common', number_format($value / 100.0, 2, '.', ''));
					$value = (float)$this->input->post('probability_special');
					$this->System_model->update_system_variable('probability_special', number_format($value / 100.0, 2, '.', ''));
					redirect('admin/system/game');
				}
			}
			$data = array();
			if ($com === 'coupon') {
				$this->load_header('优惠券管理', true);
			}
			if ($com === 'wallet') {
				$this->load_header('系统钱包', true);
			}
			if ($com === 'ads') {
				$this->load_header('广告', true);
			}
			if ($com === 'other') {
				$this->load_header('其他设定', true);
				$data = array('system' => $this->vars);
			}
			if ($com === 'game') {
				$this->load->model('Reward_model');
				$this->load->model('Product_model');
				$this->load_header('“偷菜”游戏设定', true);
				$data = array(
					'system' => $this->vars,
					'rewards' => $this->Reward_model->get_all_rewards(),
					'products' => $this->Product_model->get_bonus_products()
				);
			}
			$this->load->view('admin/topbar');
			$this->load->view('admin/sidebar', array('com' => 'system', 'sub' => $com));
			$this->load->view('admin/system_' . $com, $data);
			$this->load_footer(true,'system_' . $com);
		} else
			redirect('admin/signin');
	}
}
