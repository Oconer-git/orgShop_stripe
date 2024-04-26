<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shops extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Shop');
        $this->load->helper('url');
    }
    
    public function index() {
        $this->load->view('login');
    }

    public function sign_up() {
        $this->load->view('signup');
    }

    public function sign_up_process() {
        if($this->input->post('action') && $this->input->post('action') == 'sign_up') {
           
            $result = $this->Shop->validate_sign_up();
            if ($result != 'valid') {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect('shops/sign_up'); 
            } 
            else {
                $first_name = $this->security->xss_clean($this->input->post('first_name'));
                $last_name = $this->security->xss_clean($this->input->post('last_name'));
                $email = $this->security->xss_clean($this->input->post('email'));
                $contact_number = $this->security->xss_clean($this->input->post('contact_number'));
                $password = $this->security->xss_clean($this->input->post('password'));
                
                if($this->Shop->if_email_already_exist($email)) {
                    $this->session->set_flashdata('validation_errors', 'email already exists');
                    redirect('Shops/sign_up'); 
                }
                elseif($this->Shop->if_contact_already_exist($contact_number)) {
                    $this->session->set_flashdata('validation_errors', 'contact number already exists');
                    redirect('Shops/sign_up'); 
                }
                
                $data['account_info'] = array(
                    'first_name'=> $this->db->escape($first_name),
                    'last_name'=> $this->db->escape($last_name),
                    'email'=> $this->db->escape($email),
                    'password' => $this->db->escape($password),
                    'contact_number'=> $this->db->escape($contact_number),
                );
                
                if($this->Shop->check_if_first_account()== true) {
                    if($this->Shop->sign_up_as_admin($data['account_info'])) {
                        $this->session->set_flashdata('success', 'You successfully registered as admin');
                    }
                    else {
                        $this->session->set_flashdata('validation_errors', 'Registration failed');
                    }
                    redirect('/');
                } 
                else {
                    if($this->Shop->sign_up($data['account_info'])) {
                        $this->session->set_flashdata('success', 'You successfully registered');
                    }
                    else {
                        $this->session->set_flashdata('validation_errors', 'Registration failed');
                    }
                    redirect('/');
                }
               
            } 
        }
        
    }

    public function log_in_process() {
        if($this->input->post('action') && $this->input->post('action') == 'login') {
            $result = $this->Shop->validate_log_in();
            if ($result != 'valid') {
                $this->session->set_flashdata('validation_errors', validation_errors());
                redirect('/'); 
            } 
            else {
                $email = $this->security->xss_clean($this->input->post('email'));
                $password = $this->security->xss_clean($this->input->post('password'));
                
                $data['account_info'] = array(       
                    'email'=> $email,
                    'password' => $password,
                );
                
                $user = $this->Shop->log_in($data['account_info']);
                if($user == FALSE) {
                    $this->session->set_flashdata('validation_errors', 'invalid email or password');
                    redirect('/'); 
                }
                if($user['is_admin'] == TRUE) {
                    $this->session->set_userdata('user',$user);
                    redirect('Admins');
                }
                else if($user['is_admin']== NULL) {
                    $this->session->set_userdata('user',$user);
                    redirect('Products');
                }
                else {
                    $this->session->set_flashdata('validation_errors', 'email or password does not match');
                    redirect('/'); 
                }
            }
        }
    }
}
?>