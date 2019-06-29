<?php

class Cart_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	/*
	* Get cart by id
	*/
	function get_cart($id) {
		return $this->db->get_where('carts',array('id'=>$id))->row_array();
	}

	/*
	* Get all carts
	*/
	function get_all_carts() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('carts')->result_array();
	}
    /*
	* Get carts by user
	*/
    function get_user_carts($user_id) {
        $query = 'SELECT carts.id AS cart_id , carts.product AS product_id, carts.amount AS amount, products.price, products.image, products.name FROM carts, products WHERE carts.product = products.id AND carts.user = ' . $user_id . ' ORDER BY carts.id;';
        return $this->db->query($query)->result_array();
    }

    function get_user_cart($user_id, $product_id) {
        return $this->db->get_where('carts',array('user'=>$user_id, 'product'=>$product_id))->row_array();
    }
	/*
	* function to add new cart
	*/
	function add_cart($params) {
		$this->db->insert('carts',$params);
		return $this->db->insert_id();
	}

	/*
	* function to update cart
	*/
	function update_cart($id,$params) {
		$this->db->where('id',$id);
		return $this->db->update('carts',$params);
	}

	/*
	* function to delete cart
	*/
	function delete_cart($id) {
		return $this->db->delete('carts',array('id'=>$id));
	}

    function delete_carts($params) {
        return $this->db->delete('carts',$params);
    }
}
