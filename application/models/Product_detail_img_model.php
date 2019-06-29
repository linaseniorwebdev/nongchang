<?php

class Product_detail_img_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct();

		$this->table = 'product_detail_img';
		$this->column_order = array(null, 'id');
		$this->column_search = array('name');
		$this->order = array('id' => 'asc');
	}

	function getRows($postData) {
		$this->_get_datatables_query($postData);
		if($postData['length'] != -1){
			$this->db->limit($postData['length'], $postData['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function countAll() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function countFiltered($postData) {
		$this->_get_datatables_query($postData);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function _get_datatables_query($postData) {
		$this->db->from($this->table);
		$i = 0;
		foreach($this->column_search as $item) {
			// if datatable send POST for search
			if($postData['search']['value']){
				// first loop
				if ($i == 0) {
					$this->db->group_start();
					$this->db->like($item, $postData['search']['value']);
				} else
					$this->db->or_like($item, $postData['search']['value']);

				if(count($this->column_search) - 1 == $i)
					$this->db->group_end();
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
	 * Get product by id
	 * @param $id
	 * @return array
	 */
	public function get_product($id) {
		return $this->db->get_where('product_detail_img', array('id' => $id))->row_array();
	}

	/**
	 * Get products
	 * @param $params
	 * @return array
	 */
    public function get_item_products($params) {
        return $this->db->get_where('product_detail_img', $params)->result_array();
    }

	/**
	 * Get today's products
	 */
	public function get_today() {
		$this->db->from('product_detail_img');
		$this->db->where('updated_at >', ' DATE_SUB(NOW(), INTERVAL 1 DAY)');
		$this->db->order_by('id', 'desc');
		return $this->db->get()->result_array();
	}

	/**
	 * Get all products
	 */
	public function get_all_products() {
		$this->db->order_by('id', 'asc');
		return $this->db->get('product_detail_img')->result_array();
	}

	/**
	 * Get all available products
	 */
	public function get_all_available() {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('product_detail_img', array('status' => 1))->result_array();
	}

	/**
	 * Function to add new product
	 * @param $params
	 * @return int
	 */
	public function add_product_detail_img($params) {
		$this->db->insert('product_detail_img', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update product
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_product($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('product_detail_img', $params);
	}

	/**
	 * Function to delete product
	 * @param $id
	 * @return mixed
	 */
	public function delete_product($id) {
		return $this->db->delete('product_detail_img',array('id' => $id));
	}

	/**
	 * Get bonus products
	 */
	public function get_bonus_products() {
		$this->db->order_by('stock', 'desc');
		return $this->db->get_where('product_detail_img', array('bonus' => 1))->result_array();
	}
}
