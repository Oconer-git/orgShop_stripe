<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
   
    public function get_all_products() {
        return $this->db->query("SELECT products.*, categories.name as category 
                                 FROM products 
                                 LEFT JOIN categories on products.category_id = categories.id
                                 WHERE products.inventory > 0 
                                 ORDER BY category_id")->result_array();
    }
    public function get_product($id) {
        return $this->db->query("SELECT products.*, categories.name as category 
                                 FROM products 
                                 LEFT JOIN categories on products.category_id = categories.id
                                 WHERE products.id = ? AND products.inventory > 0",array($id))->row_array();
    }

    public function get_all_products_category($category_id) {
        return $this->db->query("SELECT products.*, categories.name as category 
                                 FROM products 
                                 LEFT JOIN categories on products.category_id = categories.id
                                 WHERE products.category_id = ? AND products.inventory > 0",array($category_id))->result_array();
    }
 
    public function add_to_cart($product) {
        date_default_timezone_set('Asia/Manila');
        $inventory = $this->db->query("SELECT inventory FROM products WHERE id = ?", array($product['id']))->row_array();
        $quantity = 0;

        if($inventory['inventory'] > $product['quantity']) {
            $quantity = $product['quantity'];
        } 
        else {
            $quantity = $inventory['inventory'];
        }

        if($product['quantity'] <= 0) {
            $quantity = 1;
        }

        $query = "INSERT INTO checkouts (quantity, created_at, updated_at, product_id, user_id, ordered) VALUES(?, ?, ?, ?, ?, ?)";
        $values = array($quantity, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $product['id'], $product['user_id'], 0);
        return $this->db->query($query, $values);
    }

    public function get_cart($user_id) {
        return $this->db->query("SELECT checkouts.*, products.name, products.description, products.price, products.image, products.created_at
                                 FROM checkouts
                                 LEFT JOIN products ON checkouts.product_id = products.id
                                 WHERE user_id = ? AND checkouts.ordered = 0", array($user_id))->result_array();
    }

    public function delete_cart($id) {
        return $this->db->query("DELETE FROM checkouts WHERE id = ?", array($id));
    }

    public function order_carts($user_info) {
        return $this->db->query("UPDATE checkouts SET ordered = 1, billing_information_id = ?, shipping_information_id = ? WHERE user_id = ? AND ordered = 0", array( $user_info['billing_id'], $user_info['shipping_id'], $user_info['id']));
    }

    public function check_billing_default($id) {
        return $this->db->query("SELECT * FROM default_billing_informations WHERE user_id = ? ", array($id));
    }

    public function check_shipping_default($id) {
        return $this->db->query("SELECT * FROM default_shipping_informations WHERE user_id = ? ", array($id));
    }

    public function submit_billing_info($user_info) {
        date_default_timezone_set('Asia/Manila');
        $user = $this->session->userdata('user');
        
        $existing_billing_query = "SELECT * FROM default_billing_informations WHERE user_id = ?";
        $existing_billing_info = $this->db->query($existing_billing_query, array($user['id']))->row_array();
        
        if ($existing_billing_info) {
            $billing_query = "UPDATE default_billing_informations SET first_name = ?, last_name = ?, address1 = ?, address2 = ?, city = ?, state = ?, zip = ?, updated_at = ? WHERE user_id = ?";
            $billing_values = array($user_info['billing_first_name'], $user_info['billing_last_name'], $user_info['billing_address1'], $user_info['billing_address2'], $user_info['billing_city'], $user_info['billing_state'], $user_info['billing_zip'], date("Y-m-d H:i:s"), $user['id']);
            return $this->db->query($billing_query, $billing_values);
        } 
        else {
            $billing_query = "INSERT INTO default_billing_informations (first_name, last_name, address1, address2, city, state, zip, user_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $billing_values = array($user_info['billing_first_name'], $user_info['billing_last_name'], $user_info['billing_address1'], $user_info['billing_address2'], $user_info['billing_city'], $user_info['billing_state'], $user_info['billing_zip'], $user['id'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
            return $this->db->query($billing_query, $billing_values);
        }
    }

    public function submit_shipping_info($user_info) {
        date_default_timezone_set('Asia/Manila');
        $user = $this->session->userdata('user');

        $existing_shipping_query = "SELECT * FROM default_shipping_informations WHERE user_id = ?";
        $existing_shipping_info = $this->db->query($existing_shipping_query, array($user['id']))->row_array();
        
        if ($existing_shipping_info) {
            $shipping_query = "UPDATE default_shipping_informations SET first_name = ?, last_name = ?, address1 = ?, address2 = ?, city = ?, state = ?, zip = ?, updated_at = ? WHERE user_id = ?";
            $shipping_values = array($user_info['shipping_first_name'], $user_info['shipping_last_name'], $user_info['shipping_address1'], $user_info['shipping_address2'], $user_info['shipping_city'], $user_info['shipping_state'], $user_info['shipping_zip'], date("Y-m-d H:i:s"), $user['id']);
            return $this->db->query($shipping_query, $shipping_values);
        } 
        else {
            $shipping_query = "INSERT INTO default_shipping_informations (first_name, last_name, address1, address2, city, state, zip, user_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $shipping_values = array($user_info['shipping_first_name'], $user_info['shipping_last_name'], $user_info['shipping_address1'], $user_info['shipping_address2'], $user_info['shipping_city'], $user_info['shipping_state'], $user_info['shipping_zip'], $user['id'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
            return $this->db->query($shipping_query, $shipping_values);
        }
    }

    public function submit_payment_shipping_info($shipping_info) {
        $user = $this->session->userdata('user');
        $shipping_query = "INSERT INTO shipping_informations (first_name, last_name, address1, address2, city, state, zip, user_id, created_at, updated_at, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $shipping_values = array($shipping_info['first_name'], $shipping_info['last_name'], $shipping_info['address1'], $shipping_info['address2'], $shipping_info['city'], $shipping_info['state'], $shipping_info['zip'], $user['id'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 'pending');
        return $this->db->query($shipping_query, $shipping_values);
    }

    public function add_sold($product_info) {
        return $this->db->query("UPDATE products SET inventory = inventory - ?, sold = sold + ? WHERE id = ?", array($product_info['sold'], $product_info['sold'], $product_info['product_id']));
    }

    public function submit_payment_billing_info($billing_info) {
        $user = $this->session->userdata('user');
        $billing_query = "INSERT INTO billing_informations (first_name, last_name, address1, address2, city, state, zip, user_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $billing_values = array($billing_info['first_name'], $billing_info['last_name'], $billing_info['address1'], $billing_info['address2'], $billing_info['city'], $billing_info['state'], $billing_info['zip'], $user['id'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
        return $this->db->query($billing_query, $billing_values);
    }

    public function get_latest_billing() {
        $user = $this->session->userdata('user');
        return $this->db->query("SELECT id
                                 FROM billing_informations
                                 WHERE user_id = ?
                                 ORDER BY created_at DESC
                                 LIMIT 1",array($user['id']))->row_array();
    }

    public function get_latest_shipping() {
        $user = $this->session->userdata('user');
        return $this->db->query("SELECT id
                                 FROM shipping_informations
                                 WHERE user_id = ?
                                 ORDER BY created_at DESC
                                 LIMIT 1",array($user['id']))->row_array();
    }

    public function validate_settings() {
        //billing validation
        $this->form_validation->set_rules('billing_first_name', 'first name in billing form', 'required|max_length[100]|alpha');
        $this->form_validation->set_rules('billing_last_name', 'last name in billing form', 'required|max_length[100]');
        $this->form_validation->set_rules('billing_address1', 'first address in billing form', 'required');
        $this->form_validation->set_rules('billing_address2', 'second address in billing form', 'required');
        $this->form_validation->set_rules('billing_city', 'city in billing form', 'required');
        $this->form_validation->set_rules('billing_state', 'state in billing form', 'required');
        $this->form_validation->set_rules('billing_zip', 'zip in billing form', 'required');
        //shipping validation
        $this->form_validation->set_rules('shipping_first_name', 'first name in shipping form', 'required|max_length[100]|alpha');
        $this->form_validation->set_rules('shipping_last_name', 'last name in shipping form', 'required|max_length[100]');
        $this->form_validation->set_rules('shipping_address1', 'first address in shipping form', 'required');
        $this->form_validation->set_rules('shipping_address2', 'second address in shipping form', 'required');
        $this->form_validation->set_rules('shipping_city', 'city in shipping form', 'required');
        $this->form_validation->set_rules('shipping_state', 'state in shipping form', 'required');
        $this->form_validation->set_rules('shipping_zip', 'zip in shipping form', 'required');

        if ($this->form_validation->run() == FALSE) {
            return array(validation_errors());
        } 
        else {
            return "valid";
        }
    }
    
    public function get_default_shipping_info(){
        $user = $this->session->userdata('user');
        return $this->db->query("SELECT * from default_shipping_informations WHERE user_id = ?", array($user['id']))->row_array();
    }

    public function get_default_billing_info(){
        $user = $this->session->userdata('user');
        return $this->db->query("SELECT * from default_billing_informations WHERE user_id = ?", array($user['id']))->row_array();
    }

    public function search_products($search_term) {
        $query = "SELECT * FROM products WHERE name LIKE ?";
        return $this->db->query($query, array("%$search_term%"))->result_array();
    }
}
?>