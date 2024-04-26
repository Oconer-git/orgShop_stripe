<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Product');
        $this->load->helper('url');
    }
    
    public function index() {
        if($this->session->userdata('user')) {
            $view_data['user_info'] = $this->session->userdata('user');
            $this->load->view('users/catalogue', $view_data);
        } 
        else {
            $view_data['user_info'] = NULL;
            $this->load->view('users/catalogue',$view_data);
        }
    }

    public function item($id) {
        $view_data['product'] = $this->Product->get_product($id);
        
        if($this->session->userdata('user')) {
            $product = $this->Product->get_product($id);
            if($product != NULL) {
                $view_data['product'] = $product;
                if ($view_data['product']['image'] == NULL) {
                    $view_data['product']['image'] = '/assets/images/uploads/no_image.jpg';
                }   
                if ($view_data['product']['image1'] == NULL) {
                    $view_data['product']['image1'] = '/assets/images/uploads/no_image.jpg';
                }  
                if ($view_data['product']['image2'] == NULL) {
                    $view_data['product']['image2'] = '/assets/images/uploads/no_image.jpg';
                }      
                if ($view_data['product']['image3'] == NULL) {
                    $view_data['product']['image3'] = '/assets/images/uploads/no_image.jpg';
                }   
                if ($view_data['product']['image4'] == NULL) {
                    $view_data['product']['image4'] = '/assets/images/uploads/no_image.jpg';
                }            
                $view_data['similar_products'] = $this->Product->get_all_products_category($view_data['product']['category_id']);       
                $view_data['user_info'] = $this->session->userdata('user');
                $this->load->view('users/product_view',$view_data);
            }
            else {
                $this->session->set_flashdata('no_match','there is no match');
                $this->load->view('users/product_view',$view_data);     
            }
        } 
        else {
            $view_data['user_info'] = NULL;
            $product = $this->Product->get_product($id);
            if($product != NULL) {
                $view_data['product'] = $product;
                if ($view_data['product']['image'] == NULL) {
                    $view_data['product']['image'] = '/assets/images/uploads/no_image.jpg';
                }   
                if ($view_data['product']['image1'] == NULL) {
                    $view_data['product']['image1'] = '/assets/images/uploads/no_image.jpg';
                }  
                if ($view_data['product']['image2'] == NULL) {
                    $view_data['product']['image2'] = '/assets/images/uploads/no_image.jpg';
                }      
                if ($view_data['product']['image3'] == NULL) {
                    $view_data['product']['image3'] = '/assets/images/uploads/no_image.jpg';
                }   
                if ($view_data['product']['image4'] == NULL) {
                    $view_data['product']['image4'] = '/assets/images/uploads/no_image.jpg';
                }                   
                $view_data['similar_products'] = $this->Product->get_all_products_category($view_data['product']['category_id']);  
                $this->load->view('users/product_view',$view_data);     
            }
            else {
                $this->session->set_flashdata('no_match','there is no match');
                $this->load->view('users/product_view',$view_data);     

            }
        }
    }

    public function category_process() {
        $category_id = $this->input->post('category_id');
        if($category_id == 0) {
            $view_data['products'] = $this->Product->get_all_products();
            $this->load->view('users/partials/products', $view_data);
        }
        else {
            $view_data['products'] = $this->Product->get_all_products_category($category_id);
            $this->load->view('users/partials/products', $view_data);
        }
        
    }

    public function products_html() {
        $view_data['products'] = $this->Product->get_all_products();
        $this->load->view('users/partials/products', $view_data);
    }

    public function cart() {
        $user = $this->session->userdata('user');
        if($user) {
            $view_data['user_info'] = $user;
            $view_data['carts'] = $this->Product->get_cart($user['id']);
            $this->load->view('users/cart', $view_data);
        } 
        else {
           redirect('/');
        }  
    }

    public function get_cart() {
        $user = $this->session->userdata('user');
        if($user) {
            $view_data['user_info'] = $user;
            $view_data['carts'] = $this->Product->get_cart($user['id']);
            $this->load->view('users/partials/load_cart', $view_data);
        } 
    }

    public function delete_cart_process() {
        $success = $this->Product->delete_cart($this->input->post('id'));
        if($success) {
            $user = $this->session->userdata('user');
            if($user) {
                $view_data['user_info'] = $user;
                $view_data['carts'] = $this->Product->get_cart($user['id']);
                $view_data['price'] = null;
                $this->load->view('users/partials/load_cart', $view_data);
            } 
        }  
    }

    public function add_to_cart_process() {
        $user = $this->session->userdata('user');        
        if($user) {
            $order = array(
                'id' => $this->input->post('id'),
                'quantity' => $this->input->post('quantity'),
                'user_id' => $user['id']
            );
            $this->Product->add_to_cart($order);
            redirect('/Products/item/'.$this->input->post('id'));
        } 
        else {
           redirect('/');
        }  
    }

    public function submit_settings() {
        $result = $this->Product->validate_settings();
        if ($result != 'valid') {
            $this->session->set_flashdata('validation_errors', validation_errors());
            redirect('/Products/Settings'); 
        } 
        else {
            $this->Product->submit_billing_info($this->input->post());
            $this->Product->submit_shipping_info($this->input->post());
            $this->session->set_flashdata('success', 'information saved');
            redirect('/Products/Settings'); 
        }
    
    }

    public function settings_html() {
        $shipping_info = $this->Product->get_default_shipping_info();
        $billing_info = $this->Product->get_default_billing_info();
        if($shipping_info && $billing_info) {
            $view_data['shipping_info'] = $this->Product->get_default_shipping_info();
            $view_data['billing_info'] = $this->Product->get_default_billing_info();
            $this->load->view('users/partials/settings_with_info',$view_data);
        }
        else {
            $this->load->view('users/partials/settings_without_info');
        }
    }

    public function shipping_info_html() {
        $user = $this->session->userdata('user');
        $shipping_info = $this->Product->get_default_shipping_info();
        $billing_info = $this->Product->get_default_billing_info();
        if($shipping_info && $billing_info) {
            $view_data['shipping_info'] = $this->Product->get_default_shipping_info();
            $view_data['billing_info'] = $this->Product->get_default_billing_info();
            $carts = $this->Product->get_cart($user['id']);
            if($carts != NULL) {
                $price = 0;
                foreach($carts as $cart) {
                    $price += $cart['quantity'] * $cart['price'];
                }
                $view_data['price'] = $price;
            }
            $this->load->view('users/partials/shipping_info',$view_data);
        }
        else {
            $this->load->view('users/partials/no_shipping_info');
        }
    }

    public function settings() {
        $user = $this->session->userdata('user');        
        if($user) {
            $shipping_info = $this->Product->get_default_shipping_info();
            $billing_info = $this->Product->get_default_billing_info();
            if($shipping_info && $billing_info) {
                $view_data['shipping_info'] = $this->Product->get_default_shipping_info();
                $view_data['billing_info'] = $this->Product->get_default_billing_info();
                $this->load->view('users/settings',$view_data);
            }
           else{
                $this->load->view('users/settings');
           }
        } 
        else {
           redirect('/');
        }  
    }

    public function search_product() {
        $view_data['products'] = $this->Product->search_products($this->input->post('search'));
        $this->load->view('users/partials/products', $view_data);
    }

    public function search() {
        $products = $this->Product->search_products($this->input->post('search'));
        if($products) {
            redirect('Products/item/'.$products[0]['id']);
        }
        else {
            redirect('Products/item/no_match'); 
        }

    }
}
    
?>