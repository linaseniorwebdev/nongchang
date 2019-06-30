<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base.php';

class Api extends Base {

	public function checkSMS($phone, $sms) {
		if ($phone === null) {
			return 'invalid';
		}
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

	/**
	 * User processing module
	 * @param string $com
	 */
	public function user($com = 'list') {
		if ($com == 'list') {
			$this->load->model('User_model');

			$data = $row = array();

			$userData = $this->User_model->getRows($_POST);

			foreach($userData as $user){
				$created = date( 'Y年m月d日', strtotime($user->created_at));
				$status = ($user->status == 1)?'有效':'已停用';
				$phone = substr_replace($user->phone,'****',3,4);
				$data[] = array($user->id, $user->photo, $user->username, $phone, $user->fullname, $created, $status, null);
			}

			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->User_model->countAll(),
				'recordsFiltered' => $this->User_model->countFiltered($_POST),
				'data' => $data,
			);

			echo json_encode($output);
		} elseif ($com == 'update') {
			$result = array('status' => 'fail');

			if ($this->post_exist()) {
				$this->load->model('User_model');

				$params = array();
				$messages = array();

				$id = $this->input->post('id');
				if ($id) {

				} else
					$id = $this->user->getId();

				foreach ($_POST as $key => $value) {
					if ($key == 'id') continue;
					$params[$key] = $this->input->post($key);

					if ($key == 'username') {
						$data = $this->User_model->get_by_name($params[$key]);
						if ($data)
							$messages['username'] = 'exist';
					}

					if ($key == 'phone') {
						$data = $this->User_model->get_by_phone($params[$key]);
						if ($data)
							$messages['phone'] = 'exist';
					}
				}

				if (count($messages) < 1) {
					$this->User_model->update_user($id, $params);
					$result['status'] = 'success';
				} else {
					foreach ($messages as $key => $value) {
						$result[$key] = $value;
					}
				}
			}

			echo json_encode($result);
		} else {

		}
	}

	/**
	 * Province processing module
	 * @param string $com
	 */
	public function province($com = 'all') {
		$this->load->model('Province_model');
		if ($com == 'all') {
			$data = $this->Province_model->get_all_provinces();
			echo json_encode($data);
		} elseif ($com == 'update') {
			$code = $this->input->post('code');
			$name = $this->input->post('name');
			$this->Province_model->update_province($code, $name);
		} else {

		}
	}

	/**
	 * City processing module
	 * @param string $com
	 */
	public function city($com = 'list') {
		$this->load->model('City_model');
		if ($com == 'list') {
			$province = $this->input->post('province');
			$result['cities'] = $this->City_model->get_city_list($province);
			echo json_encode($result);
		} elseif ($com == 'update') {
			$this->City_model->update_city($this->input->post('id'), array('name' => $this->input->post('name')));
			echo json_encode(array('status' => 'success'));
		} else {

		}
	}

	/**
	 * City processing module
	 * @param string $com
	 */
	public function district($com = 'list') {
		$this->load->model('District_model');
		if ($com == 'list') {
			$city = $this->input->post('city');
			$result['districts'] = $this->District_model->get_district_list($city);
			echo json_encode($result);
		} elseif ($com == 'update') {
			$this->District_model->update_district($this->input->post('id'), array('name' => $this->input->post('name')));
			echo json_encode(array('status' => 'success'));
		} else {

		}
	}

