<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function validate_product() {
        $this->form_validation->set_rules('name', 'name of product', 'required|max_length[70]|min_length[3]');
        $this->form_validation->set_rules('description', 'description', 'required|max_length[1300]|min_length[10]');
        $this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
        $this->form_validation->set_rules('category', 'category', 'trim|required|numeric');
        $this->form_validation->set_rules('inventory', 'inventory count', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE) {
            return array(validation_errors());
        } 
        else {
            return "valid";
        }
    }

    public function validate_edit_product() {
        $this->form_validation->set_rules('name', 'name of product', 'max_length[30]|min_length[3]');
        $this->form_validation->set_rules('description', 'description', 'max_length[100]|min_length[5]');
        $this->form_validation->set_rules('price', 'price', 'trim|numeric');
        $this->form_validation->set_rules('category', 'category', 'trim|numeric');
        $this->form_validation->set_rules('inventory', 'inventory count', 'trim|numeric');
        if ($this->form_validation->run() == FALSE) {
            return array(validation_errors());
        } 
        else {
            return "valid";
        }
    }

    public function add_product($product) {
        $query = "INSERT INTO products (name, description, price, inventory, sold, category_id, image, image1, image2, image3, image4, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values = array($product['name'], $product['description'], $product['price'], $product['inventory_count'], 0, $product['category'],
                        $product['image'], $product['image1'], $product['image2'],  $product['image3'], $product['image4'], $product['created_at'], $product['updated_at']);
        return $this->db->query($query,$values);
    }

    public function update_product($product_id, $update_data) {
        $set_clause = '';
        $values = array();
        foreach ($update_data as $key => $value) {
            $set_clause .= "$key = ?, ";
            $values[] = $value;
        }
        $set_clause = rtrim($set_clause, ', ');
    
        $query = "UPDATE products SET $set_clause WHERE id = ?";
        $values[] = $product_id;
    
        return $this->db->query($query, $values);
    }


    public function get_all_products() {
        return $this->db->query("SELECT products.*, categories.name as category 
                                 FROM products 
                                 LEFT JOIN categories on products.category_id = categories.id")->result_array();
    }

    public function search_product($search_term) {
        return $this->db->query("SELECT products.*, categories.name as category 
                                 FROM products 
                                 LEFT JOIN categories on products.category_id = categories.id
                                 WHERE products.name LIKE ?",array("%$search_term%"))->result_array();

    }
    
    public function get_all_products_category($category_id) {
        return $this->db->query("SELECT products.*, categories.name as category 
                                 FROM products 
                                 LEFT JOIN categories on products.category_id = categories.id
                                 WHERE products.category_id = ?",array($category_id))->result_array();
    }

    public function get_shipping_orders() {
        return $this->db->query("SELECT * FROM shipping_informations")->result_array();
    }

    public function search_orders($search_term) {
        return $this->db->query("SELECT * FROM shipping_informations  
                                 WHERE last_name
                                 LIKE ?", array("%$search_term%"))->result_array();
    }

    public function get_shipping_status($status) {
        return $this->db->query("SELECT * FROM shipping_informations WHERE status = ?", array($status))->result_array();

    } 

    public function get_orders_total_amount($shipping_id) {
        return $this->db->query("SELECT sum(products.price * checkouts.quantity) as total_amount
                                 FROM checkouts 
                                 LEFT JOIN products ON checkouts.product_id = products.id
                                 WHERE ordered = 1 AND shipping_information_id = ?", array($shipping_id))->row_array();
    }

    public function update_status($order_info) {
        return $this->db->query("UPDATE shipping_informations
                                 SET status = ? 
                                 WHERE id = ?",array($order_info['status'], $order_info['id']));
    }

    public function delete_product($id) {
        return $this->db->query("DELETE FROM products WHERE id = ?", array($id));
    }
}
?>