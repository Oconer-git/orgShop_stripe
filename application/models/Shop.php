<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    //---------------SIGN UP METHODS START--------------------------------------------------
    public function if_email_already_exist($email) { 
        $email = $this->db->escape($email);
        $email_exists = $this->db->query("SELECT * FROM users where email = ?", array($email))->row_array();
        if($email_exists) {
            return true; 
        }
        else {
            return false; 
        }
    }

    public function if_contact_already_exist($contact_number) { //check if contact number already exists
        $contact_number= $this->db->escape($contact_number);
        $contact_exists = $this->db->query("SELECT * FROM users where contact_number = ?", array($contact_number))->row_array();
        if($contact_exists) {
            return true; 
        }
        else {
            return false; 
        }
    }

    public function sign_up_as_admin($account_info) {
        date_default_timezone_set('Asia/Manila');
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        $encrypted_password = md5($account_info['password'] . '' . $salt);
        $query = "INSERT INTO users (first_name, last_name, email, contact_number, password, salt, created_at, updated_at, is_admin) VALUES(?,?,?,?,?,?,?,?,?)";
        $values = array($account_info['first_name'], $account_info['last_name'], $account_info['email'], $account_info['contact_number'], $encrypted_password, $salt, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"), 1); 
        return $this->db->query($query, $values);
    }

    public function validate_sign_up() {
        $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|max_length[30]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|max_length[30]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required|numeric|exact_length[11]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[7]');
        $this->form_validation->set_rules('confirm_password', 'Repeat Password', 'trim|required|matches[password]', array('matches' => 'The %s field does not match the Password field.'));
        if ($this->form_validation->run() == FALSE) {
            return array(validation_errors());
        } 
        else {
            return "valid";
        }
    }

    public function check_if_first_account() {
        $result = $this->db->query("SELECT * FROM users")->result_array();
        if($result == NULL) {
            return true;
        } 
        else {
            return false;
        }        
    }

    public function sign_up($account_info) {
        date_default_timezone_set('Asia/Manila');
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        $encrypted_password = md5($account_info['password'] . '' . $salt);
        $query = "INSERT INTO users (first_name, last_name, email, contact_number, password, salt, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?)";
        $values = array($account_info['first_name'], $account_info['last_name'], $account_info['email'], $account_info['contact_number'], $encrypted_password, $salt, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
        return $this->db->query($query, $values);
    }
    //---------------SIGN UP METHODS END--------------------------------------------------



    //---------------LOG IN METHODS START--------------------------------------------------
    public function validate_log_in() {
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            return array(validation_errors());
        } 
        else {
            return "valid";
        }
    }

    function log_in($account_info) {
        date_default_timezone_set('Asia/Manila');
        $email = $this->db->escape($account_info['email']);
        $password = $this->db->escape($account_info['password']);

        $query = "SELECT * FROM users WHERE email = ?";
        $user = $this->db->query($query, array($email))->row_array();

        if(!empty($user)) {
            $encrypted_password = md5($password. '' . $user['salt']);
            if($user['password'] == $encrypted_password ) {
                
                $user = array(
                    'first_name' => str_replace("'", '', $user['first_name']),
                    'last_name' => str_replace("'", '', $user['last_name']),
                    'last_failed_log_in'=> str_replace("'", '', $user['last_failed_log_in']),
                    'id'=> $user['id'],
                    'is_admin' => $user['is_admin']
                );
                return $user;
            }
            else {
                $this->db->query("UPDATE users SET last_failed_log_in = ? WHERE users.email = ?", array(date("Y-m-d, H:i:s"), $email));
                return false;
            } 
        }
        else {
            return false;
        }
    }
 

    //---------------LOG IN METHODS END--------------------------------------------------

    
}
?>