<?php

class Land_type_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct();

		$this->table = 'land_type';
		$this->column_order = array(null, 'id', 'value', 'usage');
		$this->column_search = array('value', 'usage');
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
	 * Get land_type by id
	 */
	function get_land_type($id) {
		return $this->db->get_where('land_type', array('id' => $id))->row_array();
	}

	/**
	 * Get all land_type
	 */
	function get_all_land_type() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('land_type')->result_array();
	}

	/**
	 * Get all available land types
	 */
	function get_all_available() {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('land_type', array('usage' => 1))->result_array();
	}

	/**
	 * function to add new land_type
	 */
	function add_land_type($params) {
		$this->db->insert('land_type', $params);
		return $this->db->insert_id();
	}

	/**
	 * function to update land_type
	 */
	function update_land_type($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('land_type', $params);
	}

	/**
	 * function to delete land_type
	 */
	function delete_land_type($id) {
		return $this->db->delete('land_type',array('id' => $id));
	}
}
