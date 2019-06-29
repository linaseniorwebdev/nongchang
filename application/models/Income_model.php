<?php

class Income_model extends CI_Model {

    private $table, $column_order, $column_search, $order;

    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();

        $this->table = 'income';
        $this->column_order = array(null, 'id', 'order', 'seller', 'total', 'real', 'site', 'created_at');
        $this->column_search = array('order', 'seller');
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
            if($postData['search']['value']) {
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
	 * Get income by id
	 */
	function get_income($user_id) {
		$result = array();
		$query = 'SELECT SUM(`real`) AS sum FROM income WHERE seller = ' . $user_id . ' GROUP BY seller;';
		$data = $this->db->query($query)->row_array();
		$result['total'] = $data['sum'];
		$query = 'SELECT SUM(`real`) AS sum FROM income WHERE seller = ' . $user_id . ' AND DATE(NOW()) = DATE(created_at) GROUP BY seller;';
		$data = $this->db->query($query)->row_array();
		$result['today'] = $data['sum'];
		$query = 'SELECT SUM(`real`) AS sum FROM income WHERE seller = ' . $user_id . ' AND DATE(created_at) = DATE(NOW() - INTERVAL 1 DAY) GROUP BY seller;';
		$data = $this->db->query($query)->row_array();
		$result['yesterday'] = $data['sum'];
		return $result;
	}

	/**
	 * Get all income
	 */
	function get_all_income() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('income')->result_array();
	}

	/**
	 * function to add new income
	 */
	function add_income($params) {
		$this->db->insert('income', $params);
		return $this->db->insert_id();
	}

	/**
	 * function to update income
	 */
	function update_income($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('income', $params);
	}

	/**
	 * function to delete income
	 */
	function delete_income($id) {
		return $this->db->delete('income', array('id' => $id));
	}
}
