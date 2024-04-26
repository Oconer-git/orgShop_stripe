<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Test');
        $this->load->model('Admin');
        $this->load->model('Product');
        if($this->session->userdata('user')) {
            $user_info = $this->session->userdata('user');
            if($user_info['is_admin'] == false) {
                redirect('/shops');
            }
        } 
        else {
            redirect('/shops');
        }
    }
    
    public function index() {
        $this->load->view('admins/admin_orders');
    }

    public function products() {
        $this->load->view('admins/admin_products');
    }

    public function log_out_process() {
        if($this->input->post('action') && $this->input->post('action') == 'log_out') {
            $this->session->sess_destroy();
            redirect('/');
        }
    }

    public function add_product_process() {
        if($this->input->post('action') && $this->input->post('action') == 'add_product') {
            $result = $this->Admin->validate_product();
            if($result != 'valid') {
                $this->session->set_flashdata('validation_errors', validation_errors());
            } 
            else {
                $image_paths = array();

                $this->load->library('upload');
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; 
    
                for($i = 0; $i < 5; $i++) {
                    $file_name = 'image'.$i;
    
                    if(!empty($_FILES[$file_name]['name'])) {
                        $this->upload->initialize($config);
    
                        if(!$this->upload->do_upload($file_name)) {
                            $this->session->set_flashdata('validation_errors', $this->upload->display_errors());
                            
                        } 
                        else {
                            $file_data = $this->upload->data();
                            $image_paths[$file_name] = '/uploads/' . $file_data['file_name']; 
                        }
                    }
                }
    
                $product = array(
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'price' => $this->input->post('price'),
                    'inventory_count' => $this->input->post('inventory'),
                    'category' => $this->input->post('category'),
                    'image' => isset($image_paths['image0']) ? $image_paths['image0'] : NULL, // Primary image
                    'image1' => isset($image_paths['image1']) ? $image_paths['image1'] : NULL,
                    'image2' => isset($image_paths['image2']) ? $image_paths['image2'] : NULL,
                    'image3' => isset($image_paths['image3']) ? $image_paths['image3'] : NULL,
                    'image4' => isset($image_paths['image4']) ? $image_paths['image4'] : NULL,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                );
        
                if($this->Admin->add_product($product)) {
                    $view_data['products'] = $this->Admin->get_all_products();
                    $this->load->view('admins/partials/load_products_edit', $view_data);
                } 
                else {
                    $this->session->set_flashdata('validation_errors', 'Adding product failed');
                    $view_data['products'] = $this->Admin->get_all_products();
                    $this->load->view('admins/partials/load_products_edit', $view_data);
                }
            }
        }
    }

    public function edit_product_process() {
        if($this->input->post('action') && $this->input->post('action') == 'edit_product') {
            $product_id = $this->input->post('id');
            
            $product = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
                'inventory' => $this->input->post('inventory'),
                'category_id' => $this->input->post('category'),
                'id' => $this->input->post('id')
            );
    
            $image_paths = array();
            $this->load->library('upload');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2048;
    
            for($i = 0; $i < 5; $i++) {
                $file_name = 'image'.$i;
                if(!empty($_FILES[$file_name]['name'])) {
                    $this->upload->initialize($config);
                    if($this->upload->do_upload($file_name)) {
                        $file_data = $this->upload->data();
                        $image_paths[$file_name] = '/uploads/' . $file_data['file_name'];
                    }
                }
            }
    
            $update_data = array();
            foreach($product as $key => $value) {
                if(!empty($value)) {
                    $update_data[$key] = $value;
                }
            }
            foreach ($image_paths as $key => $value) {
                $update_data[$key] = $value;
            }
    
            if($this->Admin->update_product($product_id, $update_data)) {
                $view_data['products'] = $this->Admin->get_all_products();
                $this->load->view('admins/partials/load_products_edit', $view_data);
            } 
            else {
                $this->session->set_flashdata('validation_errors', 'Adding product failed');
                    $view_data['products'] = $this->Admin->get_all_products();
                    $this->load->view('admins/partials/load_products_edit', $view_data);
            }
        }
    }

    public function all_products_html() {
        $view_data['products'] = $this->Admin->get_all_products();
        $this->load->view('admins/partials/load_products_edit', $view_data);
    }

    public function products_category_process() {
        $category_id = intval($this->input->post('category_id'));
        if($category_id == 0) {
            $view_data['products'] = $this->Admin->get_all_products();
        }
        else {
            $view_data['products'] = $this->Admin->get_all_products_category($category_id);
        }
        $this->load->view('admins/partials/load_products_edit', $view_data);  
    }

    public function delete_product_process(){
        $id = $this->input->post('id');
        if($this->Admin->delete_product($id)) {
            $view_data['products'] = $this->Admin->get_all_products();
            $this->load->view('admins/partials/load_products_edit', $view_data);  
        }
    }

    public function orders_html() {
        $shipping_orders = $this->Admin->get_shipping_orders();
       
        foreach($shipping_orders as $index => $shipping_order) {
            $total_amount = $this->Admin->get_orders_total_amount($shipping_order['id']);
            $shipping_orders[$index]['total_amount'] = $total_amount['total_amount'];
        }

        $view_data['orders'] = $shipping_orders;
        $this->load->view('admins/partials/load_orders', $view_data);
    }

    public function show_status() {
        $value = $this->input->post('status');
        $shipping_orders = null;

        if($value == 'all') {
            $shipping_orders = $this->Admin->get_shipping_orders();
        }
        else {
            $shipping_orders = $this->Admin->get_shipping_status($value);
        }
       
        foreach($shipping_orders as $index => $shipping_order) {
            $total_amount = $this->Admin->get_orders_total_amount($shipping_order['id']);
            $shipping_orders[$index]['total_amount'] = $total_amount['total_amount'];
        }

        $view_data['orders'] = $shipping_orders;
        $this->load->view('admins/partials/load_orders', $view_data);
    }

    public function update_status() {
        $update_success = $this->Admin->update_status($this->input->post());
        if($update_success) {
            $shipping_orders = $this->Admin->get_shipping_orders();
       
            foreach($shipping_orders as $index => $shipping_order) {
                $total_amount = $this->Admin->get_orders_total_amount($shipping_order['id']);
                $shipping_orders[$index]['total_amount'] = $total_amount['total_amount'];
            }
    
            $view_data['orders'] = $shipping_orders;
            $this->load->view('admins/partials/load_orders', $view_data);
        }
    }

    public function search_product() {
        $view_data['products'] = $this->Admin->search_product($this->input->post('search'));
        $this->load->view('admins/partials/load_products_edit', $view_data);  
    }

    public function search_orders() {
        $shipping_orders = $this->Admin->search_orders($this->input->post('search'));

        foreach($shipping_orders as $index => $shipping_order) {
            $total_amount = $this->Admin->get_orders_total_amount($shipping_order['id']);
            $shipping_orders[$index]['total_amount'] = $total_amount['total_amount'];
        }

        $view_data['orders'] = $shipping_orders;
        $this->load->view('admins/partials/load_orders', $view_data);
    }


}
?>