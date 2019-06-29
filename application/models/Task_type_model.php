<?php

class Task_type_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct();

		$this->table = 'task_types';
		$this->column_order = array(null, 'id', 'name', 'cost', 'usage');
		$this->column_search = array('name');
		$this->order = array('id' => 'asc');
	}

	public function getRows($postData) {
		$this->_get_datatables_query($postData);
		if($postData['length'] != -1){
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
	 * Get task_type by id
	 * @param $id
	 * @return array
	 */
	public function get_task_type($id) {
		return $this->db->get_where('task_types', array('id' => $id))->row_array();
	}

	/**
	 * Get all task_types
	 */
	public function get_all_task_types() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('task_types')->result_array();
	}

	/**
	 * Get all available land types
	 * @param $category_id
	 * @return array
	 */
	public function get_all_available($category_id = null) {
		$this->db->order_by('id', 'asc');
		if ($category_id) {
			$result = $this->db->get_where('task_types', array('category' => $category_id,'usage' => 1))->result_array();
		} else {
			$result = $this->db->get_where('task_types', array('usage' => 1))->result_array();
		}
		return $result;
	}

	/**
	 * Function to add new task_type
	 * @param $params
	 * @return int
	 */
	public function add_task_type($params) {
		$this->db->insert('task_types', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update task_type
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_task_type($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('task_types', $params);
	}

	/**
	 * Function to delete task_type
	 * @param $id
	 * @return mixed
	 */
	public function delete_task_type($id) {
		return $this->db->delete('task_types', array('id' => $id));
	}
}
