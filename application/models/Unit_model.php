<?php

class Unit_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct();

		$this->table = 'units';
		$this->column_order = array(null, 'id', 'name', 'usage');
		$this->column_search = array('name');
		$this->order = array('id' => 'asc');
	}

	public function getRows($postData) {
		$this->_get_datatables_query($postData);
		if ($postData['length'] != -1){
			$this->db->limit($postData['length'], $postData['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function countAll() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function countFiltered($postData) {
		$this->_get_datatables_query($postData);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function _get_datatables_query($postData) {
		$this->db->from($this->table);
		$i = 0;
		foreach($this->column_search as $item) {
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
	 * Get unit by id
	 */
	public function get_unit($id) {
		return $this->db->get_where('units', array('id' => $id))->row_array();
	}

	/**
	 * Get all available land types
	 */
	public function get_all_available() {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('units', array('usage' => 1))->result_array();
	}

	/**
	 * Function to add new unit
	 * @param $params
	 * @return int
	 */
	public function add_unit($params) {
		$this->db->insert('units', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update unit
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_unit($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('units', $params);
	}

	/**
	 * Function to delete unit
	 * @param $id
	 * @return mixed
	 */
	public function delete_unit($id) {
		return $this->db->delete('units', array('id' => $id));
	}
}
