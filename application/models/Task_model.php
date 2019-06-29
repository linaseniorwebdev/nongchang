<?php

class Task_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct();

		$this->table = 'tasks';
		$this->column_order = array(null, 'id', 'user', 'type', 'description', 'land', 'status', 'updated_at');
		$this->column_search = array('id');
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
	 * Get task by id
	 * @param $id
	 * @return array
	 */
	public function get_task($id) {
		return $this->db->get_where('tasks', array('id' => $id))->row_array();
	}

	/**
	 * Get all tasks
	 */
	public function get_all_tasks() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('tasks')->result_array();
	}
    /**
     * Get all user tasks
     */
    public function get_user_tasks($user_id) {
        $query = 'SELECT tasks.id, task_types.name As name, task_status.name AS status, tasks.updated_at FROM tasks, task_types, task_status WHERE tasks.type = task_types.id AND tasks.status = task_status.id AND tasks.user = ' . $user_id . ' ORDER BY tasks.id;';
        return $this->db->query($query)->result_array();
    }
	/**
	 * function to add new task
	 * @param $params
	 * @return int
	 */
	public function add_task($params) {
		$this->db->insert('tasks',$params);
		return $this->db->insert_id();
	}

	/**
	 * function to update task
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_task($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('tasks', $params);
	}

	/**
	 * function to delete task
	 * @param $id
	 * @return mixed
	 */
	public function delete_task($id) {
		return $this->db->delete('tasks', array('id' => $id));
	}
}
