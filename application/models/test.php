<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function validate_product() {
        $this->form_validation->set_rules('name', 'name of product', 'required|max_length[30]|min_length[3]');
        $this->form_validation->set_rules('description', 'description', 'required|max_length[100]|min_length[10]');
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

    public function add_product($product) {
        $query = "INSERT INTO products (name, description, price, inventory, sold, category_id, image, image1, image2, image3, image4, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values = array($product['name'], $product['description'], $product['price'], $product['inventory_count'], 0, $product['category'],
                        $product['image'], $product['image1'], $product['image2'],  $product['image3'], $product['image4'], $product['created_at'], $product['updated_at']);
        return $this->db->query($query,$values);
    }
}
?>