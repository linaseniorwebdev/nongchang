<?php

class Product_type_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct();

		$this->table = 'product_types';
		$this->column_order = array(null, 'id', 'name', 'usage');
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
	 * Get product_type by id
	 */
	function get_product_type($id) {
		return $this->db->get_where('product_types', array('id' => $id))->row_array();
	}

	/**
	 * Get all product_types
	 */
	function get_all_product_types() {
		$this->db->order_by('id', 'asc');
		return $this->db->get('product_types')->result_array();
	}

	/**
	 * Get all available land types
	 */
	function get_all_available() {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('product_types', array('usage' => 1))->result_array();
	}

	/**
	 * function to add new product_type
	 */
	function add_product_type($params) {
		$this->db->insert('product_types', $params);
		return $this->db->insert_id();
	}

	/**
	 * function to update product_type
	 */
	function update_product_type($id, $params) {
		$this->db->where('id',$id);
		return $this->db->update('product_types', $params);
	}

	/**
	 * function to delete product_type
	 */
	function delete_product_type($id) {
		return $this->db->delete('product_types', array('id' => $id));
	}
}