	/**
	 * Upload processing module
	 * @param string $com
	 * @param string $sub
	 */
	public function upload($com = '', $sub = '') {
		$total = $com . $sub;
		$result = array('status' => 'fail');
		if (strlen($total) > 0) {
			if ($total == 'block') {
				$params = array(
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'province' => $this->input->post('province'),
					'city' => $this->input->post('city'),
					'district' => $this->input->post('district')
				);
				$picture = $this->input->post('picture');
				if (strpos($picture, 'data:image/png;base64') === 0) {
					$picture = str_replace(array('data:image/png;base64,', ' '), array('', '+'), $picture);
					$data = base64_decode($picture);
					$file = 'uploads/blocks/' . md5($picture) . '.png';
					if (file_put_contents($file, $data)) {
						$params['picture'] = $file;
						$this->load->model('Blocks_model');
						$this->Blocks_model->add_block($params);
						$result['status'] = 'success';
					}
				}
			}

			if ($total == 'user') {
                $fullname = $this->input->post('fullname');
                $phone = $this->input->post('phone');
                $result['full_name'] = $fullname;
                $result['phone_number'] = $phone;
                $sms = $this->input->post('sms');
                $id = $this->input->post('id');
                $picture = $this->input->post('picture');
                $params = array(
                    'fullname' => $fullname,
                    'phone' => $phone
                );
                $result['status'] = 'fail';
                $this->load->model('User_model');

                    if ($sms != null || $sms != ''){
                        $result['sms'] = $this->checkSMS($phone, $sms);
                        if ($result['sms'] == 'ok') {
                            $data = $this->User_model->get_by_phone($phone);
                            if ($data) $result['phone'] = 'exist';
                            else $result['phone'] = 'ok';
                            if ($result['phone'] = 'ok') {
                                if ($picture != '') {
                                    if (strpos($picture, 'data:image/png;base64') === 0) {
                                        $picture = str_replace(array('data:image/png;base64,', ' '), array('', '+'), $picture);
                                        $data = base64_decode($picture);
                                        $file = 'uploads/avatars/' . md5($picture) . '.png';
                                        if (file_put_contents($file, $data)) {
                                            $params['photo'] = $file;
                                            $this->User_model->update_user($id, $params);
                                            $result['status'] = 'success';
                                        }
                                    }
                                } else {
                                    $this->User_model->update_user($id, $params);
                                    $result['status'] = 'success';
                                }
                            }
                        }
                    }
                    else {

                        if ($picture != '') {
                            if (strpos($picture, 'data:image/png;base64') === 0) {
                                $picture = str_replace(array('data:image/png;base64,', ' '), array('', '+'), $picture);
                                $data = base64_decode($picture);
                                $file = 'uploads/avatars/' . md5($picture) . '.png';
                                if (file_put_contents($file, $data)) {
                                    $params['photo'] = $file;
                                    $this->User_model->update_user($id, $params);
                                    $result['status'] = 'success';
                                }
                            }
                        } else {
                            $this->User_model->update_user($id, $params);
                            $result['status'] = 'success';
                        }
                    }

			}

			if ($total == 'land') {
				$params = array(
					'landnum' => $this->input->post('landnum'),
					'detail' => $this->input->post('detail'),
					'type' => $this->input->post('type'),
					'block' => $this->input->post('block'),
					'price' => $this->input->post('price'),
					'area' => $this->input->post('area')
				);
				$picture = $this->input->post('image');
				if (strpos($picture, 'data:image/png;base64') === 0) {
					$picture = str_replace(array('data:image/png;base64,', ' '), array('', '+'), $picture);
					$data = base64_decode($picture);
					$file = 'uploads/lands/' . md5($picture) . '.png';
					if (file_put_contents($file, $data)) {
						$params['map'] = $file;
						$path = './uploads/lands/';
						$config['upload_path'] = $path;
						$config['allowed_types'] = 'mp4';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('video')) {

						} else {
							$path = $this->upload->data();
							$params['intro'] = 'uploads/lands/' . $path['file_name'];
						}
						$this->load->model('Land_model');
						$this->Land_model->add_land($params);
						$result['status'] = 'success';
					}
				}
			}
		}
		echo json_encode($result);
	}

	/**
	 * Destination processing module
	 * @param string $com
	 */
	public function block($com = 'list') {
		$this->load->model('Blocks_model');
		if ($com == 'list') {
			$province = $this->input->post('province');
			$city = $this->input->post('city');
			if ($province == -1) {
				$result['blocks'] = $this->Blocks_model->list_blocks();
			} else {
				if ($city == -1)
					$result['blocks'] = $this->Blocks_model->list_blocks($province);
				else
					$result['blocks'] = $this->Blocks_model->list_blocks($province, $city);
			}
			echo json_encode($result);
		} elseif ($com == 'update') {
//			$this->Blocks_model->update_city($this->input->post('id'), array('name' => $this->input->post('name')));
//			echo json_encode(array('status' => 'success'));
		} else {

		}
	}

	/**
	 * Land processing module
	 * @param string $com
	 * @param string $sub
	 */
	public function land($com = 'type', $sub = 'list') {
		if ($com == 'type') {
			$this->load->model('Land_type_model');
			if ($sub == 'list') {
				$data = $row = array();

				$typeData = $this->Land_type_model->getRows($_POST);

				foreach($typeData as $type){
					$status = ($type->usage == 1)?'使用中':'没使用';
					$data[] = array($type->id, $type->value, $status, null);
				}

				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Land_type_model->countAll(),
					'recordsFiltered' => $this->Land_type_model->countFiltered($_POST),
					'data' => $data,
				);

				echo json_encode($output);
			} elseif ($sub == 'update') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$params = array();
					$id = $this->input->post('id');
					foreach ($_POST as $key => $value) {
						if ($key == 'id') continue;
						$params[$key] = $this->input->post($key);
					}
					$this->Land_type_model->update_land_type($id, $params);
					$result['status'] = 'success';
				}

				echo json_encode($result);
			} elseif ($sub == 'available') {
				$result['types'] = $this->Land_type_model->get_all_available();
				echo json_encode($result);
			} elseif ($sub == 'new') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$this->Land_type_model->add_land_type(array('value' => $this->input->post('value')));
					$result['status'] = 'success';
				}

				echo json_encode($result);
			}
		} elseif ($com == 'list') {
			mb_internal_encoding('UTF-8');

			$maxLength = 40;

			$this->load->model('Land_type_model');
			$data = $this->Land_type_model->get_all_land_type();
			$types = array();
			foreach ($data as $row) {
				$types[$row['id']] = $row['value'];
			}

			$this->load->model('Blocks_model');
			$data = $this->Blocks_model->get_all_blocks();
			$blocks = array();
			foreach ($data as $row) {
				$blocks[$row['id']] = $row['name'];
			}

			$this->load->model('User_model');
			$data = $this->User_model->get_all_users();
			$users = array();
			foreach ($data as $row) {
				$users[$row['id']] = $row['fullname'];
			}

			$this->load->model('Land_model');
			$data = $row = array();

			$lands = $this->Land_model->getRows($_POST);

			foreach($lands as $land){
				if ($land->owner == null)
					$user = '';
				else
					$user = $users[$land->owner];

				if ($land->owner == null)
					$status = '可售';
				else {
					if ($land->sold_at == null)
						$status = '正在出售';
					else
						$status = '已出售';
				}
				$detail = $land->detail;
				if (mb_strlen($detail) > $maxLength)
					$detail = mb_substr($detail, 0, $maxLength) . '。。。';
				$data[] = array($land->id, $land->map, $land->landnum, $types[$land->type], $blocks[$land->block], $detail, $user, ($land->sold_at)?date( 'Y年m月d日', strtotime($land->sold_at)):'', $status, null);
			}

			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->Land_model->countAll(),
				'recordsFiltered' => $this->Land_model->countFiltered($_POST),
				'data' => $data,
			);

			echo json_encode($output);
		} elseif ($com === 'update') {
			$result = array('status' => 'fail');
			
			if ($this->post_exist()) {
				$this->load->model('Land_model');
				
				$id = $this->input->post('id');
				$land = $this->Land_model->get_land($id);
				if ($land['owner'] || $land['sold_at']) {
					if ($land['owner'] && $land['sold_at']) {
						$result['reason'] = '无法删除此土地。它由用户拥有。';
					} else {
						$result['reason'] = '无法删除此土地。它正在处理中。';
					}
				} else {
					$this->Land_model->update_land($id, array('status' => $this->input->post('status')));
					$result['status'] = 'success';
				}
			}
			
			echo json_encode($result);
		}
	}

	/**
	 * Task processing module
	 * @param string $com
	 * @param string $sub
	 */
	public function task($com = 'category', $sub = 'list') {
		if ($com === 'category') {
			$this->load->model('Task_category_model');
			if ($sub === 'list') {
				$data = $row = array();

				$typeData = $this->Task_category_model->getRows($_POST);

				foreach($typeData as $type){
					$status = ($type->usage == 1)?'使用中':'没使用';
					$data[] = array($type->id, $type->name, $status, null);
				}

				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Task_category_model->countAll(),
					'recordsFiltered' => $this->Task_category_model->countFiltered($_POST),
					'data' => $data,
				);

				echo json_encode($output);
			} elseif ($sub === 'update') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$params = array();
					$id = $this->input->post('id');
					foreach ($_POST as $key => $value) {
						if ($key === 'id') continue;
						$params[$key] = $this->input->post($key);
					}
					$this->Task_category_model->update_task_category($id, $params);
					$result['status'] = 'success';
				}

				echo json_encode($result);
			} elseif ($sub === 'available') {
				$result['types'] = $this->Task_category_model->get_all_available();
				echo json_encode($result);
			} elseif ($sub === 'new') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$this->Task_category_model->add_task_category(array('name' => $this->input->post('value')));
					$result['status'] = 'success';
				}

				echo json_encode($result);
			}
		} elseif ($com === 'status') {
			$this->load->model('Task_status_model');
			if ($sub === 'list') {
				$data = $row = array();

				$typeData = $this->Task_status_model->getRows($_POST);

				foreach($typeData as $type){
					$status = ($type->usage == 1)?'使用中':'没使用';
					$data[] = array($type->id, $type->name, $status, null);
				}

				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Task_status_model->countAll(),
					'recordsFiltered' => $this->Task_status_model->countFiltered($_POST),
					'data' => $data,
				);

				echo json_encode($output);
			} elseif ($sub === 'update') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$params = array();
					$id = $this->input->post('id');
					foreach ($_POST as $key => $value) {
						if ($key === 'id') continue;
						$params[$key] = $this->input->post($key);
					}
					$this->Task_status_model->update_task_statu($id, $params);
					$result['status'] = 'success';
				}

				echo json_encode($result);
			} elseif ($sub === 'available') {
				$result['types'] = $this->Task_status_model->get_all_available();
				echo json_encode($result);
			} elseif ($sub === 'new') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$this->Task_status_model->add_task_statu(array('name' => $this->input->post('value')));
					$result['status'] = 'success';
				}

				echo json_encode($result);
			}
		} elseif ($com === 'type') {
			$this->load->model('Task_type_model');
			if ($sub === 'list') {
				$this->load->model('Task_category_model');
				$data = $this->Task_category_model->get_all_task_categories();
				$cateData = array();
				foreach($data as $row) {
					$cateData[$row['id']] = $row['name'];
				}

				$data = $row = array();

				$typeData = $this->Task_type_model->getRows($_POST);

				foreach($typeData as $type) {
					$status = ($type->usage == 1)?'使用中':'没使用';
					$data[] = array($type->id, $type->name, $cateData[$type->category], '¥' . $type->cost, $status, null);
				}

				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Task_type_model->countAll(),
					'recordsFiltered' => $this->Task_type_model->countFiltered($_POST),
					'data' => $data,
				);

				echo json_encode($output);
			} elseif ($sub === 'update') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$params = array();
					$id = $this->input->post('id');
					foreach ($_POST as $key => $value) {
						if ($key === 'id') {
							continue;
						}
						$params[$key] = $this->input->post($key);
					}
					$this->Task_type_model->update_task_type($id, $params);
					$result['status'] = 'success';
					$result['post'] = $this->input->post();
				}

				echo json_encode($result);
			} elseif ($sub === 'available') {
				$result['types'] = $this->Task_type_model->get_all_available();
				echo json_encode($result);
			} elseif ($sub === 'new') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$this->Task_type_model->add_task_type(array('name' => $this->input->post('value'), 'cost' => $this->input->post('cost'), 'category' => $this->input->post('category')));
					$result['status'] = 'success';
				}

				echo json_encode($result);
			}
		} elseif ($com === 'all') {
			$this->load->model('Task_model');
			if ($sub === 'list') {
				$data = $row = array();

				$taskData = $this->Task_model->getRows($_POST);

				$this->load->model('User_model');
				$users = array();
				$this->load->model('Task_type_model');
				$tdata = $this->Task_type_model->get_all_available();
				$types = array();
				foreach ($tdata as $tdatum) {
					$types[$tdatum['id']] = $tdatum['name'];
				}
				$this->load->model('Task_status_model');
				$arrs = array();
				$sdata = $this->Task_status_model->get_all_available();
				foreach ($sdata as $sdatum) {
					$arrs[$sdatum['id']] = $sdatum['name'];
				}
				$this->load->model('Land_model');
				$lands = array();

				foreach ($taskData as $task) {
					if (isset($users[$task->user])) {
						$user = $users[$task->user];
					} else {
						$udata = $this->User_model->get_user($task->user);
						$phone = substr_replace($udata['phone'],'****',3,4);
						$user = $udata['fullname'] . '(' . $phone . ')';
						$users[$task->user] = $user;
					}
					if (isset($lands[$task->land])) {
						$land = $lands[$task->land];
					} else {
						$ldata = $this->Land_model->get_land($task->land);
						$land = $ldata['landnum'];
						$lands[$task->land] = $land;
					}
					$updated = date( 'Y年m月d日', strtotime($task->updated_at));
					$data[] = array($task->id, $user, $land, $types[$task->type], $task->description, $arrs[$task->status], $updated, null);
				}

				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Task_model->countAll(),
					'recordsFiltered' => $this->Task_model->countFiltered($_POST),
					'data' => $data,
				);

				echo json_encode($output);
			} elseif ($sub === 'update') {
				$result = array('status' => 'fail');

				if ($this->post_exist()) {
					$id = $this->input->post('id');

					$params = array(
						'status' => $this->input->post('status'),
						'updated_at' => date("Y-m-d H:i:s")
					);

					$this->Task_model->update_task($id, $params);
					$result['status'] = 'success';
				}

				echo json_encode($result);
			}
		}
	}

	/**
	 * Product processing module
	 * @param string $com
	 * @param string $sub
	 */
	public function product($com = 'unit', $sub = 'list') {
		if ($com == 'unit') {
			$this->load->model('Unit_model');
			if ($sub == 'list') {
				$data = $row = array();

				$typeData = $this->Unit_model->getRows($_POST);

				foreach($typeData as $type){
					$status = ($type->usage == 1)?'使用中':'没使用';
					$data[] = array($type->id, $type->name, $status, null);
				}
				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Unit_model->countAll(),
					'recordsFiltered' => $this->Unit_model->countFiltered($_POST),
					'data' => $data,
				);
				echo json_encode($output);
			} elseif ($sub == 'update') {
				$result = array('status' => 'fail');
				if ($this->post_exist()) {
					$params = array();
					$id = $this->input->post('id');
					foreach ($_POST as $key => $value) {
						if ($key == 'id') continue;
						$params[$key] = $this->input->post($key);
					}
					$this->Unit_model->update_unit($id, $params);
					$result['status'] = 'success';
				}
				echo json_encode($result);
			} elseif ($sub == 'available') {
				$result['types'] = $this->Unit_model->get_all_available();
				echo json_encode($result);
			} elseif ($sub == 'new') {
				$result = array('status' => 'fail');
				if ($this->post_exist()) {
					$this->Unit_model->add_unit(array('name' => $this->input->post('value')));
					$result['status'] = 'success';
				}
				echo json_encode($result);
			}
		} elseif ($com == 'type') {
			$this->load->model('Product_type_model');
			if ($sub == 'list') {
				$data = $row = array();

				$typeData = $this->Product_type_model->getRows($_POST);

				foreach($typeData as $type){
					$status = ($type->usage == 1)?'使用中':'没使用';
					$data[] = array($type->id, $type->name, $status, null);
				}
				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Product_type_model->countAll(),
					'recordsFiltered' => $this->Product_type_model->countFiltered($_POST),
					'data' => $data,
				);
				echo json_encode($output);
			} elseif ($sub == 'update') {
				$result = array('status' => 'fail');
				if ($this->post_exist()) {
					$params = array();
					$id = $this->input->post('id');
					foreach ($_POST as $key => $value) {
						if ($key == 'id') continue;
						$params[$key] = $this->input->post($key);
					}
					$this->Product_type_model->update_product_type($id, $params);
					$result['status'] = 'success';
				}
				echo json_encode($result);
			} elseif ($sub == 'available') {
				$result['types'] = $this->Product_type_model->get_all_available();
				echo json_encode($result);
			} elseif ($sub == 'new') {
				$result = array('status' => 'fail');
				if ($this->post_exist()) {
					$this->Product_type_model->add_product_type(array('name' => $this->input->post('value')));
					$result['status'] = 'success';
				}
				echo json_encode($result);
			}
		} elseif ($com == 'request') {
			$this->load->model('Request_model');
			$this->load->model('User_model');
			if ($sub == 'all') {
				$data = $row = array();

				$reqData = $this->Request_model->getRows($_POST);

				foreach($reqData as $row) {
					$user = $this->User_model->get_user($row->requester);
					$status = '';
					if ($row->status == 0) {
						$status = '待定';
					}
					if ($row->status == 1) {
						$status = '批准的';
					}
					if ($row->status == 2) {
						$status = '拒绝了';
					}
					$data[] = array($row->id, $user['fullname'], $row->charger, $row->phone, date( 'Y年m月d日', strtotime($row->requested_at)), $status, null, $user['photo']);
				}
				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Request_model->countAll(),
					'recordsFiltered' => $this->Request_model->countFiltered($_POST),
					'data' => $data,
				);
				echo json_encode($output);
			} elseif ($sub == 'update') {
				$result = array('status' => 'fail');
				if ($this->post_exist()) {
					$id = $this->input->post('id');
					$status = $this->input->post('status');
					$this->Request_model->update_request($id, array('status' => $status));
					if ($status == 1) {
						$mall_id = 'DP' . $this->getUID();
						$request = $this->Request_model->get_request($id);
						$params = array(
							'unique' => $mall_id,
							'owner' => $request['requester'],
							'created_at' => date("Y-m-d H:i:s")
						);
						$this->load->model('Malls_model');
						$this->Malls_model->add_mall($params);
					}
					$result['status'] = 'success';
				}
				echo json_encode($result);
			}
		} elseif ($com == 'all') {
			$this->load->model('Product_model');
			$this->load->model('Malls_model');
			$this->load->model('User_model');
			$this->load->model('Product_type_model');

			$malls = array(); $rows = $this->Malls_model->get_all_malls();
			foreach ($rows as $row) {
				$malls[$row['id']] = $row['owner'];
			}

			$users = array(); $rows = $this->User_model->get_all_users();
			foreach ($rows as $row) {
				$users[$row['id']] = array('name' => $row['username'], 'photo' => ($row['photo'])?:'uploads/avatars/default.png');
			}

			$types = array(); $rows = $this->Product_type_model->get_all_product_types();
			foreach ($rows as $row) {
				$types[$row['id']] = $row['name'];
			}

			$data = $row = array();
			$products = $this->Product_model->getRows($_POST);

			foreach($products as $product) {
				$data[] = array($product->id, $product->image, $types[$product->type], $product->name, date( 'Y年m月d日', strtotime($product->updated_at)), $users[$malls[$product->mall]]['name'], $product->status, null, $users[$malls[$product->mall]]['photo']);
			}

			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->Product_model->countAll(),
				'recordsFiltered' => $this->Product_model->countFiltered($_POST),
				'data' => $data,
			);

			echo json_encode($output);
		} elseif ($com == 'update') {
			$result = array('status' => 'fail');

			if ($this->post_exist()) {
				$this->load->model('Product_model');

				$params = array();
				$messages = array();

				$id = $this->input->post('id');

				foreach ($_POST as $key => $value) {
					if ($key == 'id') continue;
					$params[$key] = $this->input->post($key);
				}

				$this->Product_model->update_product($id, $params);
				$result['status'] = 'success';
			}

			echo json_encode($result);
		}
	}

	/**
	 * Camera channel processing module
	 * @param string $com
	 */
	public function channel($com = 'add') {
		$this->load->model('Channel_model');
		if ($com === 'add') {
			$result = array('status' => 'fail');
			if ($this->post_exist()) {
				$params = array();
				foreach ($_POST as $key => $value) {
					$params[$key] = $this->input->post($key);
				}
				$this->Channel_model->add_channel($params);
				$result['status'] = 'success';
			}
			echo json_encode($result);
		} elseif ($com === 'update') {
			$result = array('status' => 'fail');
			if ($this->post_exist()) {
				$params = array();
				$id = $this->input->post('id');
				foreach ($_POST as $key => $value) {
					if ($key == 'id') continue;
					$params[$key] = $this->input->post($key);
				}
				$this->Channel_model->update_channel($id, $params);
				$result['status'] = 'success';
			}
			echo json_encode($result);
		} elseif ($com === 'all') {
			$data = array();

			$channels = $this->Channel_model->getRows($_POST);

			foreach($channels as $channel){
				$status = '';
				if ($channel->rtmp) {
					$status .= 'RTMP, ';
				}
				if ($channel->hls) {
					$status .= 'HLS, ';
				}
				if ($channel->ws) {
					$status .= 'WS, ';
				}
				$status = substr($status,0,-2);
				$data[] = array($channel->id, $channel->title, $status, null);
			}

			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->Channel_model->countAll(),
				'recordsFiltered' => $this->Channel_model->countFiltered($_POST),
				'data' => $data,
			);

			echo json_encode($output);
		}
	}

	/**
	 * Camera channel linkage processing module
	 * @param string $com
	 */
	public function binding($com = 'list') {
		$this->load->model('Bindings_model');
		if ($com === 'list') {
			$data = $this->Bindings_model->get_bindings_by_land_back($this->input->post('land'));
			$channels = array();
			foreach ($data as $datum) {
				$channels[] = $datum['channel'];
			}
			echo json_encode($channels);
		} elseif ($com === 'update') {
			$data = array('route' => 'nope');

			$land = $this->input->post('land');
			$this->Bindings_model->delete_bindings($land);
			$ids = $this->input->post('ids');
			if (strlen($ids) > 0) {
				if (strpos($ids, ',') !== false) {
					$ids = explode(',', $ids);
					foreach ($ids as $id) {
						$this->Bindings_model->add_binding(array(
							'land' => $land,
							'channel' => $id
						));
					}
					$data['route'] = 'Multi';
				} else {
					$this->Bindings_model->add_binding(array(
						'land' => $land,
						'channel' => $ids
					));
					$data['route'] = 'Single';
				}
			}

			echo json_encode($data);
		}
	}

	/**
	 * Order processing module
	 * @param string $com
	 * @param string $sub
	 */
	public function order($com = 'land', $sub = 'list') {
		$this->load->model('Order_model');
		if ($com === 'land') {
			$this->load->model('Land_model');
			if ($sub === 'list') {
				$data = array();

				$orders = $this->Order_model->getRows($_POST, 1);

				$this->load->model('User_model');

				foreach ($orders as $order) {
					$user = $this->User_model->get_user($order->user);
					$land = $this->Land_model->get_land($order->land);
					$data[] = array($order->id, $order->orderno, $user['fullname'], $land['landnum'], $land['price'], $order->total, date( 'Y年m月d日', strtotime($order->created_at)), $order->status, $order->remark, null, $user['id'], $land['id']);
				}

				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Order_model->countAll(1),
					'recordsFiltered' => $this->Order_model->countFiltered($_POST, 1),
					'data' => $data,
				);

				echo json_encode($output);
			} elseif ($sub === 'get') {
				$id = $this->input->post('id');
				$data = $this->Order_model->get_order($id);
				echo json_encode($data);
			} elseif ($sub === 'update') {
				$ts = date('Y-m-d H:i:s');
				$id = $this->input->post('id');
				$params = array(
					'status' => $this->input->post('status'),
					'remark' => $this->input->post('remark'),
					'created_at' => $ts
				);
				$this->Order_model->update_order($id, $params);

				$id = $this->input->post('land');
				$this->Land_model->update_land($id, array('sold_at' => $ts));

				$land = $this->Land_model->get_land($id);
				$params = array(
					'order' => $this->input->post('id'),
					'total' => $land['price'],
					'site' => $land['price'],
					'created_at' => $ts
				);
				$this->load->model('Income_model');
				$this->Income_model->add_income($params);
			}
		} elseif ($com === 'product') {
			if ($sub === 'list') {
				$data = array();
				
				$status = $this->input->post("status");
				$orders = $this->Order_model->getRows_status($_POST, $status );

				$this->load->model('User_model');
				$this->load->model('Product_model');
				$this->load->model('Coupon_model');
				$this->load->model('Destination_model');

				foreach ($orders as $order) {
					$user = $this->User_model->get_user($order->user);
					$products = $this->decodeArray($order->product);
					$result = '';
					foreach ($products as $product) {
						$prod = $this->Product_model->get_product($product['id']);
						if ($result === '') {
							$result = '<div style="width: 48px; height: 48px; position: relative; float: left;"><img src="../../' . $prod['image'] . '" style="width: 48px; height: 48px;" alt="产品封面"/><span class="badge badge-pill badge-default badge-info badge-default" style="position: absolute; top: -9px; right: -13px; z-index: 999;">' . $product['amount'] . '</span></div>';
						}
						else {
							$result .= ('<div style="width: 48px; height: 48px; position: relative; float: left; margin-left: 15px;"><img src="../../' . $prod['image'] . '" style="width: 48px; height: 48px;" alt="产品封面"/><span class="badge badge-pill badge-default badge-info badge-default" style="position: absolute; top: -9px; right: -13px; z-index: 999;">' . $product['amount'] . '</span></div>');
						}
					}
					$coup = $this->Coupon_model->get_coupon($order->coupon);
					$dist = $this->Destination_model->get_detail($order->destination);
					$data[] = array($order->id, $order->orderno, $user['fullname'], $result, $order->total, $order->delivery, ($coup)?$coup['amount']:'0', $order->status, date('Y年m月d日', strtotime($order->created_at)), $dist['province'] . $dist['city'] . $dist['district'] . $dist['detail'], ($order->remark)?:'', null, $user['id'], $order->product, ($order->delivery_no)?:'', ($order->delivery_remark)?:'');
				}

				$output = array(
					'draw' => $_POST['draw'],
					'recordsTotal' => $this->Order_model->countAll(),
					'recordsFiltered' => $this->Order_model->countFilteredStatus($_POST, $status ),
					'data' => $data,
				);

				echo json_encode($output);
			} elseif ($sub === 'update') {
				$id = $this->input->post('id');
				$prev = (int)$this->input->post('prev');
				$status = (int)$this->input->post('status');
				$remark = $this->input->post('remark');

				$this->Order_model->update_order(
					$id,
					array(
						'status'    => $status,
						'remark'    => $remark,
						'created_at'=> date('Y-m-d H:i:s')
					)
				);

				$this->load->model('Income_model');
				$this->load->model('Product_model');
				$this->load->model('Malls_model');

				$params = array(
					'order' => $id,
					'created_at'=> date('Y-m-d H:i:s')
				);
				$order = $this->Order_model->get_order($id);
				$products = $this->decodeArray($order['product']);
				$total = 0.0; $seller = 0;
				foreach ($products as $product) {
					$prod = $this->Product_model->get_product($product['id']);
					$total += ((float)$prod['price'] * (float)$product['amount']);
					$seller = $prod['mall'];
				}
				$seller = $this->Malls_model->get_mall($seller);
				$params['seller'] = $seller['owner'];
				if ($status === 3) {
					$params['total'] = $order['total'];
					$params['real'] = round($total * (1.0 - (float)$this->getVar('seller_fee')), 2, PHP_ROUND_HALF_DOWN);
					$params['site'] =(float)$order['total'] - $params['real'];
				} elseif ($status === 5 && $prev !== 0) {
					$params['total'] = $order['delivery'];
					$params['real'] = 0;
					$params['site'] =$order['delivery'];
				}
				$this->Income_model->add_income($params);
			}
			elseif ($sub === 'delivery') {
				$this->Order_model->update_order(
					$this->input->post('order_id'),
					array(
						'delivery_no'     => $this->input->post('delivery_no'),
						'delivery_remark' => $this->input->post('delivery_remark')
					)
				);
			}
		} elseif ($com === 'check') {
			$result = $this->Order_model->new_orders();
			echo json_encode(array('orders' => $result));
		}
	}

	/**
	 * Coupon processing module
	 * @param string $com
	 */
	public function coupon($com = 'generate') {
		$this->load->model('Coupon_model');
		if ($com === 'generate') {
			$code = 'YH' . $this->getUID();
			$amount = $this->input->post('amount');
			if ($amount) {

			} else {
				$level = $this->input->post('level');
				$amount = $this->getVar('coupon_auto_level' . $level);
			}

			$id = $this->Coupon_model->add_coupon(
				array(
					'code' => $code,
					'amount' => $amount
				)
			);

			echo json_encode(array('id' => $id));
		}
	}

	/**
	 * Point processing module
	 * @param string $com
	 */
	public function point($com = 'generate') {

	}

	/**
	 * Income processing module
	 * @param string $com
	 */
	public function income($com = 'list') {
		$this->load->model('Income_model');
		if ($com === 'list') {
			$data = array();

			$incomes = $this->Income_model->getRows($_POST);

			$this->load->model('User_model');
			$this->load->model('Order_model');

			foreach ($incomes as $income) {
				if ($income->seller) {
					$user = $this->User_model->get_user($income->seller);
				}
				$order = $this->Order_model->get_order($income->order);
				$data[] = array($income->id, $order['orderno'], ($income->seller)?$user['fullname']:'', $income->total, $income->real, $income->site, date( 'Y年m月d日', strtotime($income->created_at)), null);
			}

			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->Income_model->countAll(),
				'recordsFiltered' => $this->Income_model->countFiltered($_POST),
				'data' => $data,
			);

			echo json_encode($output);
		}
	}

	/**
	 * Withdraw processing module
	 * @param string $com
	 * @param null $sub
	 */
	public function withdraw($com = 'list', $sub = null) {
		$this->load->model('Withdraw_model');
		if ($com === 'list') {
			$data = array();

			$withdraws = $this->Withdraw_model->getRows($_POST, $sub);

			$this->load->model('User_model');
			$this->load->model('Card_model');

			foreach ($withdraws as $withdraw) {
				$user = $this->User_model->get_user($withdraw->user);
				$card = $this->Card_model->get_card($withdraw->card);
				$total = (double)$withdraw->amount;
				$commission = (double)$withdraw->site;
				if ($commission < 0.01) {
					$real = round($total * (1.0 - (double)$this->getVar('withdraw_fee')), 2, PHP_ROUND_HALF_DOWN);
					$commission = round($total - $real, 2);
				} else {
					$real = round($total - $commission, 2);
				}
				$data[] = array($withdraw->id, $user['fullname'], $card['number'], $withdraw->amount, $real, $commission, date( 'Y年m月d日', strtotime($withdraw->updated_at)), $withdraw->status, null);
			}

			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->Withdraw_model->countAll($sub),
				'recordsFiltered' => $this->Withdraw_model->countFiltered($_POST, $sub),
				'data' => $data,
			);

			echo json_encode($output);
		} elseif ($com === 'update') {
			$result = array('status' => 'fail');

			if ($this->post_exist()) {
				$params = array();
				$id = $this->input->post('id');
				$status = (int)$this->input->post('status');
				$params['status'] = $status;
				if ($status === 1) {
					$withdraw = $this->Withdraw_model->get_withdraw_by_id($id);
					$total = (double)$withdraw['amount'];
					$real = round($total * (1.0 - (double)$this->getVar('withdraw_fee')), 2, PHP_ROUND_HALF_DOWN);
					$site = round($total - $real, 2);
					$params['site'] = $site;
				}
				$this->Withdraw_model->update_withdraw($id, $params);
				$result['status'] = 'success';
			}

			echo json_encode($result);
		}
	}

	/**
	 * Income processing module
	 */
	public function secret() {
		$user = $this->user->getId();
		$level = (int)$this->user->getLevel();

		$this->load->model('User_model');
		$data = $this->User_model->get_user($user);

		$rolls = (int)$data['rolls'];
		$daily = (int)$data['daily'];
		if ($daily + $rolls < 1) {
			echo json_encode(array('status' => 'no'));
		} else {
			$level1 = array(111);
			$level2 = array(222);
			$level3 = array(333, 444, 555, 666, 777, 888);
			$level4 = array(112, 113, 114, 115, 116, 117, 118, 122, 133, 144, 155, 166, 177, 188, 223, 224, 225, 226, 227, 228, 233, 244, 255, 266, 277, 288, 334, 335, 336, 337, 338, 344, 355, 366, 377, 388, 445, 446, 447, 448, 455, 466, 477, 488, 556, 557, 558, 566, 577, 588, 667, 668, 677, 688, 778, 788);
			$level5 = array(123, 124, 125, 126, 127, 128, 134, 135, 136, 137, 138, 145, 146, 147, 148, 156, 157, 158, 167, 168, 178, 234, 235, 236, 237, 238, 245, 246, 247, 248, 256, 257, 258, 267, 268, 278, 345, 346, 347, 348, 356, 357, 358, 367, 368, 378, 456, 457, 458, 467, 468, 478, 567, 568, 578, 678);
			$seeds = $level1;

			$seeds = array_merge($seeds, $level2);
			$seeds = array_merge($seeds, $level2);
			$seeds = array_merge($seeds, $level2);
			$seeds = array_merge($seeds, $level2);
			$seeds = array_merge($seeds, $level2);

			$seeds = array_merge($seeds, $level3);
			$seeds = array_merge($seeds, $level3);
			$seeds = array_merge($seeds, $level3);
			$seeds = array_merge($seeds, $level3);
			$seeds = array_merge($seeds, $level3);

			$seeds = array_merge($seeds, $level4);
			$seeds = array_merge($seeds, $level4);

			$seeds = array_merge($seeds, $level5);
			$seeds = array_merge($seeds, $level5);
			$seeds = array_merge($seeds, $level5);
			$seeds = array_merge($seeds, $level5);
			$seeds = array_merge($seeds, $level5);
			$seeds = array_merge($seeds, $level5);
			$seeds = array_merge($seeds, $level5);

			shuffle($seeds);

			$result = array_rand($seeds);
			$result = $seeds[$result];

			if (in_array($result, $level1, true) || in_array($result, $level2, true) || in_array($result, $level3, true) || in_array($result, $level4, true)) {
				if ($level > 0) {
					$threshold = (int)(100.0 * (float)$this->getVar('probability_special'));
				} else {
					$threshold = (int)(100.0 * (float)$this->getVar('probability_common'));
				}
				if (rand(0, 100) > $threshold) {
					$result = $level5[array_rand($level5)];
				}
			}

			$orders = array('012', '021', '102', '120', '201', '210');
			$order = $orders[array_rand($orders)];

			if ($daily > 0) {
				$this->User_model->update_user($user, array('daily' => 0));
			} else {
				$rolls--;
				$this->User_model->update_user($user, array('daily' => 0));
			}

			echo json_encode(array('status' => 'ok', 'seed' => substr($result, (int)substr($order, 0, 1), 1) . substr($result, (int)substr($order, 1, 1), 1) . substr($result, (int)substr($order, 2, 1), 1)));
		}
	}

	/**
	 * Game processing module
	 * @param string $com
	 */
	public function game($com = 'save') {
		$v1 = $this->input->post('v1');
		$v2 = $this->input->post('v2');
		$v3 = $this->input->post('v3');
		$v4 = $this->input->post('v4');

		$this->load->model('Reward_model');
		$this->Reward_model->update_reward(1, array('values' => $v1));
		$this->Reward_model->update_reward(2, array('values' => $v2));
		$this->Reward_model->update_reward(3, array('values' => $v3));
		$this->Reward_model->update_reward(4, array('values' => $v4));
	}
}
