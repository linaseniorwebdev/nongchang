<?php

class Withdraw_model extends CI_Model {

    private $table, $column_order, $column_search, $order;

    /**
     * Construct
     */
    public function __construct() {
        parent::__construct();

        $this->table = 'withdraw';
        $this->column_order = array(null, 'id', 'user', 'card', 'amount', 'site', 'updated_at', 'status');
        $this->column_search = array('user', 'card');
        $this->order = array('id' => 'asc');
    }

    public function getRows($postData, $flag) {
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
	    if ($flag) {
		    $this->db->where('status', 1);
	    }
        $query = $this->db->get();
        return $query->result();
    }

    public function countAll($flag) {
        $this->db->from($this->table);
	    if ($flag) {
		    $this->db->where('status', 1);
	    }
        return $this->db->count_all_results();
    }

    public function countFiltered($postData, $flag) {
        $this->_get_datatables_query($postData);
        if ($flag) {
	        $this->db->where('status', 1);
        }
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
	 * Get withdraw by id
	 * @param $id
	 * @return array
	 */
	public function get_withdraw_by_id($id) {
		return $this->db->get_where('withdraw', array('id' => $id))->row_array();
	}

	/**
	 * Get withdraw by id
	 * @param $user_id
	 * @return array
	 */
	public function get_withdraw($user_id) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('withdraw', array('user' => $user_id))->result_array();
	}

	/**
	 * Get all withdraw
	 */
	public function get_all_withdraw() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('withdraw')->result_array();
	}

	/**
	 * Function to add new withdraw
	 * @param $params
	 * @return int
	 */
	public function add_withdraw($params) {
		$this->db->insert('withdraw', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update withdraw
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_withdraw($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('withdraw', $params);
	}

	/**
	 * Function to delete withdraw
	 * @param $id
	 * @return mixed
	 */
	public function delete_withdraw($id) {
		return $this->db->delete('withdraw', array('id' => $id));
	}
}
