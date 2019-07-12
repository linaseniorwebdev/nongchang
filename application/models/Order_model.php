<?php

class Order_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct();

		$this->table = 'orders';
		$this->column_order = array(null, 'id', 'orderno', 'user', 'product', 'land', 'total', 'delivery', 'coupon', 'destination', 'remark', 'created_at', 'status');
		$this->column_search = array('orderno');
		$this->order = array('id' => 'asc');
	}

	public function getRows($postData, $land = 0) {
		$this->_get_datatables_query($postData, $land);
		$this->db->where('type', $land);
		if ($postData['length'] != -1) {
			$this->db->limit($postData['length'], $postData['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}
	public function getRows_status($postData, $status = "", $land = 0) {
		$this->_get_datatables_query($postData, $land);
		$this->db->where('type', $land);
		if ($postData['length'] != -1) {
			$this->db->limit($postData['length'], $postData['start']);
		}

		$tmp_columns = $postData["columns"];
		$status_item = $tmp_columns[7];
		$status = $status ? $status : $status_item["search"]["value"];

		if ($status != "")
			$this->db->where('status', $status);
		$query = $this->db->get();
		return $query->result();
	}
	public function countAll($land = 0) {
		$this->db->from($this->table);
		$this->db->where('type', $land);
		return $this->db->count_all_results();
	}

	public function countFiltered($postData, $land = 0) {
		$this->_get_datatables_query($postData);
		$this->db->where('type', $land);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countFilteredStatus($postData, $status = 0, $land=0){
		$this->_get_datatables_query($postData);
		$this->db->where('type', $land);
		$tmp_columns = $postData["columns"];
		$status_item = $tmp_columns[7];
		$status = $status ? $status : $status_item["search"]["value"];

		if ($status != "")
			$this->db->where('status', $status);		
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function _get_datatables_query($postData) {
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) {
			// if datatable send POST for search
			if($postData['search']['value']){
				// first loop
				if ($i == 0) {
					$this->db->group_start();
					$this->db->like($item, $postData['search']['value']);
				} else {
					$this->db->or_like($item, $postData['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if(isset($postData['order'])) {
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		} else if(isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	/**
	 * Get order by id
	 * @param $id
	 * @return array
	 */
	public function get_order($id) {
		return $this->db->get_where('orders', array('id' => $id))->row_array();
	}

	/**
	 * Get all orders
	 */
	public function get_all_orders() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('orders')->result_array();
	}

	/**
	 * Get user orders
	 * @param $user
	 * @param null $status
	 * @return array
	 */
    public function get_user_orders($user, $status = null) {
	    $this->db->from('orders');
	    $this->db->where('user', $user);
	    $this->db->where('type', 0);
	    if ($status) {
		    $this->db->where('status', $status);
	    }
	    $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_user_order0($user, $status = 0) {
        $this->db->from('orders');
        $this->db->where('user', $user);
        $this->db->where('type', 0);
        $this->db->where('status', $status);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

	/**
	 * Function to add new order
	 * @param $params
	 * @return int
	 */
	public function add_order($params) {
		$this->db->insert('orders', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update order
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_order($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('orders', $params);
	}

	/**
	 * Function to delete order
	 * @param $id
	 * @return mixed
	 */
	public function delete_order($id) {
		return $this->db->delete('orders', array('id' => $id));
	}
	
	/**
	 * Get order by id
	 * @param $id
	 * @return mixed
	 */
	public function get_extra_information($id) {
		$query = 'SELECT destinations.id, provinces.name AS province, cities.name AS city, districts.name AS district, destinations.detail FROM destinations, provinces, cities, districts WHERE destinations.district = districts.id AND districts.city = cities.id AND cities.province = provinces.id AND destinations.id = ' . $id . ';';
		return $this->db->query($query)->row_array();
	}
	
	/**
	 * Check for new orders
	 */
	public function new_orders() {
		$result = '';
		$rows = $this->db->get_where('orders', array('read' => 0))->result_array();
		foreach ($rows as $row) {
			if (strlen($result) < 1) {
				$result = $row['orderno'];
			} else {
				$result .= ('，' . $row['orderno']);
			}
			$this->update_order($row['id'], array('read' => 1));
		}
		return $result;
	}
}
