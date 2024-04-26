<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Payments extends CI_Controller {
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library("session");
       $this->load->helper('url');
       $this->load->model('Product');
    }
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index()
    {
        $this->load->view('users/stripe');
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function stripe_post()
    {
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
        
        $user = $this->session->userdata('user');
        $carts = $this->Product->get_cart($user['id']);
        $shipping_info = $this->Product->get_default_shipping_info();
        $billing_info = $this->Product->get_default_billing_info();

        if($carts != NULL) {
            $price = 50;

            foreach($carts as $cart) {
                $cart_info = array(
                    'product_id' => $cart['product_id'],
                    'sold' => $cart['quantity']
                );
                $this->Product->add_sold($cart_info);
            }

            foreach($carts as $cart) {
                $price += $cart['quantity'] * $cart['price'];
            }
            \Stripe\Charge::create ([
                "amount" => 100 * $price,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => "Paid by ".$billing_info['first_name']." ".$billing_info['last_name']
            ]);
        }
        else {
            redirect('/Products/cart');
        }

   
        $this->Product->submit_payment_shipping_info($shipping_info);
        $this->Product->submit_payment_billing_info($billing_info);

        $user_info['id'] = $user['id'];
        $user_info['billing_id'] = $this->Product->get_latest_billing();
        $user_info['shipping_id'] = $this->Product->get_latest_shipping();

        $this->Product->order_carts($user_info);
        $this->session->set_flashdata('success', 'Payment made successfully.');
        redirect('/Products/cart');
    }
}
